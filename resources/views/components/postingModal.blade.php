@if(!$contentOnly)
    <div class="modal fade" id="posting-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div style="max-width: 750px" class="modal-dialog" role="document">
            <div class="modal-content posting-container" data-posting-id="{{$posting->id}}">
                @endif
                <div class="modal-body">
                    <div class="row w-100">
                        <div class="col-4">
                            <div style="width: 100px; overflow: hidden" class="profile-picture mx-auto">
                                <a href="{{ route('profile.show', $posting->user->id) }}">
                                    <img src="{{$posting->user->getUserImage()}}" class="user-image-100"
                                         alt="user profile picture"/>
                                </a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-10">
                                    <a href="{{ route('profile.show', $posting->user->id) }}">
                                        {{$posting->user->getFullName()}}
                                    </a>
                                    @if($posting->location_type !== 0)
                                        postete
                                        <a href="{{$posting->getLocationRoute()}}">{{$posting->getLocationName()}}</a>
                                        {{$posting->location_type == 1 ? " Profil" : ""}}
                                    @else
                                        postete
                                    @endif
                                </div>

                                <div class="col-2">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            @if($posting->content)
                                <div class="row mt-5">
                                    <span class="col-12">{{$posting->content}}</span>
                                </div>
                            @endif

                            @if($posting->getFirstMedia('uploads'))
                                @php
                                    $media = $posting->getFirstMedia('uploads');
                                @endphp
                                <div class="row mt-3">
                                    @if(strpos($media->mime_type, "image") !== false)
                                        <img src="{{$media->getUrl()}}" alt="" width="100%">
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3 h-100">
                        <div class="col-2 offset-3 text-center">
                            <button class="btn posting-vote-up">
                                <i class="fa-lg far fa-thumbs-up {{($posting->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                            </button>
                        </div>
                        <div class="col-2 text-center my-auto">
                            <span>{{$posting->getVoting()}}</span>
                        </div>
                        <div class="col-2 text-center">
                            <button class="btn posting-vote-down">
                                <i class="fa-lg far fa-thumbs-down {{($posting->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row my-3">
                        <form class="col-12" method="post" action="{{ route('comments.store', [$posting->id, -1]) }}">
                            @csrf
                            <textarea name="content" style="height: 75px"
                                      class="p-2 posting-content {{$errors->has('content') ?'validation-error-border' : 'border'}}"
                                      placeholder="Kommentar schreiben"></textarea>
                            <div class="row">
                                <button class="btn col-2 offset-10 submit-comment" type="button">
                                    <i class="fa-lg far fa-check-circle icon-light-green"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @forelse($posting->comments->where('comment_id', null)->sortByDesc('created_at') as $comment)
                                <div class="comment-container {{!$loop->first ? 'mt-3' : ''}}" data-comment-id="{{$comment->id}}">
                                    <div class="row">
                                        <div class="profile-picture col-1 pr-0">
                                            <a href="{{ route('profile.show', $comment->user->id) }}">
                                                <img src="{{$comment->user->getUserImage()}}" class="user-image-50" alt="user profile picture"/>
                                            </a>
                                        </div>
                                        <span class="col-11">
                                            <div class="row">
                                                <div class="{{$comment->ownComment() ? 'col-10' : 'col-12'}}">
                                                    {{$comment->user->getFullName()." am ".$comment->updated_at}}
                                                </div>
                                                @if($comment->ownComment())
                                                    <div class="col-2 px-0 text-center">
                                                        <button class="btn" type="button" data-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit-comment">Kommentar editieren</a>
                                                            <a class="dropdown-item delete-comment" data-comment-id="{{$comment->id}}">Kommentar löschen</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <p class="col-12 posting-content mb-0">{{$comment->content}}</p>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 offset-1 pl-1 text-left">
                                            <button class="btn comment-vote-up">
                                                <i class="fa-lg far fa-thumbs-up {{($comment->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                                            </button>
                                            <span>{{$comment->getVoting()}}</span>
                                            <button class="btn comment-vote-down">
                                                <i class="fa-lg far fa-thumbs-down {{($comment->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                                            </button>
                                            <button class="btn open-comment-field">
                                                <i class="fa-lg far fa-comments"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row my-3 d-none comment-form">
                                        <form class="col-11 offset-1" method="post"
                                              action="{{ route('comments.store', [$posting->id, $comment->id]) }}">
                                            @csrf
                                            <textarea name="content" style="height: 50px"
                                                      class="p-2 posting-content {{$errors->has('content') ?'validation-error-border' : 'border'}}"
                                                      placeholder="Kommentar schreiben"></textarea>
                                            <div class="row">
                                                <button class="btn col-2 offset-10 submit-comment" type="button">
                                                    <i class="fa-lg far fa-check-circle icon-light-green"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @forelse($comment->comments->sortByDesc('created_at') as $subcomment)
                                    <div class="comment-container mt-2" data-comment-id="{{$subcomment->id}}">
                                        <div class="row ml-2">
                                            <div class="profile-picture col-1 pr-0">
                                                <a href="{{ route('profile.show', $subcomment->user->id) }}">
                                                    <img src="{{$subcomment->user->getUserImage()}}" class="user-image-50" alt="user profile picture"/>
                                                </a>
                                            </div>
                                            <span class="col-11">
                                        <div class="row">
                                            <div class="{{$subcomment->ownComment() ? 'col-10' : 'col-12'}}">
                                                {{$subcomment->user->getFullName()." am ".$subcomment->updated_at}}
                                            </div>
                                            @if($subcomment->ownComment())
                                                <div class="col-2 px-0 text-center">
                                                    <button class="btn" type="button" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit-comment">Kommentar editieren</a>
                                                        <a class="dropdown-item delete-comment" data-comment-id="{{$subcomment->id}}">Kommentar löschen</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <p class="col-12 posting-content mb-0">{{$subcomment->content}}</p>
                                        </div>
                                    </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-1 text-left">
                                                <button class="btn comment-vote-up pl-4">
                                                    <i class="fa-lg far fa-thumbs-up {{($subcomment->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                                                </button>
                                                <span>{{$subcomment->getVoting()}}</span>
                                                <button class="btn comment-vote-down">
                                                    <i class="fa-lg far fa-thumbs-down {{($subcomment->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                                                </button>
                                            </div>
                                        </div>
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
                @if(!$contentOnly)
            </div>
        </div>
    </div>
@endif
