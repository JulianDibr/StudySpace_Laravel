@inject('users','App\User')

<div class="row mb-5 mx-0">
    <div class="col-12">
        <div class="row mb-2">
            <h1 class="friends-headline col-12">Freundschaftvorschläge</h1>
        </div>
        <div class="row">
            @foreach($users->getAllNonFriends() as $user)
                @include('friends.singleContact', ['user' => $user, 'type' => 'recommendation'])
            @endforeach
        </div>
    </div>
</div>
