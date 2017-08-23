<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web router for your application. These
| router are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return auth()->check() ? view('dashboard') : view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Me route
Route::get('/me', ['middleware' => 'auth', function () {
    return \App\User::withCount('followers', 'following', 'tweets')->find( auth()->user()->id );
}] );

Route::get('/t', function () {
    return view('profile')->with('token', 'sdsd');
});