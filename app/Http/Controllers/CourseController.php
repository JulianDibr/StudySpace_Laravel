<?php

namespace App\Http\Controllers;

use App\course;
use App\Helpers\commonHelpers;
use App\Http\Requests\CourseRequest;
use App\Posting;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {
    public function index() {
        return view('course.overview.index');
    }

    public function create() {
        $course = new Course();
        return view('course.singleCourse.edit', compact('course'));
    }

    public function store(CourseRequest $request) {
        $admin = Auth::user();

        $data = $request->all();
        if(!array_key_exists('user_invite', $data)){
            $data['user_invite'] = 0;
        }

        //Store new course
        $course = new Course();
        $course->fill($data);
        $course->school_id = $admin->school->id;
        $course->admin_id = $admin->id;
        $course->save();

        $this->storeUsers($request, $course, $admin);

        return redirect()->route('course.show', $course->id);
    }

    public function storeUsers($request, $course, $admin) {
        if ($this->isAdmin($course) || ($course->user_invite == 1 && $course->users->contains(Auth::id()))) {
            if ($request->user_list !== null) {
                $course->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
            }
            $course->users()->attach($admin); //Include Admin in Group
        }
    }

    public function isAdmin($course) {
        return commonHelpers::isAdmin($course);
    }

    public function show($id) {
        $course = Course::find($id);

        if ($course !== null) {
            return view('course.singleCourse.index', compact('course'));
        } else {
            return redirect()->route('courses.index');
        }
    }

    public function edit(course $course) {
        //Only open edit mode when user is the admin
        if ($this->isAdmin($course)) {
            return view('course.singleCourse.edit', compact('course'));
        } else {
            return redirect()->route('course.show', $course);
        }
    }

    public function update(CourseRequest $request, course $course) {
        $admin = Auth::id();

        $data = $request->all();
        if(!array_key_exists('user_invite', $data)){
            $data['user_invite'] = 0;
        }

        if ($this->isAdmin($course)) {
            $course->update($data);
        }

        $this->storeUsers($request, $course, $admin);

        return redirect()->route('course.show', $course->id);
    }

    public function destroy(course $course) {
        if ($this->isAdmin($course)) {
            $location_type = 3;
            $postingArr = Posting::where([['location_type', '=', $location_type], ['location_id', '=', $course->id]])->get();

            foreach ($postingArr as $posting) {
                $posting->deletePosting();
            }
            $course->users()->detach();
            $course->delete();
        }

        return redirect()->route('courses.index');
    }

    public function leave($id) {
        $course = Course::find($id);

        if ($course->users->contains(Auth::id())) {
            $course->users()->detach(Auth::id());
        }
        return redirect()->route('courses.index');
    }
}
