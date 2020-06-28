@extends('layouts.dashboard')

@section('content')
    <div class="row">
        {{--NEW--}}
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <a class="course-container card mb-2 mt-2 p-3" href="{{route('course.create')}}">
                <div class="row h-100">
                    <div class="col-12 my-auto text-center">
                        <i class="fas fa-2x fa-plus icon-black"></i>
                    </div>
                </div>
            </a>
        </div>

        @foreach(Auth::user()->courses as $course)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="course-container card mb-2 mt-2 p-3" href="{{route('course.show', $course->id)}}">
                    <div class="row h-100">
                        <div class="col-12 my-auto text-center">
                            {{$course->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row mb-2">
        <h1 class="course-headline col-12">Weitere Kurse</h1>
    </div>

    <div class="row">
        @foreach(Auth::user()->courses as $course)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="course-container card mb-2 mt-2 p-3" href="{{route('course.show', $course->id)}}">
                    <div class="row h-100">
                        <div class="col-12 my-auto text-center">
                            {{$course->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
