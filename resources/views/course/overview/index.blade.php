@extends('layouts.dashboard')

@section('content')
    @if(count(Auth::user()->getInvitedCourses()) > 0 )
        <div class="row mb-2">
            <h1 class="group-headline col-12">Einladungen in Kurse</h1>
        </div>

        <div class="row">
            @foreach(Auth::user()->getInvitedCourses() as $course)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <a class="course-container card mb-2 mt-2 p-0"
                       href="{{route('course.show', $course->id)}}" style="background: url({{$course->getCourseImage()}}) no-repeat center center">
                        <div class="row mx-0 h-100">
                            <div class="col-12 my-auto text-center course-name-container">
                                <div class="course-name">{{$course->name}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row mb-2">
        <h1 class="course-headline col-12">Meine Kurse</h1>
    </div>

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
                <a class="course-container card mb-2 mt-2 p-0"
                   href="{{route('course.show', $course->id)}}" style="background: url({{$course->getCourseImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center course-name-container">
                            <div class="course-name">{{$course->name}}</div>
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
        @foreach(Auth::user()->getRecommendedCourses() as $course)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="course-container card mb-2 mt-2 p-0"
                   href="{{route('course.show', $course->id)}}" style="background: url({{$course->getCourseImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center course-name-container">
                            <div class="course-name">{{$course->name}}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
