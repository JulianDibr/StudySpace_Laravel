@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $location_id = 0;
        $location_type = 0;
        $postingArr = $postings->getFeed();
    @endphp

    @include('components.postings')
@endsection
