@extends('layouts.dashboard')

@inject('users', 'App\User')

@section('content')
    <form id="edit-group-form" action="{{$group->exists ? route('group.update', $group) : route('group.store')}}"
          method="POST">
        @csrf
        @if($group->exists)
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-12 col-lg-8 new-group-data-container">
                <div class="card-background">
                    <h1 class="group-headline mb-4">Neue Gruppe anlegen</h1>

                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name" class="mb-2">Name der Gruppe</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') validation-error-border @enderror"
                                       placeholder="Name der Gruppe eingeben"
                                       value="{{old('name', $group->name ?? '')}}">
                                @error('name')
                                <label for="name" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="my-2">Beschreibung der Gruppe</label>
                                <input type="text" name="description"
                                       class="form-control @error('description') validation-error-border @enderror"
                                       placeholder="Beschreibung der Gruppe eingeben"
                                       value="{{old('description', $group->description ?? '')}}">
                                @error('description')
                                <label for="description" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="user_invite" name="user_invite"
                                       value="1" {{$group->user_invite == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="user_invite">Einladungen erlauben</label>
                            </div>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_open" name="is_open"
                                       value="1" {{$group->is_open == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="is_open">Offene Gruppe</label>
                            </div>
                        </div>
                        <div class="col-3 text-center my-auto">
                            <input type="file" id="image" name="image" class="d-none">
                            <label for="image"><i class="fas fa-camera fa-5x"></i></label>
                        </div>
                    </div>

                    <button type="button"
                            class="submit-group btn green-standard-btn mt-3">{{$group->exists ? 'Gruppe updaten' : 'Gruppe anlegen'}}</button>
                    @if($group->exists)
                        <button type="button" class="btn red-standard-btn mt-3 ml-2" onclick="$('#destroy-group-form').submit();">Gruppe löschen
                        </button>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 mt-5 mt-lg-0">
                <div class="card-background add-to-group-container">
                    <h2 class="add-to-group-header text-center mb-4">Personen hinzufügen</h2>

                    <div class="add-to-group-user-list">
                        <input type="hidden" name="user_list" class="d-none">
                        @foreach(Auth::user()->getFriends()->sortBy('last_name') as $user)
                            <div class="group-user-row row mb-3" style="margin:0" data-user-id="{{$user->id}}">
                                <img class="col-2 px-lg-0 user-image-50" src="{{$user->getUserImage()}}" alt="user profile picture"/>
                                <div class="col-8 text-break my-auto">
                                    {{$user->getFullName()}}
                                </div>
                                <button class="add-user col-2 btn {{$group->users->contains($user->id) ? 'd-none' : ''}}"
                                        type="button"><i class="fas fa-lg fa-plus-circle icon-light-green"></i></button>
                                <button
                                    class="remove-user col-2 btn {{$group->users->contains($user->id) ? '' : 'd-none'}}"
                                    type="button"><i class="fas fa-lg fa-minus-circle icon-red"></i></button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if($group->exists)
        <form id="destroy-group-form" action="{{route('group.destroy', $group->id)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
