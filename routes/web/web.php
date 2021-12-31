<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('vote', ['as' => 'pages.vote', 'uses' => 'App\Http\Controllers\PageController@vote']);
		Route::get('results', ['as' => 'pages.results', 'uses' => 'App\Http\Controllers\PageController@results']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile/view/{id}', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('profile/create', ['as' => 'profile.create', 'uses' => 'App\Http\Controllers\ProfileController@create']);
	Route::post('profile/store', ['as' => 'profile.store', 'uses' => 'App\Http\Controllers\ProfileController@store']);
	Route::put('profile/edit/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// Votes
Route::group(['middleware' => 'auth'], function () {
	Route::get('votes/create', ['as' => 'votes.create', 'uses' => 'App\Http\Controllers\VoteController@create']);
	Route::post('votes/store', ['as' => 'votes.store', 'uses' => 'App\Http\Controllers\VoteController@store']);
	Route::get('votes/list', ['as' => 'votes.list', 'uses' => 'App\Http\Controllers\VoteController@list']);
	Route::get('votes/show/{vote_id}', ['as' => 'votes.show', 'uses' => 'App\Http\Controllers\VoteController@show']);
	Route::get('votes/view/{vote_id}', ['as' => 'votes.edit', 'uses' => 'App\Http\Controllers\VoteController@edit']);
	Route::put('votes/edit/{vote_id}', ['as' => 'votes.update', 'uses' => 'App\Http\Controllers\VoteController@update']);
	Route::get('votes/start', ['as' => 'votes.start', 'uses' => 'App\Http\Controllers\VoteController@start']);
	Route::get('votes/check', ['as' => 'votes.check', 'uses' => 'App\Http\Controllers\VoteController@check']);
});

// Nominee
Route::group(['middleware' => 'auth'], function () {
	Route::get('nominee/create/{vote_id}', ['as' => 'nominee.create', 'uses' => 'App\Http\Controllers\NomineeController@create']);
	Route::post('nominee/store/{vote_id}', ['as' => 'nominee.store', 'uses' => 'App\Http\Controllers\NomineeController@store']);
});

// Results
Route::group(['middleware' => 'auth'], function () {
	Route::post('results/check/{vote_id}', ['as' => 'results.check', 'uses' => 'App\Http\Controllers\ResultController@check']);
	Route::post('results/finish', ['as' => 'results.finish', 'uses' => 'App\Http\Controllers\ResultController@finish']);

});