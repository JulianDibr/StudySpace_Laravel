@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $postingsArr = $postings->getByUser($profile->id);
    @endphp
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="row">
        <div class="col-9">

        </div>
        <div class="col-3">
            <img src="{{$profile->getUserImage()}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
