<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Type;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::whereSlug($slug)->first();

        if(!$project) abort(404);

        $types = Type::all();

        return view('guest.projects.show', compact('project', 'types'));
    }

}
