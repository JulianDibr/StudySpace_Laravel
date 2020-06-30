<div class="row h-100">
    <div class="col-9 info-messages-container">
        <div class="row info-header">
            <div class="col-9">
                {{$receiver->getFullName()}}
            </div>
            <div class="col-3">
                Was anderes?
            </div>
        </div>
        <div class="row message-view">

        </div>
        <div class="row message-input-container">

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
            @forelse($conversations as $conversation)
                <button class="btn text-left p-0 pl-1 load-conversation" type="button" data-conversation-id="{{$conversation->id}}">
                    <div class="row mb-3">
                        <img class="col-2 px-lg-0" src="{{--{{$contact->getUserImage()}}--}}" width="100%"
                             alt="user profile picture"/>
                        <div class="col-10 text-break my-auto">
                            test
                            {{--                            {{$contact->getFullName()}}--}}
                        </div>
                    </div>
                </button>
            @empty
            @endforelse
        </div>
        <div class="contacts-list row d-none">
            <div class="col-12">
                @foreach(Auth::user()->getFriends() as $contact)
                    <button class="btn text-left p-0 pl-1 start-conversation" type="button" data-user-id="{{$contact->id}}">
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
