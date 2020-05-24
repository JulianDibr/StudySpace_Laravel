@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    @php
        $postingArr = $postings::with('user')->get()->sortByDesc('updated_at');
    @endphp

    @include('components.postings')
@endsection
