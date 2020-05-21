<?php

namespace App\Http\Controllers;

use App\Posting;
use App\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostingController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'content' => ['required', 'max:1000'],
        ]);

        $posting = new Posting($validatedData);

        $posting->user_id = Auth::user()->id;
        $posting->location_type = 1;
        $posting->location_id = 1;

        $posting->save();

        return redirect()->route('home');
    }

    public function show(Posting $posting)
    {
        //
    }

    public function edit(Posting $posting)
    {
        //
    }

    public function update(Request $request, Posting $posting)
    {
        //
    }

    public function destroy($id)
    {
        $posting = Posting::find($id);
        if ($posting !== null) {
            if ($posting->user_id == Auth::user()->id) {
                $posting->delete();
            }
        }
        return redirect()->route('home');
    }

    public function voting(Request $request)
    {
        $user = Auth::user()->id;
        $existingVoting = Voting::where([['posting_id', $request->postingId], ['user_id', $user]])->first();

        //Für den Post und User existiert noch kein voting
        if ($existingVoting === null) {
            //Neues Voting anlegen
            $voting = new Voting();

            $voting->user_id = $user;
            $voting->posting_id = $request->postingId;
            $voting->is_upvote = $request->isUpvote;

            $voting->save();
        } //Wenn Vote bereits gleicher Vote existiert-> entferne diesen
        elseif ($existingVoting->is_upvote == $request->isUpvote) {
            $existingVoting->delete();
        } //Sonst is_upvote Feld Anpassen
        else {
            $existingVoting->update(['is_upvote' => $request->isUpvote]);
        }
    }
}
