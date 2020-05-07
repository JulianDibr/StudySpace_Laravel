@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10">{{ __('Einloggen') }}</div>
        <div class="col-2 text-right">
            <a class="btn" href="/">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="index-border">
        @csrf

        <div class="row">
            <div class="col">
                <input id="email" type="email"
                       class="index-input @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="E-Mail Adresse">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input id="password" type="password"
                       class="index-input @error('password') is-invalid @enderror" name="password"
                       required autocomplete="current-password" placeholder="Passwort">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Passwort vergessen?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Eingeloggt bleiben') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col">
                <button type="submit" class="btn index-btn">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
@endsection
