@extends('layouts.dashboard')

@inject('users', 'App\User')

@section('content')
    <form id="edit-project-form" action="{{$project->exists ? route('project.update', $project) : route('project.store')}}"
          method="POST">
        @csrf
        @if($project->exists)
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-12 col-lg-8 new-project-data-container">
                <div class="card-background">
                    <h1 class="project-headline mb-4">Neues Projekt anlegen</h1>

                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name" class="mb-2">Name des Projekts</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') validation-error-border @enderror"
                                       placeholder="Name des Projekts eingeben"
                                       value="{{old('name', $project->name ?? '')}}">
                                @error('name')
                                <label for="name" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="my-2">Beschreibung des Projekts</label>
                                <input type="text" name="description"
                                       class="form-control @error('description') validation-error-border @enderror"
                                       placeholder="Beschreibung des Projekts eingeben"
                                       value="{{old('description', $project->description ?? '')}}">
                                @error('description')
                                <label for="description" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deadline" class="my-2">Abgabetermin</label>
                                <input type="text" name="deadline"
                                       class="form-control @error('deadline') validation-error-border @enderror"
                                       placeholder="Abgabetermin des Projekts eingeben"
                                       value="{{old('deadline', $project->deadline ?? '')}}">
                                @error('deadline')
                                <label for="deadline" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="user_invite" name="user_invite"
                                       value="1" {{$project->user_invite == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="user_invite">Einladungen erlauben</label>
                            </div>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_open" name="is_open"
                                       value="1" {{$project->is_open == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="is_open">Offenes Projekt</label>
                            </div>
                        </div>
                        <div class="col-3 text-center my-auto">
                            <input type="file" id="image" name="image" class="d-none">
                            <label for="image"><i class="fas fa-camera fa-5x"></i></label>
                        </div>
                    </div>

                    <button type="button"
                            class="submit-project btn green-standard-btn mt-3">{{$project->exists ? 'Projekt updaten' : 'Projekt anlegen'}}</button>
                    @if($project->exists)
                        <button type="button" class="btn red-standard-btn mt-3 ml-2" onclick="$('#destroy-project-form').submit();">Projekt löschen
                        </button>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 mt-5 mt-lg-0">
                <div class="card-background add-to-project-container">
                    <h2 class="add-to-project-header text-center mb-4">Personen hinzufügen</h2>

                    <div class="add-to-project-user-list">
                        <input type="hidden" name="user_list" class="d-none">
                        @foreach(Auth::user()->getFriends()->sortBy('last_name') as $user)
                            <div class="project-user-row row mb-3" style="margin:0" data-user-id="{{$user->id}}">
                                <img class="col-2 px-lg-0" src="{{$user->getUserImage()}}" width="100%"
                                     alt="user profile picture"/>
                                <div class="col-8 text-break my-auto">
                                    {{$user->getFullName()}}
                                </div>
                                <button class="add-user col-2 btn {{$project->users->contains($user->id) ? 'd-none' : ''}}"
                                        type="button"><i class="fas fa-lg fa-plus-circle icon-light-green"></i></button>
                                <button
                                    class="remove-user col-2 btn {{$project->users->contains($user->id) ? '' : 'd-none'}}"
                                    type="button"><i class="fas fa-lg fa-minus-circle icon-red"></i></button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if($project->exists)
        <form id="destroy-project-form" action="{{route('project.destroy', $project->id)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
