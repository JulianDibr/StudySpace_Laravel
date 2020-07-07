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
Route::post('postings/{location_type}/{location_id}', 'PostingController@store')->name('postings.store');
Route::post('postings/voting', 'PostingController@voting')->name('posting.voting');
Route::get('loadPosting/{id}', 'PostingController@show')->name('posting.show');

//Comments
Route::resource('comments', 'CommentController');
Route::post('comments/{posting_id}/{comment_id}', 'CommentController@store')->name('comments.store');
Route::post('comments/voting', 'CommentController@voting')->name('comment.voting');

//Profiles
Route::resource('profile', 'ProfileController');

//School
Route::resource('school', 'SchoolController');
Route::post('school/comments/{posting_id}/{comment_id}', 'CommentController@store')->name('comments.store');

//Groups
Route::get('groups', 'GroupController@index')->name('groups.index');
Route::resource('group', 'GroupController');

//Projects
Route::get('projects', 'ProjectController@index')->name('projects.index');
Route::resource('project', 'ProjectController');

//Friendshipsystem
Route::prefix('friend')->name('friend.')->group(function () {
    Route::post('add/{id}', 'FriendController@sendFriendRequest')->name('add');
    Route::post('remove/{id}', 'FriendController@removeFriend')->name('remove');
    Route::post('accept/{id}', 'FriendController@acceptFriend')->name('accept');
    Route::post('decline/{id}', 'FriendController@declineFriend')->name('decline');
    Route::get('list', 'FriendController@showList')->name('showList');
});

//Courses
Route::get('courses', 'CourseController@index')->name('courses.index');
Route::resource('course', 'CourseController');

//Messages
Route::resource('messages', 'MessageController');
Route::get('messages/create/{id}', 'MessageController@create');

//Calender
Route::resource('calender', 'CalenderController');

//Settings
Route::resource('settings', 'SettingsController');
