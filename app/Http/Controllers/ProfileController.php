<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        $profile = User::find($id);
        if ($profile !== null) {
            //If profile for this id exist -> show profile
            return view('profile.index', compact('profile', $profile));
        } else {
            //Else redirect to home screen
            return redirect()->route('home');
        }
    }

    public function edit(User $profile) {
        //
    }

    public function update(Request $request, User $profile) {
        //
    }

    public function destroy(User $profile) {
        //
    }
}
