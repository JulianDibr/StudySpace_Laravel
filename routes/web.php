<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //If logged in redirect to dashboard
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

//Postings
Route::resource('postings', 'PostingController');
Route::post('postings/voting', 'PostingController@voting')->name('posting.voting');

//Profiles
Route::resource('profile', 'ProfileController');

//School
Route::resource('school', 'SchoolController');
