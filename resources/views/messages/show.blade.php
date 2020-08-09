@php
    empty($currentThread) ? $currentThread = false : ''; //The currently loaded conversation => On site load latest conversation
    empty($receiver) ? $receiver = false : ''; //For creating a new chat
@endphp

<div class="h-100">
    <div class="info-messages-container h-100">
        <div class="row info-header">
            <div class="col-9">
                @if($currentThread)
                    @foreach($currentThread->participants->where('user_id', '!=',  Auth::id()) as $participant)
                        {{$loop->last ? $participant->user->getFullName() : $participant->user->getFullName() .", "}}
                    @endforeach
                @elseif($receiver)
                    {{$receiver->getFullName()}}
                @else
                    Wählen Sie einen Chat aus oder starten Sie einen neuen
                @endif
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row message-view no-scrollbar">
            <div class="col-12 message-view-inner">
                @if($currentThread)
                    @forelse($currentThread->messages as $message)
                        @php
                            $currentUsers = $message->user_id === Auth::id();
                        @endphp
                        <div class="{{$currentUsers ? 'message-by-me' : 'message-by-others'}}">
                            <span>{{$message->body}}</span>
                            <br>
                            <span class="message-timestamp">{{$message->created_at->format('d.m.Y H:i:s')}}</span>
                        </div>
                    @empty
                    @endforelse
                @endif
            </div>
        </div>
        <div class="row message-input-row">
            <div class="message-input-container">
                @if($currentThread)
                    <input type="text" class="message-input">
                    <button type="button" class="submit-message-to-conversation message-send-btn btn" data-conversation-id="{{$currentThread->id}}"><i
                            class="far fa-paper-plane"></i></button>
                @elseif($receiver)
                    <input type="text" class="message-input">
                    <input type="hidden" class="message-recipient" value="{{$receiver->id}}">
                    <button type="button" class="start-new-conversation message-send-btn btn"><i class="far fa-paper-plane"></i></button>
                @endif
            </div>
        </div>
    </div>
    <div class="contact-conversation-list-container h-100">
        <div style="padding: 7px 0" class="row text-center mb-4 mx-0">
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
                    <div>
                        <button class="btn mb-0 text-left p-0 pl-1 load-conversation" type="button"
                                data-conversation-id="{{$conversation->id}}">
                            <img class="px-lg-0 user-image-35 mr-2" style="margin-top: -40px"
                                 src="{{$conversation->participants->where('user_id', '!=',  Auth::id())->first()->user->getUserImage()}}"
                                 alt="user profile picture"/>
                            <div class="text-break my-auto d-inline-block">
                                    @foreach($conversation->participants->where('user_id', '!=',  Auth::id()) as $participant)
                                        {{$loop->last ? $participant->user->getFullName() : $participant->user->getFullName() .", "}}
                                    @endforeach
                                <div class="conversation-message-body">
                                    {{$conversation->getLatestMessageAttribute()->body}}
                                </div>
                            </div>
                            @if($conversation->userUnreadMessagesCount(Auth::id()))
                                <div class="text-right px-2 my-auto">
                                    <div class="unread-counter">{{$conversation->userUnreadMessagesCount(Auth::id())}}</div>
                                </div>
                            @endif
                        </button>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="contacts-list d-none">
            @foreach(Auth::user()->getFriends() as $contact)
                <div>
                    <button class="btn mb-3 text-left p-0 pl-1 start-conversation" type="button" data-user-id="{{$contact->id}}">
                        <img class="px-lg-0 user-image-35 mr-2" src="{{$contact->getUserImage()}}" alt="user profile picture"/>
                        <div class="text-break my-auto d-inline-block">
                            {{$contact->getFullName()}}
                        </div>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
