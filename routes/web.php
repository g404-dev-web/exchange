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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::resource('questions', 'QuestionController')->only([
    'index', 'create', 'store', 'show'
]);

Route::resource('answers', 'AnswerController')->only([
    'store'
]);

Route::resource('upvotes', 'UpvoteController')->only([
    'store'
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

