<?php

namespace App\Http\Controllers;

use App\Posting;
use App\school;
use Illuminate\Http\Request;

class SchoolController extends Controller {
    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        $school = School::find($id);
        if ($school !== null) {
            //If profile for this id exist -> show profile
            return view('school.index', compact('school', $school));
        } else {
            //Else redirect to home screen
            return redirect()->route('home');
        }
    }

    public function edit(school $school) {
        //
    }

    public function update(Request $request, school $school) {
        //
    }

    public function destroy(school $school) {
/*        if ($this->isAdmin($school)) {
            $location_type = 5;
            $postingArr = Posting::where([['location_type', '=', $location_type], ['location_id', '=', $school->id]])->get();

            foreach ($postingArr as $posting) {
                $posting->deletePosting();
            }
            $school->users()->detach();
            $school->delete();
        }


        return redirect()->route('project.index');*/
    }
}
