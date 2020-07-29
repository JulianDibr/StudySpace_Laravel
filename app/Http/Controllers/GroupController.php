<?php

namespace App\Http\Controllers;

use App\group;
use App\Helpers\commonHelpers;
use App\Http\Requests\GroupRequest;
use App\Posting;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller {
    public function index() {
        return view('group.overview.index');
    }

    public function create() {
        $group = new Group();
        return view('group.singleGroup.edit', compact('group'));
    }

    public function store(GroupRequest $request) {
        $admin = Auth::user();
        //Store new course
        $group = new Group();
        $group->fill($request->all());
        $group->admin_id = $admin->id;
        $group->save();

        $this->storeUsers($request, $group, $admin);

        return redirect()->route('group.show', $group->id);
    }

    public function storeUsers($request, $group, $admin) {
        if ($this->isAdmin($group) || ($group->user_invite == 1 && $group->users->contains(Auth::id()))) {
            if ($request->user_list !== null) {
                $group->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
            }
            $group->users()->attach($admin); //Include Admin in Group
        }
    }

    public function isAdmin($group) {
        return commonHelpers::isAdmin($group);
    }

    public function show($id) {
        $group = Group::find($id);

        if ($group !== null) {
            return view('group.singleGroup.index', compact('group'));
        } else {
            return redirect()->route('groups.index');
        }
    }

    public function edit(group $group) {
        //TODO: durch $id ersetzen nur aufrufen wenn gefunden kurse auch
        //Only open edit mode when user is the admin
        if ($this->isAdmin($group)) {
            return view('group.singleGroup.edit', compact('group'));
        } else {
            return redirect()->route('group.show', $group);
        }
    }

    public function update(GroupRequest $request, group $group) {
        $admin = Auth::user();

        if ($this->isAdmin($group)) {
            $group->update($request->all());
        }

        $this->storeUsers($request, $group, $admin);

        return redirect()->route('group.show', $group->id);
    }

    public function destroy(group $group) {
        if ($this->isAdmin($group)) {
            $location_type = 4;
            $postingArr = Posting::where([['location_type', '=', $location_type], ['location_id', '=', $group->id]])->get();

            foreach ($postingArr as $posting) {
                $posting->deletePosting();
            }
            $group->users()->detach();
            $group->delete();
        }

        return redirect()->route('group.index');
    }

    public function leave($id) {
        $group = Group::find($id);

        if ($group->users->contains(Auth::id())) {
            $group->users()->detach(Auth::id());
        }
        return redirect()->route('group.index');
    }
}
