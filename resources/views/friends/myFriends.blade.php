<div class="row mb-5 mx-0">
    <div class="col-12">
        <div class="row mb-2">
            <h1 class="friends-headline col-12">Meine Freunde ({{Auth::user()->getFriendsCount()}})</h1>
        </div>
        <div class="row">
            @if(count(Auth::user()->getFriends()) > 0)
                @foreach(Auth::user()->getFriends()->sortBy('last_name') as $friend)
                    @include('friends.singleContact', ['user' => $friend, 'type' => 'accepted'])
                @endforeach
            @else
                <div class="col-12 col-md-6 col-lg-4">
                    Noch keine Freunde hinzugefügt? Schau doch unten durch die Vorschläge
                </div>
            @endif
        </div>
    </div>
</div>
