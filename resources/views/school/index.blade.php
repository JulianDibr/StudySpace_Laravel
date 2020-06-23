@extends('layouts.dashboard')

@inject('postings','App\Posting')

@php
    $location_id = $school->id;
    $location_type = 2;
    $postingArr = $postings::with('user')->where([['location_type', '=', $location_type], ['location_id', '=', $location_id]])->get()->sortByDesc('updated_at');
@endphp

@section('content')

    {{--Get $school from controller--}}
    {{--Profile data--}}
    <div class="row mb-3">
        <div class="col-9">
            <div class="row">
                <span class="col-12">{{$school->name}}</span>
            </div>
            <div class="row">
                <span class="col-12">{{$school->street ." ". $school->house_number}}</span>
            </div>
            <div class="row">
                <span class="col-12">{{$school->zipcode  ." ". $school->city}}</span>
            </div>
            <div class="row">
                <span class="col-12">Telefon: {{$school->phone}}</span>
            </div>
            <div class="row">
                <span class="col-12">Registrierte Studenten: {{count($school->users)}}</span>
            </div>
        </div>
        <div class="col-3">
            <img src="{{$school->getSchoolImage()}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
