<?php

namespace App\Http\Controllers;

use App\Posting;
use App\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function show(Posting $posting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function edit(Posting $posting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posting $posting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posting $posting)
    {
        //
    }

    public function voting(Request $request) {
        $user = Auth::user()->id;
        $existingVoting = Voting::where([['posting_id', $request->postingId], ['user_id', $user]])->first();

        //Für den Post und User existiert noch kein voting
        if($existingVoting === null){
            //Neues Voting anlegen
            $voting = new Voting();

            $voting->user_id = $user;
            $voting->posting_id = $request->postingId;
            $voting->is_upvote = $request->isUpvote;

            $voting->save();
        }
        //Wenn Vote bereits gleicher Vote existiert-> entferne diesen
        elseif($existingVoting->is_upvote == $request->isUpvote){
            $existingVoting->delete();
        }
        //Sonst is_upvote Feld Anpassen
        else{
            $existingVoting->update(['is_upvote' => $request->isUpvote]);
        }
    }
}
