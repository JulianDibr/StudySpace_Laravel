<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card-background mb-2">
        <div class="row mb-2">
            <div class="col-4">
                <a href="{{ route('profile.show', $user->id) }}">
                    <img src="{{$user->getUserImage()}}" width="100%" alt="user profile picture"/>
                </a>
            </div>
            <div class="px-0 {{$type === "accepted" ? 'col-6' : 'col-8'}}">
                <div>
                    <a href="{{ route('profile.show', $user->id) }}">
                        {{$user->getFullName()}}
                    </a>
                    @if($user->todayBirthday())
                        <i class="ml-2 fas fa-birthday-cake" data-toggle="tooltip" title="{{$user->first_name. " hat heute Geburtstag."}}"></i>
                    @endif
                </div>
                <div>Gemeinsame Freunde: {{$user->getMutualFriendsCount(Auth::user())}}</div>
                <div>Gemeinsame Projekte: Todo</div>
                <div>Gemeinsame Kurse: Todo</div>
            </div>
            @if($type === "accepted")
                <div class="col-2 text-center ">
                    <button class="btn" type="button" data-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item rm-from-friends-link" data-profile-id="{{$user->id}}">Freund entfernen</button>
                    </div>
                </div>
            @endif
        </div>
        @if($type === "pending")
            <div class="row">
                @if($received)
                    <button class="btn col-5 accept-friend-request-btn" data-profile-id="{{$user->id}}">
                        Akzeptieren
                    </button>
                    <button class="btn col-5 offset-2 decline-friend-request-btn" data-profile-id="{{$user->id}}">
                        Ablehnen
                    </button>
                @else
                    <button class="btn col-8 offset-2 cancel-friend-request-btn" data-profile-id="{{$user->id}}">
                        Anfrage zurückziehen
                    </button>
                @endif
            </div>
        @elseif($type === "recommendation")
            <div class="row">
                <button class="btn col-8 offset-2 add-to-friends-btn" data-profile-id="{{$user->id}}">
                    Zu Freunden hinzufügen
                </button>
                <button class="btn col-8 offset-2 cancel-friend-request-btn d-none" data-profile-id="{{$user->id}}">
                    Anfrage zurückziehen
                </button>
            </div>
        @endif
    </div>
</div>
