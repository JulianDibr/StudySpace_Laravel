<div style="padding: 7px 0" class="row text-center mb-4">
    <div class="col-6">
        <button class="btn px-1 conversations-btn active-tab">Konversationen</button>
    </div>
    <div class="col-6">
        <button class="btn px-1 contacts-btn">Kontakte</button>
    </div>
</div>

<div class="conversation-list row">
    <div class="col-12">
        @forelse(Auth::user()->getConversations() as $conversation)
            <button class="btn mb-3 text-left p-0 pl-1 load-conversation" type="button"
                    data-conversation-id="{{$conversation->id}}">
                <div class="row">
                    <img class="col-2 px-lg-0"
                         src="{{$conversation->participants->where('user_id', '!=',  Auth::id())->first()->user->getUserImage()}}"
                         height="50px"
                         alt="user profile picture"/>
                    <div class="col-8 text-break my-auto">
                        <div class="row">
                            <div class="col-12">
                                @foreach($conversation->participants->where('user_id', '!=',  Auth::id()) as $participant)
                                    {{$loop->last ? $participant->user->getFullName() : $participant->user->getFullName() .", "}}
                                @endforeach
                            </div>
                            <div class="col-12 conversation-message-body">
                                {{$conversation->getLatestMessageAttribute()->body}}
                            </div>
                        </div>
                    </div>
                    @if($conversation->userUnreadMessagesCount(Auth::id()))
                        <div class="col-2 text-right px-2 my-auto">
                            <div class="unread-counter">{{$conversation->userUnreadMessagesCount(Auth::id())}}</div>
                        </div>
                    @endif
                </div>
            </button>
        @empty
        @endforelse
    </div>
</div>
<div class="contacts-list row d-none">
    <div class="col-12">
        @foreach(Auth::user()->getFriends() as $contact)
            <button class="btn mb-3 text-left p-0 pl-1 start-conversation" type="button"
                    data-user-id="{{$contact->id}}">
                <div class="row">
                    <img class="col-2 px-lg-0" src="{{$contact->getUserImage()}}" width="100%"
                         alt="user profile picture"/>
                    <div class="col-10 text-break my-auto">
                        {{$contact->getFullName()}}
                    </div>
                </div>
            </button>
        @endforeach
    </div>
</div>
