{{--
    Gets:
    $user
--}}

<div class="col-12 col-md-6 col-lg-4">
    <div class="row">
        <div class="col-4">
            <a href="{{ route('profile.show', $user->id) }}">
                <img src="{{$user->getUserImage()}}" width="100%" alt="user profile picture"/>
            </a>
        </div>
        <div class="col-8">
            <div>
                <a href="{{ route('profile.show', $user->id) }}">
                    {{$user->first_name ." ".$user->last_name}}
                </a>
            </div>
            <div>Gemeinsame Freunde: {{$user->getMutualFriendsCount(Auth::user())}}</div>
            <div>Gemeinsame Projekte: Todo</div>
            <div>Gemeinsame Kurse: Todo</div>
        </div>
    </div>
</div>
