<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentVoting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $posting_id, $comment_id = null)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'max:1000'],
        ]);

        $comment = new Comment($validatedData);

        $comment->user_id = Auth::user()->id;
        $comment->posting_id = $posting_id;
        $comment->comment_id = $comment_id == -1 ? null : $comment_id;

        $comment->save();

        return redirect()->back();
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }

    public function voting(Request $request)
    {
        $user = Auth::user()->id;
        $existingVoting = CommentVoting::where([['comment_id', $request->commentId], ['user_id', $user]])->first();

        //Für den Post und User existiert noch kein voting
        if ($existingVoting === null) {
            //Neues Voting anlegen
            $voting = new CommentVoting();

            $voting->user_id = $user;
            $voting->comment_id = $request->commentId;
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
