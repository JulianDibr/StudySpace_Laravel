<div class="card-columns">
    <div class="posting-container card mb-2 mt-2 p-3">
        <form method="POST" action="{{ route('postings.store', [$location_type, $location_id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="row mt-3">
                <div class="col-3 my-auto">
                    <div class="profile-picture">
                        <img src="{{Auth::user()->getUserImage()}}" width="100%" alt="user profile picture"/>
                    </div>
                </div>
                <div class="col-9 pl-0">
                            <textarea name="content" style="min-height: 100px"
                                      class="p-2 posting-content {{$errors->has('content') ?'validation-error-border' : 'border'}}"
                                      placeholder="Was möchtest du posten?"></textarea>
                    @error('content')
                    <span class="validation-error-text">Ein Post darf nicht leer sein</span>
                    @enderror
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-4 text-center">
                    <button class="new-posting-reset btn" type="button">
                        <i class="fa-lg far fa-times-circle"></i>
                    </button>
                </div>
                <div class="col-4 text-center">
                    <label for="file" class="cursor-pointer mb-0 p-2"><i class="fa-lg fas fa-file-upload"></i></label>
                    <input type="file" name="file" id="file" class="d-none">
                </div>
                <div class="col-4 text-center">
                    <button class="btn">
                        <i class="fa-lg far fa-check-circle icon-light-green"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @forelse($postingArr as $posting)
        <div class="posting-container card mb-2 mt-2 p-3" data-posting-id="{{$posting->id}}">
            <div class="row h-100">
                <div class="col-3 my-auto">
                    <div class="profile-picture">
                        <a href="{{ route('profile.show', $posting->user->id) }}">
                            <img src="{{$posting->user->getUserImage()}}" width="100%" alt="user profile picture"/>
                        </a>
                    </div>
                </div>
                <div class="{{($posting->ownPosting()) ? 'col-7' : 'col-9'}} pl-0">
                    <div class="row">
                            <span class="posting-location-name col-12">
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
                            </span>
                    </div>
                    <div class="row">
                        <span class="posting-time col-12">am {{$posting->updated_at}}</span>
                    </div>
                </div>
                @if($posting->ownPosting())
                    <div class="col-2 px-0 text-center ">
                        <button class="btn" type="button" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item edit-posting-btn">Beitrag editieren</button>
                            <a class="dropdown-item" onclick="$(this).next('.destroy-posting').submit()">Beitrag
                                löschen</a>
                            <form class="destroy-posting d-none"
                                  action="{{ route('postings.destroy', $posting->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <div>
                <div class="row my-3">
                    <div class="col-12 posting-content-container">
                        @if($posting->content)
                            <p class="p-2 posting-content posting-content-trigger">{{$posting->content}}</p>
                        @endif
                        @if($posting->getFirstMedia('uploads'))
                            @php
                                $media = $posting->getFirstMedia('uploads');
                            @endphp

                            @if(strpos($media->mime_type, "image") !== false)
                                <img src="{{$media->getUrl()}}" alt="" width="100%">
                            @else
                                    <a class="white-standard-btn" href="{{route('posting.downloadFile', $media->id)}}"><i class="fas fa-download mr-2"></i>{{$media->name}}</a>
{{--                                <button class="btn white-standard-btn download-file" data-media-id="{{$media->id}}"><i class="fas fa-download mr-2"></i>{{$media->name}}</button>--}}
                            @endif
                        @endif
                        <div class="edit-posting-container d-none">
                            <form action="{{route('postings.update', $posting->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="content_update" style="min-height: 100px"
                                          class="p-2 posting-content {{$errors->has('content') ?'validation-error-border' : 'border'}}"
                                          placeholder="Was möchtest du posten?">{{$posting->content}}</textarea>
                                <div class="row mt-1">
                                    <div class="col-6 text-center">
                                        <button class="cancel-posting-edit btn" type="button">
                                            <i class="fa-lg far fa-times-circle"></i>
                                        </button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button class="btn submit-posting-edit">
                                            <i class="fa-lg far fa-check-circle icon-light-green"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 h-100">
                    <div class="col-3 text-center">
                        <button class="btn posting-vote-up">
                            <i class="fa-lg far fa-thumbs-up {{($posting->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                        </button>
                    </div>
                    <div class="col-2 text-center my-auto">
                        <span>{{$posting->getVoting()}}</span>
                    </div>
                    <div class="col-3 text-center">
                        <button class="btn posting-vote-down">
                            <i class="fa-lg far fa-thumbs-down {{($posting->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                        </button>
                    </div>
                    <div class="col-3 text-center">
                        <button class="btn open-posting">
                            <i class="fa-lg far fa-comments posting-open-modal"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>

<div id="posting-modal-wrapper">

</div>
