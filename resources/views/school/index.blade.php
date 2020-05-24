@extends('layouts.dashboard')

@inject('postings','App\Posting')

@php
    $postingArr = $postings::with('user')->get()->sortByDesc('updated_at');
@endphp

@section('content')

    {{--Get $school from controller--}}
    {{--Profile data--}}
    <div class="row test">
        <div class="col-9">

        </div>
        <div class="col-3">
            <img src="{{asset('/img/user_default.png')}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
