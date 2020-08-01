@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $location_id = $project->id;
        $location_type = 5;
        $postingArr = $postings::with('user')->where([['location_type', '=', $location_type], ['location_id', '=', $location_id]])->get()->sortByDesc('updated_at');
        $canPost = $project->users->contains(Auth::id()) || $project->is_open;
    @endphp
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="card-background mb-2">
        <div id="project-profile" class="row mb-3">
            <div class="col-9">
                <div class="row">
                    <span class="col-12">{{$project->name}}</span>
                </div>
                <div class="row">
                    <span class="col-12">{{$project->description ?? ''}}</span>
                </div>
                @if($project->deadline !== null)
                    <div class="row">
                        <span class="col-12">Abgabetermin: {{$project->deadline->format('d.m.Y')}}</span>
                    </div>
                @endif
                <div class="row">
                    <span class="col-12">Mitglieder: {{count($project->users)}}</span>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <img src="{{$project->getProjectImage()}}" alt="profile picture" width="100%"
                         class="rounded-circle col-12">
                </div>
                @if(Auth::id() === $project->admin_id)
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn w-100 edit-project-btn green-standard-btn" type="button" href="{{route('project.edit', $project)}}">Projekt
                                editieren</a>
                        </div>
                    </div>
                @endif
                @if($project->checkUserStatus() === 1 && $project->admin_id !== Auth::id())
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="w-100 edit-project-btn red-standard-btn" type="button" href="{{route('project.leave', $project->id)}}">Projekt
                                verlassen</a>
                        </div>
                    </div>
                @endif
                @if($project->checkUserStatus() === 0 && $project->admin_id !== Auth::id())
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn w-100 edit-project-btn green-standard-btn" type="button"
                               href="{{route('project.acceptInvite', $project->id)}}">Einladung akzeptieren</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="w-100 edit-project-btn red-standard-btn" type="button" href="{{route('project.denyInvite', $project->id)}}">Einladung
                                ablehnen</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
