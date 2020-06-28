<?php

namespace App\Http\Controllers;

use App\course;
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
        return $this->edit(new Course());
    }

    public function store(Request $request)
    {
        $admin = Auth::user();
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
        return view('course.singleCourse.edit', compact('course'));
    }

    public function update(Request $request, course $course)
    {

    }

    public function destroy(course $course)
    {

    }
}
