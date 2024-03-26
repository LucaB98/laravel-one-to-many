<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //salvo i filtri in delle variabili
        $is_completed_filter = $request->query('is_completed_filter');
        $type_filter = $request->query('type_filter');

        $query = Project::orderByDesc('updated_at')->orderByDesc('created_at');


        if($is_completed_filter){
            $value = $is_completed_filter === 'completed';
            $query->whereIsCompleted($value);
        }

        if($type_filter){
            $query->whereTypeId($type_filter);
        }

        $projects = $query->paginate(10)->withQueryString();

        $types = Type::select('label', 'id')->get();

        return view('admin.projects.index', compact('projects','type_filter','is_completed_filter', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('label', 'id')->get();

        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
        ], 
        [
            'title.required' => 'Il progetto deve avere un titolo',
            'description.required' => 'Il progetto deve avere una descrizione',
            'image.image' => 'Il file inserito non è un immagine',
            'type_id.exist' => 'Il tipo non è valido o esistente',
        ]);

        $data = $request->all();
        
        $project = new Project();

        $project->fill($data);

        $project->slug = Str::slug($project->title);
        $project->is_completed = Arr::exists($data, 'is_completed');

        //controllo se arriva un file
        if(Arr::exists($data, 'image')){
            $extension = $data['image']->extension(); //salvo nella variabile extension l'estensione dell'immagine inserita dall'utente

            $img_url = Storage::putFileAs('project_images', $data['image'], "$project->slug.$extension"); //salvo nella variabile url e in project images l'immagine rinominata con lo slug del progetto

            $project->image= $img_url;
        }
        

        $project->save();

        return to_route('admin.projects.show', $project)->with('type', 'success')->with('message', 'Progetto creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
        ], 
        [
            'title.required' => 'Il progetto deve avere un titolo',
            'description.required' => 'Il progetto deve avere una descrizione',
            'image.image' => 'Il file inserito non è un immagine',
            'type_id.exist' => 'Il tipo non è valido o esistente',
        ]);
    
        $data = $request->all();

        $data['slug'] = Str::slug($data['title']);
        $data['is_completed'] = Arr::exists($data, 'is_completed');

        //controllo se arriva un file
        if(Arr::exists($data, 'image')){

            // controllo se ho un altra immagine già esistente nella cartella e la cancello
            if($project->image) Storage::delete($project->image);

            $extension = $data['image']->extension(); //salvo nella variabile extension l'estensione dell'immagine inserita dall'utente

            $img_url = Storage::putFileAs('project_images', $data['image'], "{$data['slug']}.$extension"); //salvo nella variabile url e in project images l'immagine rinominata con lo slug del progetto

            $project->image = $img_url;
            
        }
    
        $project->update($data);

    
        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')
        ->with('toast-button-type', 'danger')
        ->with('toast-message', 'Progetto eliminato')
        ->with('toast-label', config('app.name'))
        ->with('toast-method', 'PATCH')
        ->with('toast-route', route('admin.projects.restore', $project->id))
        ->with('toast-button-label', 'ANNULLA');
    }


    //Rotte Soft delete

    public function trash() {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project){

        $project->restore();

        return to_route('admin.projects.index')->with('type', 'success')->with('message', 'Progetto ripristinato con successo');
    }

    public function drop(Project $project){

        $project->forceDelete();

        return to_route('admin.projects.trash')->with('type', 'warning')->with('message', 'Progetto eliminato con successo');
    }
}
