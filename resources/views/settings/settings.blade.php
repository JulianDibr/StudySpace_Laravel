@extends('layouts.dashboard')

@section('content')
    <form method="POST" action="{{ route('settings.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row mb-2">
                    <h1 class="friends-headline col-12">Optionen</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="first_name" class="settings-label">Vorname</label>
                        <input id="first_name" type="text" class="settings-input @error('first_name') is-invalid @enderror"
                               name="first_name" value="{{ old('first_name', $user->first_name) }}" autocomplete="first_name" autofocus
                               placeholder="Vorname">

                        @error('first_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="settings-label">Nachname</label>
                        <input id="last_name" type="text" class="settings-input @error('last_name') is-invalid @enderror"
                               name="last_name" value="{{ old('last_name', $user->last_name) }}" autocomplete="last_name" autofocus
                               placeholder="Nachname">

                        @error('last_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="email" class="settings-label">E-Mail Adresse</label>
                        <input id="email" type="email" class="settings-input @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email', $user->email) }}" autocomplete="email"
                               placeholder="E-Mail Adresse">

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="password" class="settings-label">Passwort ändern</label>
                        <input id="password" type="password"
                               class="settings-input @error('password') is-invalid @enderror" name="password"
                               autocomplete="new-password" placeholder="Passwort">

                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="password-confirm" class="settings-label">Passwort ändern bestätigen</label>
                        <input id="password-confirm" type="password" class="settings-input"
                               name="password_confirmation" autocomplete="new-password"
                               placeholder="Passwort wiederholen">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="birthday" class="settings-label">Geburtstag</label>
                        <input id="birthday" type="text"
                               class="date-mask settings-input @error('birthday') is-invalid @enderror" name="birthday"
                               placeholder="01.01.1999" value="{{ old('birthday', \Carbon\Carbon::parse($user->birthday)->format('d.m.Y'))}}">

                        @error('birthday')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col">
                        <button type="submit" class="btn settings-save-btn green-standard-btn">
                            {{ __('Speichern') }}
                        </button>
                    </div>
                </div>

                <button class="red-standard-btn btn mt-5" data-toggle="modal" data-target="#delete-account-modal">Meinen Account löschen</button>
            </div>
            <div class="col-12 col-md-6 mt-5 mt-md-0">
                <div class="row mb-2">
                    <h1 class="friends-headline col-12">Profilbild ändern</h1>
                </div>
                <div class="row">
                    <div class="col-12" style="margin-top: 20px">
                        <label for="profile_picture" class="edit-image-container">
                            <img src="{{$user->getUserImage()}}" alt="" width="100%" class="edit-image-current-image">
                            <div class="edit-image-overlay">
                                <i class="fas fa-edit fa-2x edit-image-icon"></i>
                            </div>
                        </label>
                        <input class="d-none" id="profile_picture" name="profile_picture" type="file">
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('settings.deleteAccountModal')
@endsection
