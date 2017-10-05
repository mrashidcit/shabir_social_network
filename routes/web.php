<?php

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


Route::get('/count',function() {
   $count = App\notifcations::where('status', 1)
   ->where('user_hero', Auth::user()->id)->count();
   echo $count;
});

Route::get('/', function () {
return view('welcome');
});
 Route::get('/request','profileController@request');
 Route::get('/addFriend/{id}', 'ProfileController@sendRequest');
 Route::get('profile/{slug}', 'profileController@index');
Route::get('/friends','profileController@Findfriends');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', 'postController@index')->name('home');
Route::get('/notifications/{id}', 'ProfileController@notifications');
Route::get('/changepic', function(){
    return view('profile.pic');
});
Route::post('comment/{post_id}','postController@Comments');
Route::get('likes/{id}/{p_note}','postController@update');
Route::get('Unlikes/{id}/{p_note}','postController@Unlike');
Route::get('id','postController@show');
Route::post('postsend/{id}','postController@store');
Route::get('/accept/{name}/{id}','profileController@accept');
Route::get('/editprofile/{slug}',function(){
    return view('profile.edit')->with('data', Auth::user()->profile);
});
Route::POST('upload','profileController@uploadimg');
Route::POST('updateprofile','profileController@updateprofile');
});

Route::get('notifcations','profileController@notifications');
Route::get('friendlist','profileController@friends');
Route::get('requestRemove/{id}','profileController@requestRemove');
Route::get('friendRemove/{name}/{id}','profileController@friendRemove');