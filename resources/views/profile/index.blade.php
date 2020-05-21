@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    {{--Get $profile from controller--}}
    {{--Profile data--}}
    <div class="row">
        <div class="col-9">

        </div>
        <div class="col-3">
            <img src="{{asset('/img/user_default.png')}}" alt="profile picture" width="100%" class="rounded-circle">
        </div>
    </div>
    {{--Postings--}}
    <div class="row">
        @forelse($postings->getByUser($profile->id) as $posting)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="posting-container mb-2 mt-2 p-3" data-posting-id="{{$posting->id}}">
                    <div class="row h-100">
                        <div class="col-3 my-auto">
                            <div class="profile-picture">
                                <a href="{{ route('profile.show', $posting->user->id) }}">
                                    <img src="{{asset('/img/user_default.png')}}" width="100%"
                                         alt="user profile picture"/>
                                </a>
                            </div>
                        </div>
                        <div class="{{($posting->ownPosting()) ? 'col-7' : 'col-9'}} pl-0">
                            <div class="row">
                            <span class="posting-location-name col-12">
                                <a href="{{ route('profile.show', $posting->user->id) }}">
                                    {{$posting->user->first_name}} {{$posting->user->last_name}}
                                </a>
                                postete in {{$posting->location_id}}
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
                                    <a class="dropdown-item" href="{{ route('postings.edit', $posting->id) }}">Beitrag
                                        editieren</a>
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
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="content" class="p-2 posting-content"
                                          readonly>{{$posting->content}}</textarea>
                            </div>
                        </div>

                        <div class="row mt-1 h-100">
                            <div class="col-3 text-center">
                                <button class="btn posting-vote-down">
                                    <i class="fa-lg far fa-thumbs-down {{($posting->getIsDownvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                                </button>
                            </div>
                            <div class="col-2 text-center my-auto">
                                <span>{{$posting->getVoting()}}</span>
                            </div>
                            <div class="col-3 text-center">
                                <button class="btn posting-vote-up">
                                    <i class="fa-lg far fa-thumbs-up {{($posting->getIsUpvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
                                </button>
                            </div>
                            <div class="col-3 text-center">
                                <button class="btn">
                                    <i class="fa-lg far fa-comments posting-open-modal"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
