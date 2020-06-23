@if(count(Auth::user()->getPendingFriendships()) > 0)
    <div class="row mb-3 mx-0">
        <div class="col-12">
            <div class="row">
                <h1 class="friends-headline col-12">Meine Freundschaftsanfragen</h1>
            </div>
            <div class="row">
                @foreach(Auth::user()->getPendingFriendships()->sortBy('last_name') as $friend)
                    @include('friends.singleContact', ['user' => $friend, 'type' => 'pending'])
                @endforeach
            </div>
        </div>
    </div>
@endif
