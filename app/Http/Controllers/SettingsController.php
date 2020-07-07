<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {
    public function index() {
        $user = Auth::user();
        return view('settings.settings', compact('user'));
    }

    public function update(Request $request, $id) { //TODO: Validate, Bcyrpt password
        $user = User::find($id);
        $data = array_filter($request->all()); //Filter null elements
        if ($data['birthday'] !== null) {
            $data['birthday'] = Carbon::parse($data['birthday']); //Parse birthday to Carbon object
        }
        $user->update($data);

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
