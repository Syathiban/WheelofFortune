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
Route::get('/adminpanel', function () {
    return view('adminpanel');
});

Route::resource('words','WordController');
Route::resource('game', 'GameController');
Route::resource('questions', 'QuestionController');
Route::resource('categories', 'CategoryController');
Route::resource('highscorelists', 'HighscoreListController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/game', 'GameController@changeCategory');
Route::post('/game/store', 'GameController@store');
