<div class="modal fade" id="posting-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div style="max-width: 750px" class="modal-dialog" role="document">
        <div class="modal-content posting-container" data-posting-id="{{$posting->id}}">
            <div class="modal-header border-bottom-0">
                <div class="row w-100">
                    <div class="col-4">
                        <div style="width: 120px; overflow: hidden" class="profile-picture">
                            <a href="{{ route('profile.show', $posting->user->id) }}">
                                <img src="{{$posting->user->getUserImage()}}" height="120px" alt="user profile picture"/>
                            </a>
                        </div>
                    </div>
                    <div class="col-8">
                        <a href="{{ route('profile.show', $posting->user->id) }}">
                            {{$posting->user->first_name ." ". $posting->user->last_name}}
                        </a>
                        @if($posting->location_type !== 0)
                            postete
                            <a href="{{$posting->getLocationRoute()}}">{{$posting->getLocationName()}}</a>
                            {{$posting->location_type == 1 ? " Profil" : ""}}
                        @else
                            postete
                        @endif
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="col-12">{{$posting->content}}</span>
                </div>

                <div class="row mt-3 h-100">
                    <div class="col-4 text-center">
                        <button class="btn posting-vote-down">
                            <i class="fa-lg far fa-thumbs-down {{($posting->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                        </button>
                    </div>
                    <div class="col-4 text-center my-auto">
                        <span>{{$posting->getVoting()}}</span>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn posting-vote-up">
                            <i class="fa-lg far fa-thumbs-up {{($posting->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                        </button>
                    </div>
                </div>

                <div class="row my-3">
                    <form class="col-12" method="post" action="{{ route('comments.store', $posting->id) }}">
                        @csrf
                        <textarea name="content" id="" cols="30" rows="3" class="w-100" placeholder="Kommentieren."></textarea>
                        <button type="submit">Absenden</button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-12">
                        @forelse($posting->comments->where('comment_id', null) as $comment)
                            <div class="row mb-2">
                                <div class="profile-picture col-1 pr-0">
                                    <a href="{{ route('profile.show', $posting->user->id) }}">
                                        <img src="{{$posting->user->getUserImage()}}" width="100%" alt="user profile picture"/>
                                    </a>
                                </div>
                                <span class="col-11">
                                    <div class="row">
                                        <div class="col-12">
                                            {{$posting->user->first_name ." " .$posting->user->last_name." am ".$posting->updated_at}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="col-12">{{$comment->content}}</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <button class="btn">Upvote</button>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn">Downvote</button>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn">Kommentieren</button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            @forelse($comment->comments as $subcomment)
                                <div class="row ml-2 mb-2">
                                    <div class="profile-picture col-1 pr-0">
                                        <a href="{{ route('profile.show', $subcomment->user->id) }}">
                                            <img src="{{$subcomment->user->getUserImage()}}" width="100%" alt="user profile picture"/>
                                        </a>
                                    </div>
                                    <span class="col-11">
                                        <div class="row">
                                            <div class="col-12">
                                                {{$subcomment->user->first_name ." " .$subcomment->user->last_name." am ".$subcomment->updated_at}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-12">{{$subcomment->content}}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <button class="btn">Upvote</button>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn">Downvote</button>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn">Kommentieren</button>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            @empty
                            @endforelse
                        @empty
                            <div class="row">
                                <span class="col-12">Noch keine Kommentare sei der Erste.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
