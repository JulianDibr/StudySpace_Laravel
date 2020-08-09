<div class="modal fade" id="user-invite-modal" tabindex="-1" role="dialog" aria-labelledby="userInviteModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-title-big">Nutzer einladen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @forelse(Auth::user()->getFriends()->diff($users) as $user)
                    <div class="row mb-3" style="height: 50px">
                        <div class="col-3">
                            <img src="{{$user->getUserImage()}}" alt="" class="user-image-50">
                        </div>
                        <div class="col-6 my-auto">
                            {{$user->getFullName()}}
                        </div>
                        <div class="col-3 my-auto">
                            <button class="btn invite-user" type="button" data-user-id="{{$user->id}}"><i class="far fa-envelope-open"></i></button>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
