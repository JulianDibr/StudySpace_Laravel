<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {
    public function index() {
        $user = Auth::user();
        return view('settings.settings', compact('user'));
    }

    public function update(Request $request, User $user) {
        
        return redirect()->route('settings.index');
    }

    public function destroy($id) {
        $user = Auth::user();

        if ($user->id == $id) {
            Auth::logout();

            $user->delete(); //TODO: DELETE

            return redirect()->route('/');
        }

        return redirect()->back();
    }
}
