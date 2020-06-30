<?php

namespace App\Http\Controllers;

use App\Helpers\generateViewHelper;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    public function loadConversation($receiver_id)
    {
        $user = Auth::user();
        $receiver = User::find($receiver_id);

        if (!$receiver) { //If user with this id doesnt exist do nothing
            return false;
        }
        if (!$user->isFriendWith($receiver)) { //Allow conversation if users are friends
            return false;
        }

        $conversation = "";

        if (!$conversation) {
            $conversation = "";
        }

        return response()->json([
            'success' => true,
            'data' => [
                'messageContainer' => generateViewHelper::generateConversationWindow($conversation),
            ]
        ]);
    }
}
