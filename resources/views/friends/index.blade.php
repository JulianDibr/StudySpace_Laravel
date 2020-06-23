@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    {{--Postings--}}
    @include('friends.myRequests')
    @include('friends.myFriends')
    @include('friends.friendRecommendations')
@endsection
