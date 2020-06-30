@extends('layouts.dashboard')

@section('content')
    <div id="message-container" class="card-background">
        @include('messages.show')
    </div>
@endsection
