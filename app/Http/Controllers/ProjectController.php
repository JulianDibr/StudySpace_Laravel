<?php

namespace App\Http\Controllers;

use App\Helpers\commonHelpers;
use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {
    public function index() {
        return view('project.overview.index');
    }

    public function create() {
        $project = new Project();
        return view('project.singleProject.edit', compact('project'));
    }

    public function store(ProjectRequest $request) {
        $admin = Auth::user();
        //Store new project
        $project = new Project();
        $project->fill($request->all());
        $project->admin_id = $admin->id;
        $project->save();

        $this->storeUsers($request, $project, $admin);

        return redirect()->route('project.show', $project->id);
    }

    public function storeUsers($request, $project, $admin) {
        if ($this->isAdmin($project) || ($project->user_invite == 1 && $project->users->contains(Auth::id()))) {
            if ($request->user_list !== null) {
                $project->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
            }
            $project->users()->attach($admin); //Include Admin in Project
        }
    }

    public function isAdmin($project) {
        return commonHelpers::isAdmin($project);
    }

    public function show($id) {
        $project = Project::find($id);

        if ($project !== null) {
            return view('project.singleProject.index', compact('project'));
        } else {
            return redirect()->route('projects.index');
        }
    }

    public function edit(project $project) {
        //TODO: durch $id ersetzen nur aufrufen wenn gefunden kurse auch
        //Only open edit mode when user is the admin
        if ($this->isAdmin($project)) {
            return view('project.singleProject.edit', compact('project'));
        } else {
            return redirect()->route('project.show', $project);
        }
    }

    public function update(ProjectRequest $request, project $project) {
        $admin = Auth::user();

        if ($this->isAdmin($project)) {
            $project->update($request->all());
        }

        $this->storeUsers($request, $project, $admin);

        return redirect()->route('project.show', $project->id);
    }

    public function destroy(project $project) {
        if ($this->isAdmin($project)) {
            foreach ($project->postings() as $posting) {
                $posting->deletePosting();
            }
            $project->users()->detach();
            $project->delete();
        }

        return redirect()->route('project.index');
    }
}
