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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sender_list', 'HomeController@getSendersList');
    Route::get('/load_messages', 'MessagesController@getLoadMessages');
    Route::get('/load_latest_messages_chat', 'MessagesController@getLoadLatestMessagesChat');
    Route::post('/mark_read', 'MessagesController@markRead');
    Route::get('/load_unread_messages', 'MessagesController@getLoadMessagesUnread');
    Route::post('/send', 'MessagesController@postSendMessage');
});

// Route::get('/login', 'HomeController@index')->name('home');

