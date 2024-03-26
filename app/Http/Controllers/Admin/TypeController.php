<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:types',
            'color' => 'nullable|hex_color',

        ], [
            'label.required' => 'Nessun etichetta inserita',
            'color.hex_color' => 'Il formato del colore non è valido',

        ]);

        $data = $request->all();

        $type = new Type();

        $type->fill($data);
        $type->save();

        return to_route('admin.types.index', $type->id)->with('message', "Nuovo tipo creato: $type->label")->with('type', "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'label' =>
            ['required', 'string', Rule::unique('types')->ignore($type->id)],
            'color' => 'nullable|hex_color',

        ], [
            'label.required' => 'Nessun etichetta inserita',
            'color.hex_color' => 'Il formato del colore non è valido',

        ]);

        $data = $request->all();
        $type->update($data);

        return to_route('admin.types.index', $type->id)->with('message', "Tipo modificato")->with('type', "info");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', "$type->label eliminato")->with('type', "danger");
    }

}