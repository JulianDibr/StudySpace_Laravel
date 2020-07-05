<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {
    public function index() {
        $settings = Auth::user()->settings();
        return view('settings.settings', compact('settings'));
    }

    public function update(Request $request, Settings $settings) {
        //
    }
}
