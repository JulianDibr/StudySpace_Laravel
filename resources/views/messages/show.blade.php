<div class="row h-100">
    <div class="col-9 info-messages-container">
        <div class="row info-header">
            <div class="col-9">
                @foreach($currentThread->participants->where('user_id', '!=',  Auth::id()) as $participant)
                    {{$loop->last ? $participant->user->getFullName() : $participant->user->getFullName() .", "}}
                @endforeach
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row message-view">
            <div class="col-12">
                @forelse($currentThread->messages as $message)
                    <div class="row">
                        <div class="col-12">
                            {{$message->body}}
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="row message-input-container">
            <input type="text" class="message-input">
        </div>
    </div>
    <div class="col-3 contact-conversation-list-container">
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
                @forelse($conversations as $conversation)
                    <button class="btn text-left p-0 pl-1 load-conversation" type="button"
                            data-conversation-id="{{$conversation->id}}">
                        <div class="row mb-3">
                            <img class="col-2 px-lg-0"
                                 src="{{$conversation->participants->where('user_id', '!=',  Auth::id())->first()->user->getUserImage()}}"
                                 width="100%"
                                 alt="user profile picture"/>
                            <div class="col-10 text-break my-auto">
                                <div class="row">
                                    <div class="col-12">
                                        @foreach($conversation->participants->where('user_id', '!=',  Auth::id()) as $participant)
                                            {{$loop->last ? $participant->user->getFullName() : $participant->user->getFullName() .", "}}
                                        @endforeach
                                    </div>
                                    <div class="col-12">
                                        {{$conversation->getLatestMessageAttribute()->body}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                @empty
                @endforelse
            </div>
        </div>
        <div class="contacts-list row d-none">
            <div class="col-12">
                @foreach(Auth::user()->getFriends() as $contact)
                    <button class="btn text-left p-0 pl-1 start-conversation" type="button"
                            data-user-id="{{$contact->id}}">
                        <div class="row mb-3">
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
    </div>
</div>
