@extends('layouts.dashboard')

@inject('users', 'App\User')

@section('content')
    <form id="edit-course-form" action="{{$course->exists ? route('course.update', $course) : route('course.store')}}"
          method="POST">
        @csrf
        @if($course->exists)
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-12 col-lg-8 new-course-data-container">
                <div class="card-background">
                    <h1 class="course-headline mb-4">Neuen Kurs anlegen</h1>

                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name" class="mb-2">Name des Kurses</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') validation-error-border @enderror"
                                       placeholder="Name des Kurses eingeben"
                                       value="{{old('name', $course->name ?? '')}}">
                                @error('name')
                                <label for="name" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="mt-2 mb-2">Beschreibung des Kurses</label>
                                <input type="text" name="description"
                                       class="form-control @error('description') validation-error-border @enderror"
                                       placeholder="Beschreibung des Kurses eingeben"
                                       value="{{old('description', $course->description ?? '')}}">
                                @error('description')
                                <label for="description" class="validation-error-text">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3 text-center my-auto">
                            <input type="file" id="image" name="image" class="d-none">
                            <label for="image"><i class="fas fa-camera fa-5x"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teacher" class="mt-2 mb-2">Dozent des Kurses</label>
                        <input type="text" name="teacher"
                               class="form-control @error('teacher') validation-error-border @enderror"
                               placeholder="Dozent des Kurses eingeben"
                               value="{{old('teacher', $course->teacher ?? '')}}">
                        @error('teacher')
                        <label for="teacher" class="validation-error-text">{{ $message }}</label>
                        @enderror
                    </div>

                    <button type="button" class="submit-course btn green-standard-btn mt-3">{{$course->exists ? 'Kurs updaten' : 'Kurs anlegen'}}</button>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 mt-5 mt-lg-0">
                <div class="card-background add-to-course-container">
                    <h2 class="add-to-course-header text-center mb-4">Personen hinzufügen</h2>

                    <div class="add-to-course-user-list">
                        <input type="hidden" name="user_list" class="d-none">
                        @foreach($users::all()->sortBy('last_name') as $user) {{--TODO: Only relevant users--}}
                        <div class="course-user-row row mb-3" style="margin:0" data-user-id="{{$user->id}}">
                            <img class="col-2 px-lg-0" src="{{$user->getUserImage()}}" width="100%"
                                 alt="user profile picture"/>
                            <div class="col-8 text-break my-auto">
                                {{$user->getFullName()}}
                            </div>
                            <button class="add-user col-2 btn {{$course->users->contains($user->id) ? 'd-none' : ''}}"
                                    type="button"><i class="fas fa-lg fa-plus-circle icon-light-green"></i></button>
                            <button
                                class="remove-user col-2 btn {{$course->users->contains($user->id) ? '' : 'd-none'}}"
                                type="button"><i class="fas fa-lg fa-minus-circle icon-red"></i></button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
