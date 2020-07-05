<?php

namespace App\Http\Controllers;

use App\Calender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller {
    public function index() {
        $calender = Auth::user()->calender;
        return view('calender.index', compact('calender'));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(Calender $calender) {
        //
    }

    public function edit(Calender $calender) {
        //
    }

    public function update(Request $request, Calender $calender) {
        //
    }

    public function destroy(Calender $calender) {
        //
    }
}
