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
        $posting = new Posting($request->all());

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

        $existingVoting = Voting::where([['posting_id', $request->posting_id], ['user_id', $user]])->first();

        if($existingVoting === null){
            $voting = new Voting();

            $voting->user_id = $user;
            $voting->posting_id = $request->postingId;
            $voting->is_upvote = $request->isUpvote;

            $voting->save();
        }
    }
}
