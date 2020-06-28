<?php

namespace App\Http\Controllers;

use App\course;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy(course $course)
    {
        //
    }
}
