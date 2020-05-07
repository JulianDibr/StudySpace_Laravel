@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10">{{ __('Registrieren') }}</div>
        <div class="col-2 text-right">
            <a class="btn" href="/">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="index-border">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <input id="first_name" type="text" class="index-input @error('first_name') is-invalid @enderror"
                       name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus
                       placeholder="Vorname">

                @error('first_name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="col-md-6">
                <input id="last_name" type="text" class="index-input @error('last_name') is-invalid @enderror"
                       name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                       placeholder="Nachname">

                @error('last_name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input id="email" type="email" class="index-input @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       placeholder="E-Mail Adresse">

                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input id="password" type="password"
                       class="index-input @error('password') is-invalid @enderror" name="password"
                       required autocomplete="new-password" placeholder="Passwort">

                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input id="password-confirm" type="password" class="index-input"
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Passwort wiederholen">
            </div>
        </div>

        <div class="row mb-0">
            <div class="col">
                <button type="submit" class="btn index-btn">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
@endsection
