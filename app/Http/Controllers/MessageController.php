<?php

namespace App\Http\Controllers;

use App\Helpers\generateViewHelper;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller {
    //Teilweise nach: https://github.com/cmgmyr/laravel-messenger/blob/master/examples/MessagesController.php
    public function index() {
        $conversations = Thread::forUser(Auth::id())->latest('updated_at')->get();
        $currentThread = $conversations->first(); //Get last chat to open on load

        return view('messages.index', compact('currentThread'));
    }

    public function create($receiver_id) {
        $user = Auth::user();
        $receiver = User::find($receiver_id);

        if (!$receiver) { //If user with this id doesnt exist do nothing
            return response()->json(['success' => false, 'error' => 'This user doesnt exist']);
        }
        if (!$user->isFriendWith($receiver)) { //Allow conversation if users are friends
            return response()->json(['success' => false, 'error' => 'Cant send messages to this user']);
        }

        $currentThread = Thread::between([$user->id, $receiver->id])->get();

        //https://github.com/cmgmyr/laravel-messenger/pull/210
        if ($currentThread && $currentThread instanceof Collection && $currentThread->count() > 0) {
            return $this->show($currentThread->first()->id);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'messageContainer' => generateViewHelper::generateNewConversationWindow($receiver),
            ]
        ]);
    }

    public function show($conversation_id) {
        $thread = Thread::find($conversation_id);

        if (!$thread) {
            return response()->json(['success' => false, 'error' => 'Conversation doesnt exist']);
        }

        $userId = Auth::id(); //Current User
//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get(); //Users in conversation (diff current user)

        $thread->markAsRead($userId); //mark as read when opened

        return $this->showConversation($thread);
    }

    private function showConversation($thread) {
        return response()->json([
            'success' => true,
            'data' => [
                'messageContainer' => generateViewHelper::generateConversationWindow($thread),
            ]
        ]);
    }

    public function store() {
        $input = Request::all();

        $thread = Thread::create([
            'subject' => 'UserChat',
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        return $this->showConversation($thread);
    }

    public function update($id) {
        $thread = Thread::find($id);

        if (!$thread) {
            return response()->json(['success' => false, 'error' => 'Conversation doesnt exist']);
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Request::input('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant(Request::input('recipients'));
        }

        return $this->showConversation($thread);
    }
}
