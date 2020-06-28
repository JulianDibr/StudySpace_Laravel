<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StudySpace') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-studyspace sticky-top">
    <div style="max-width: 100%" class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('/img/logo.png')}}" alt="" height="40px">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->getFullName() }}<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="custom-dropdown-item dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="sidebar-wrapper d-none d-md-block pl-0">
        <ul id="sidebar">
            <li class="{{Route::is('home') ? 'nav-active' : ''}}"><a href="{{route('home')}}"><i class="fas fa-house-user mr-2"></i>Feed</a></li>
            <li class="{{Route::is('home') ? 'nav-active' : ''}}"><a href="{{route('messages.index')}}"><i class="fas fa-envelope mr-2"></i>Nachrichten</a></li>
            <li class="{{Route::is('profile.show') ? 'nav-active' : ''}}"><a href="{{ route('profile.show', Auth::user()->id) }}"><i class="fas fa-user mr-2"></i>Mein Profil</a></li>
            <li class="{{Route::is('friend.showList') ? 'nav-active' : ''}}"><a href="{{ route('friend.showList') }}"><i class="fas fa-user-friends mr-2"></i>Meine Freunde</a></li>
            <li class="{{Route::is() ? 'nav-active' : ''}}"><a href="{{ route('school.show', Auth::user()->school->id) }}"><i class="fas fa-school mr-2"></i>Hochschule Hamm-Lippstadt</a></li>
            <li class="{{Route::is() ? 'nav-active' : ''}}"><a href="{{route('projects.index')}}"><i class="fas fa-business-time mr-2"></i>Meine Projekte</a></li>
            <li class="{{Route::is() ? 'nav-active' : ''}}"><a href="{{route('groups.index')}}"><i class="fas fa-users mr-2"></i>Meine Gruppen</a></li>
            <li class="{{Route::is() ? 'nav-active' : ''}}"><a href="{{route('courses.index')}}"><i class="fas fa-chalkboard-teacher mr-2"></i>Meine Kurse</a></li>
            {{--<li class="{{Route::is() ? 'nav-active' : ''}}"><a href="{{ route('course.show', "1") }}">Kurse 1</a></li>--}}
        </ul>
    </div>

    <div class="home-content overflow-auto">
        <div class="container my-4">
            @yield('content')
        </div>
    </div>
</main>

<div class="footer">

</div>
</body>
</html>
