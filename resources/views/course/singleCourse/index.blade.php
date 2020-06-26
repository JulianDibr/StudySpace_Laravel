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
    {{--<div id="user-profile" class="row mb-3">
        <div class="col-9">
            <div class="row">
                <span class="col-12">{{$profile->first_name . " " . $profile->last_name}}</span>
            </div>
            <div class="row">
                <span class="col-12">Geburtstag: {{$profile->birthday ?? 'Noch nicht hinterlegt'}}</span>
            </div>
            <div class="row">
                <span class="col-12">Schule: <a href="{{ route('school.show', $profile->school->id)}}">{{$profile->school->name}}</a></span>
            </div>
            <div class="row">
                <span class="col-12">Freunde: {{$profile->getFriendsCount()}}</span>
            </div>
            <div class="row">
                <span class="col-12">Eingeschriebene Kurse: {{count($profile->courses)}}</span>
            </div>
            <div class="row">
                <span class="col-12">Teilgenommene Projekte: 0--}}{{--count($profile->projects)--}}{{--</span>
            </div>
            <div class="row">
                <span class="col-12">Gruppen: 0--}}{{--count($profile->groups)--}}{{--</span>
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <img src="{{$profile->getUserImage()}}" alt="profile picture" width="100%" class="rounded-circle col-12">
            </div>
            @if(Auth::user()->id !== $profile->id)
                <div class="row mt-2">
                    <div class="col-12">
                        @if(Auth::user()->hasFriendRequestFrom($profile))
                            <div class="row">
                                <button class="btn col-5 accept-friend-request-btn" data-profile-id="{{$profile->id}}">
                                    Akzeptieren
                                </button>
                                <button class="btn col-5 offset-2 decline-friend-request-btn" data-profile-id="{{$profile->id}}">
                                    Ablehnen
                                </button>
                            </div>
                        @else
                            <button
                                class="{{(Auth::user()->isFriendWith($profile) || Auth::user()->hasSentFriendRequestTo($profile)) ? 'd-none' : ''}} btn w-100 add-to-friends-btn"
                                type="button" data-profile-id="{{$profile->id}}">Zu Freunden hinzufügen
                            </button>
                            <button class="{{Auth::user()->isFriendWith($profile) ? '' : 'd-none'}} btn w-100 rm-from-friends-btn" type="button"
                                    data-profile-id="{{$profile->id}}">Aus Freunden entfernen
                            </button>
                            <button class="{{Auth::user()->hasSentFriendRequestTo($profile) ? '' : 'd-none'}} btn w-100 cancel-friend-request-btn"
                                    type="button"
                                    data-profile-id="{{$profile->id}}">Anfrage zurückziehen
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>--}}
    {{--Postings--}}
    @include('components.postings')
@endsection
