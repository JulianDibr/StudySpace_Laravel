@if(count(Auth::user()->getPendingFriendships()) > 0)
    <div class="row mb-5 mx-0">
        <div class="col-12">
            <div class="row mb-2">
                <h1 class="friends-headline col-12">Meine Freundschaftsanfragen</h1>
            </div>
            <div class="row">
                @foreach(Auth::user()->getFriendRequests()->sortBy('last_name') as $friend)
                    @if(Auth::id() !== $friend->sender->id)
                        @include('friends.singleContact', ['user' => $friend->sender, 'type' => 'pending', 'received' => true])
                    @endif
                @endforeach
                    @foreach(Auth::user()->getPendingFriendships()->sortBy('last_name') as $friend)
                    @if(Auth::id() !== $friend->recipient->id)
                        @include('friends.singleContact', ['user' => $friend->recipient, 'type' => 'pending', 'received' => false])
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
