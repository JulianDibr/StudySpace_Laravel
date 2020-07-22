<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

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

        if ($request->profile_picture !== null) {
            $this->saveUserImage($request, $user);
        }

        return redirect()->route('settings.index');
    }

    public function saveUserImage($request, $user) {
        $image = $request->file('profile_picture');
        $name = strtolower('profile_' . str_pad($user->id, 4, "0", STR_PAD_LEFT) . '.' . $image->getClientOriginalExtension());
        $dest = storage_path('app/public/profile_pictures/users/');
        $image_resized = Image::make($image->getRealPath());
        $image_resized->resize(1400, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image_resized->save($dest . $name);
        $user->profile_picture = $name;
        $user->save();
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
