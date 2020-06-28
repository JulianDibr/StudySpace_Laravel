@extends('layouts.dashboard')

@section('content')
    <div id="message-container" class="card-background">
        <div class="row h-100">
            <div class="col-9 info-messages-container">
                <div class="row info-header">
                    <div class="col-9">
                        Name
                    </div>
                    <div class="col-3">
                        Was anderes?
                    </div>
                </div>
                <div class="row message-view">

                </div>
                <div class="row message-input-container">

                </div>
            </div>
            <div class="col-3 contact-list-container">
                foreach conversation show user
                liste
            </div>
        </div>
    </div>
@endsection
