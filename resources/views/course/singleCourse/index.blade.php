@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $location_id = $course->id;
        $location_type = 3;
        $postingArr = $postings::with('user')->where([['location_type', '=', $location_type], ['location_id', '=', $location_id]])->get()->sortByDesc('updated_at');
    @endphp
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="card-background mb-2">
        <div id="course-profile" class="row mb-3">
            <div class="col-9">
                <div class="row">
                    <span class="col-12">{{$course->name}}</span>
                </div>
                <div class="row">
                    <span class="col-12">{{$course->abbreviation}}</span>
                </div>
                <div class="row">
                    <span class="col-12">{{$course->description ?? ''}}</span>
                </div>
                <div class="row">
                    <span class="col-12">Dozent: {{$course->teacher ?? ''}}</span>
                </div>
                <div class="row">
                    <span class="col-12">Teilnehmer: {{count($course->users)}}</span>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <img src="{{$course->getCourseImage()}}" alt="profile picture" width="100%"
                         class="rounded-circle col-12">
                </div>
                @if(Auth::id() === $course->admin_id)
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="w-100 edit-course-btn green-standard-btn" type="button" href="{{route('course.edit', $course)}}">Kurs editieren</a>
                        </div>
                    </div>
                @endif
                @if($course->users->contains(Auth::id()) && Auth::id() !== $course->admin_id)
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="w-100 edit-course-btn red-standard-btn" type="button" href="{{route('course.leave', $course->id)}}">Kurs verlassen</a>
                        </div>
                    </div>
                @endif
                @if($course->user_invite == 1)
                    <div class="row mt-2">
                        <div class="col-12">
                            <button class="btn w-100 edit-course-btn green-standard-btn" type="button" data-toggle="modal" data-target="#user-invite-modal">Nutzer einladen</button>
                        </div>
                    </div>
                    @php
                        $users = $course->users;
                    @endphp
                    @include('components.modals.userInvite')
                @endif
            </div>
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
