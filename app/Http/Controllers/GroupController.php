<?php

namespace App\Http\Controllers;

use App\group;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        return view('group.overview.index');
    }

    public function create()
    {
        $group = new Group();
        return view('group.singleGroup.edit', compact('group'));
    }

    public function store(GroupRequest $request)
    {
        $admin = Auth::user();
        //Store new course
        $group = new Group();
        $group->fill($request->all());
        $group->admin_id = $admin->id;
        $group->save();

        $this->storeUsers($request, $group, $admin);

        return redirect()->route('group.show', $group->id);
    }

    public function show($id)
    {
        $group = Group::find($id);

        if($group !== null){
            return view('group.singleGroup.index', compact('group'));
        } else {
            return redirect()->route('groups.index');
        }
    }

    public function edit(group $group)
    {
        //
    }

    public function update(GroupRequest $request, group $group)
    {
        $admin = Auth::user();

        $this->storeUsers($request, $group, $admin);

        return redirect()->route('group.show', $group->id);
    }

    public function destroy(group $group)
    {
        //
    }

    public function storeUsers($request, $group, $admin) {
        if($request->user_list !== null) {
            $group->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
        }
        $group->users()->attach($admin); //Include Admin in Group
    }
}
