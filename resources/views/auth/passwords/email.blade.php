@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10">{{ __('Passwort zurücksetzen') }}</div>
        <div class="col-2 text-right">
            <a class="btn" href="/login">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="index-border">
        @csrf

        <div class="row">
            <div class="col">
                <input id="email" type="email" class="index-input @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="E-Mail Adresse">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col">
                <button type="submit" class="btn index-btn">
                    {{ __('Link zum Passwort resetten senden?') }}
                </button>
            </div>
        </div>
    </form>
@endsection
