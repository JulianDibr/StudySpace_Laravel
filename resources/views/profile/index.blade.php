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

        </div>
        <div class="col-3">
            <img src="{{$profile->getUserImage()}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    @include('components.postings')
@endsection
