<?php

namespace App\Http\Controllers;

use App\Helpers\generateViewHelper;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    //Teilweise nach: https://github.com/cmgmyr/laravel-messenger/blob/master/examples/MessagesController.php
    public function index()
    {
        $conversations = Thread::forUser(Auth::id())->latest('updated_at')->get();
        $currentThread = $conversations->first();
        return view('messages.index', compact('conversations', 'currentThread'));
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
        if ($currentThread  && $currentThread instanceof Collection && $currentThread->count() > 0) {
            $this->show($currentThread->first()->id);
        }

        $conversations = Thread::forUser(Auth::id())->latest('updated_at')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'messageContainer' => generateViewHelper::generateNewConversationWindow($conversations, $receiver),
            ]
        ]);
    }

    public function show($conversation_id)
    {
        $thread = Thread::find($conversation_id);

        if(!$thread){
            return response()->json(['success' => false, 'error' => 'Conversation doesnt exist']);
        }

        $userId = Auth::id(); //Current User
//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get(); //Users in conversation (diff current user)

        $thread->markAsRead($userId); //mark as read when opened

        $conversations = Thread::forUser(Auth::id())->latest('updated_at')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'messageContainer' => generateViewHelper::generateConversationWindow($conversations, $thread),
            ]
        ]);
    }

    public function store()
    {
        $input = Request::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
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

        return redirect()->route('messages');
    }

    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
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

        return redirect()->route('messages.show', $id);
    }
}
