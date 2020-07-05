<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project.overview.index');
    }

    public function create()
    {
        $project = new Project();
        return view('project.singleProject.edit', compact('project'));
    }

    public function store(ProjectRequest $request)
    {
        $admin = Auth::user();
        //Store new project
        $project = new Project();
        $project->fill($request->all());
        $project->admin_id = $admin->id;
        $project->save();

        $this->storeUsers($request, $project, $admin);

        return redirect()->route('project.show', $project->id);
    }

    public function show($id)
    {
        $project = Project::find($id);

        if ($project !== null) {
            return view('project.singleProject.index', compact('project'));
        } else {
            return redirect()->route('projects.index');
        }
    }

    public function edit(project $project)
    {
        //TODO: durch $id ersetzen nur aufrufen wenn gefunden kurse auch
        //Only open edit mode when user is the admin
        if (Auth::id() == $project->admin_id) {
            return view('project.singleProject.edit', compact('project'));
        } else {
            return redirect()->route('project.show', $project);
        }
    }

    public function update(ProjectRequest $request, project $project)
    {
        $admin = Auth::user();

        $this->storeUsers($request, $project, $admin);

        return redirect()->route('project.show', $project->id);
    }

    public function destroy(project $project)
    {
        //
    }

    public function storeUsers($request, $project, $admin)
    {
        if ($request->user_list !== null) {
            $project->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
        }
        $project->users()->attach($admin); //Include Admin in Project
    }
}
