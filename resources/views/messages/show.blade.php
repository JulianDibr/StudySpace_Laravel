@php
    empty($currentThread) ? $currentThread = false : ''; //The currently loaded conversation => On site load latest conversation
    empty($receiver) ? $receiver = false : ''; //For creating a new chat
@endphp

<div class="row h-100">
    <div class="col-9 info-messages-container">
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
        <div class="row message-view">
            <div class="col-12">
                @if($currentThread)
                    @forelse($currentThread->messages as $message)
                        @php
                            $currentUsers = $message->user_id === Auth::id();
                        @endphp
                        <div class="w-100 mb-3 {{$currentUsers ? 'text-right' : 'text-left'}}">
                            @if($currentUsers)
                                <span class="message-by-me">
                                    {{$message->body}}
                                </span>
                            @else
                                <span class="message-by-others">
                                    {{$message->body}}
                                </span>
                            @endif
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
                @forelse(Auth::user()->getConversations() as $conversation)
                    <button class="btn text-left p-0 pl-1 load-conversation" type="button"
                            data-conversation-id="{{$conversation->id}}">
                        <div class="row mb-3">
                            <img class="col-2 px-lg-0"
                                 src="{{$conversation->participants->where('user_id', '!=',  Auth::id())->first()->user->getUserImage()}}"
                                 width="100%"
                                 alt="user profile picture"/>
                            <div class="col-8 text-break my-auto">
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
                            <div class="col-2 text-right">
                                <span>{{$conversation->userUnreadMessagesCount(Auth::id()) > 0 ? $conversation->userUnreadMessagesCount(Auth::id()) : ''}}</span>
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
