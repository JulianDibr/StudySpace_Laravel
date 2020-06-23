<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function showList()
    {
        return view('friends.index');
    }

    public function sendFriendRequest($id)
    {
        $receipient = User::find($id);
        if ($receipient) {
            Auth::user()->befriend($receipient);
        }
    }

    public function removeFriend($id)
    {
        $receipient = User::find($id);
        if ($receipient) {
            Auth::user()->unfriend($receipient);
        }
    }
}
