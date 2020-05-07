@extends('layouts.dashboard')

@inject('postings','App\Posting')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="posting-container mb-2 mt-2 p-3">
                <div class="row h-100">
                    <div class="col-3 my-auto">
                        <div class="profile-picture">
                            <img src="{{asset('/img/user_default.png')}}" width="100%" alt="user profile picture"/>
                        </div>
                    </div>
                    <div class="col-9 my-auto">
                    </div>
                </div>

                <form method="post" action="{{ route('postings.store') }}">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-12">
                            <textarea name="content" class="p-2 posting-content border"
                                      placeholder="Was möchtest du posten?"></textarea>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-6 text-center">
                            <button class="new-posting-reset btn" type="button">
                                <i class="fa-lg far fa-times-circle"></i>
                            </button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn">
                                <i class="fa-lg far fa-check-circle icon-light-green"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @forelse($postings::all()->sortByDesc('updated_at') as $posting)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="posting-container mb-2 mt-2 p-3" data-posting-id="{{$posting->id}}">
                    <div class="row h-100">
                        <div class="col-3 my-auto">
                            <div class="profile-picture">
                                <img src="{{asset('/img/user_default.png')}}" width="100%" alt="user profile picture"/>
                            </div>
                        </div>
                        <div class="col-7 pl-0">
                            <div class="row">
                            <span
                                class="posting-location-name col-12">{{$posting->user->name}} postete in {{$posting->location_id}}</span>
                            </div>
                            <div class="row">
                                <span class="posting-time col-12">am {{$posting->updated_at}}</span>
                            </div>
                        </div>
                        <div class="col-2 px-0 text-center">
                            <button class="btn">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
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
                                <!--TODO: Active/Inactive based on users_vote-->
                                <button class="btn posting-vote-down">
                                    <i class="fa-lg far fa-thumbs-down {{($posting->getIsUpvoted()) ? 'icon-red-active' : 'icon-red'}}"></i>
                                </button>
                            </div>
                            <div class="col-2 text-center my-auto">
                                <span>{{$posting->getVoting()}}</span>
                            </div>
                            <div class="col-3 text-center">
                                <button class="btn posting-vote-up">
                                    <i class="fa-lg far fa-thumbs-up {{($posting->getIsDownvoted()) ? 'icon-light-green-active' : 'icon-light-green'}}"></i>
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
