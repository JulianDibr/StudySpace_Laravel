@extends('layouts.dashboard')

@section('content')
    <div class="row">
        {{--NEW--}}
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="course-container card mb-2 mt-2 p-3">
                <div class="row h-100">
                    <div style="font-size: 72px" class="col-12 my-auto text-center">
                        +
                    </div>
                </div>
            </div>
        </div>
        @foreach(Auth::user()->courses as $course)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="course-container card mb-2 mt-2 p-3" href="{{route('course.show', $course->id)}}">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
