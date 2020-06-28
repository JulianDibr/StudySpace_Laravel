<?php

namespace App\Http\Controllers;

use App\course;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.overview.index');
    }

    public function create()
    {
        $course = new Course();
        return view('course.singleCourse.edit', compact('course'));
    }

    public function store(CourseRequest $request) //TODO: Request Handler
    {
        $admin = Auth::user();
        //Store new course
        $course = new Course();
        $course->fill($request->all());
        $course->school_id = $admin->school->id;
        $course->admin_id = $admin->id;
        $course->save();

        $this->storeUsers($request, $course, $admin);

        return redirect()->route('course.show', $course->id);
    }

    public function show($id)
    {
        $course = Course::find($id);

        if($course !== null){
            return view('course.singleCourse.index', compact('course'));
        } else {
            return redirect()->route('courses.index');
        }
    }

    public function edit(course $course)
    {
        //Only open edit mode when user is the admin
        if (Auth::user()->id == $course->admin_id) {
            return view('course.singleCourse.edit', compact('course'));
        } else {
            return redirect()->route('course.show', $course);
        }
    }

    public function update(CourseRequest $request, course $course)
    {
        $admin = Auth::user();

        $this->storeUsers($request, $course, $admin);
        return redirect()->route('course.show', $course->id);
    }

    public function destroy(course $course)
    {

    }

    public function storeUsers($request, $course, $admin) {
        if($request->user_list !== null) {
            $course->users()->sync(explode(",", $request->user_list)); //TODO: Nur Nutzer der selben school_id zulassen
        }
        $course->users()->attach($admin); //Include Admin in Group
    }
}
