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
