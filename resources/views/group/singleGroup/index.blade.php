@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $location_id = $group->id;
        $location_type = 4;
        $postingArr = $postings::with('user')->where([['location_type', '=', $location_type], ['location_id', '=', $location_id]])->get()->sortByDesc('updated_at');
    @endphp
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="card-background mb-2">
        <div id="group-profile" class="row mb-3">
            <div class="col-9">
                <div class="row">
                    <span class="col-12">{{$group->name}}</span>
                </div>
                <div class="row">
                    <span class="col-12">{{$group->description ?? ''}}</span>
                </div>
                <div class="row">
                    <span class="col-12">Mitglieder: {{count($group->users)}}</span>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <img src="{{$group->getGroupImage()}}" alt="profile picture" width="100%"
                         class="rounded-circle col-12">
                </div>
                @if(Auth::id() === $group->admin_id)
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn w-100 edit-group-btn green-standard-btn" type="button" href="{{route('group.edit', $group)}}">Gruppe editieren</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
