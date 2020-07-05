<?php

namespace App\Http\Controllers;

use App\Helpers\generateViewHelper;
use App\Posting;
use App\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostingController extends Controller {
    public function store(Request $request, $location_type, $location_id) {
        $validatedData = $request->validate([
            'content' => ['required', 'max:1000'],
        ]);

        if ($this->userAuthForLocation($location_id, $location_type)) {
            $posting = new Posting($validatedData);

            $posting->user_id = Auth::id();
            $posting->location_type = $location_type;
            $posting->location_id = $location_id;
            $posting->user_type = 0; //TODO: Wofür?

            $posting->save();
        }

        return redirect()->back();
    }

    public function show($id) {
        $posting = Posting::find($id);

        return response()->json([
            'success' => true,
            'data' => [
                'modal' => generateViewHelper::generatePostingModal($posting, false),
            ]
        ]);
    }

    public function edit(Posting $posting) {
        //
    }

    public function update(Request $request, Posting $posting) {
        $validatedData = $request->validate([
            'content_update' => ['required', 'max:1000'],
        ]);

        if ($posting->user_id === Auth::id()) {
            $posting->content = $request->content_update;
            $posting->save();
        }

        return redirect()->back();
    }

    public function destroy($id) {
        $posting = Posting::find($id);
        if ($posting !== null) {
            if ($posting->user_id == Auth::id()) {

                foreach ($posting->comments() as $comment) {
                    $comment->votings()->delete();
                    $comment->comments()->votings()->delete();
                    $comment->comments()->delete();
                    $comment->delete();
                }
                $posting->votings()->delete();
                $posting->delete();
            }
        }
        return redirect()->back();
    }

    public function voting(Request $request) {
        $user = Auth::id();
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

        $posting = Posting::find($request->postingId);

        return response()->json([
            'success' => true,
            'data' => [
                'modal' => generateViewHelper::generatePostingModal($posting, true),
            ]
        ]);
    }

    private function userAuthForLocation($location_id, $location_type) {
        $user = Auth::user();

        if ($location_type == 0 && $location_id == 0) {
            return true;
        }

        switch ($location_type) {
            case 0:
                return false;
            case 1:
                return true;
            case 2:
                if ($user->school->id == $location_id) {
                    return true;
                }
                break;
            case 3:
                if ($user->courses->pluck('id')->contains($location_id)) {
                    return true;
                }
                break;
            case 4:
                if ($user->groups->pluck('id')->contains($location_id)) {
                    return true;
                }
                break;
            case 5:
                if ($user->projects->pluck('id')->contains($location_id)) {
                    return true;
                }
                break;
        }

        return false;
    }
}
