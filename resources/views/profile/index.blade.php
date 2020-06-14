@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $location_id = $profile->id;
        $location_type = 1;
        $postingArr = $postings::with('user')->where([['location_type', '=', $location_type], ['location_id', '=', $location_id]])->get()->sortByDesc('updated_at');
    @endphp
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="row">
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
                <span class="col-12">Eingeschriebene Kurse: {{count($profile->courses)}}</span>
            </div>
            <div class="row">
                <span class="col-12">Teilgenommene Projekte: 0{{--count($profile->projects)--}}</span>
            </div>
            <div class="row">
                <span class="col-12">Gruppen: 0{{--count($profile->groups)--}}</span>
            </div>
        </div>
        <div class="col-3">
            <img src="{{$profile->getUserImage()}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
