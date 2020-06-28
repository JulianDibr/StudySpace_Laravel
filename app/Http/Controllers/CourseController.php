<?php

namespace App\Http\Controllers;

use App\course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
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

        $course->users()->attach($admin); //Include Admin in Group
        //TODO: Attach all other selected users

        return redirect()->route('course.show', $course->id);
    }

    public function show(course $course)
    {
        return view('course.singleCourse.index', compact('course'));
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

    }

    public function destroy(course $course)
    {

    }
}
