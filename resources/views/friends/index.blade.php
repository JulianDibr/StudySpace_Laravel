@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    {{--Postings--}}
    <div id="friendlist">
        @include('friends.myRequests')
        @include('friends.myFriends')
        @include('friends.friendRecommendations')
    </div>
@endsection
