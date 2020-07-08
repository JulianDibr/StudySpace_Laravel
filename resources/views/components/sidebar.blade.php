<div class="sidebar-wrapper d-none d-md-block pl-0">
    <ul id="sidebar">
        <li class="{{Route::is('home') ? 'nav-active' : ''}}"><a href="{{route('home')}}"><i class="fas fa-house-user mr-2"></i>Feed</a></li>
        <li class="{{Route::is('messages.index') ? 'nav-active' : ''}}"><a href="{{route('messages.index')}}"><i class="fas fa-envelope mr-2"></i>Nachrichten</a></li>
        <li class="{{Route::is('profile.show') ? 'nav-active' : ''}}"><a href="{{ route('profile.show', Auth::id()) }}"><i class="fas fa-user mr-2"></i>Mein Profil</a></li>
{{--        <li class="{{Route::is('calender.index') ? 'nav-active' : ''}}"><a href="{{ route('calender.index') }}"><i class="fas fa-calendar-alt mr-2"></i>Mein Kalender</a></li>--}}
        <li class="{{Route::is('friend.showList') ? 'nav-active' : ''}}"><a href="{{ route('friend.showList') }}"><i class="fas fa-user-friends mr-2"></i>Meine Freunde</a></li>
        <li class="{{Route::is('school.show') ? 'nav-active' : ''}}"><a href="{{ route('school.show', Auth::user()->school->id) }}"><i class="fas fa-school mr-2"></i>Hochschule Hamm-Lippstadt</a></li>
        <li class="{{Route::is('projects.index') ? 'nav-active' : ''}}"><a href="{{route('projects.index')}}"><i class="fas fa-business-time mr-2"></i>Meine Projekte</a></li>
        <li class="{{Route::is('groups.index') ? 'nav-active' : ''}}"><a href="{{route('groups.index')}}"><i class="fas fa-users mr-2"></i>Meine Gruppen</a></li>
        <li class="{{Route::is('courses.index') ? 'nav-active' : ''}}"><a href="{{route('courses.index')}}"><i class="fas fa-chalkboard-teacher mr-2"></i>Meine Kurse</a></li>
        <li class="{{Route::is('settings.index') ? 'nav-active' : ''}}"><a href="{{route('settings.index')}}"><i class="fas fa-cogs mr-2"></i>Einstellungen</a></li>
        <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}</a></li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>
