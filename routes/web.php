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

Route::get('questions/user', 'QuestionController@user')->name('questions.user');
Route::resource('questions', 'QuestionController')->only([
    'index', 'create', 'store', 'show'
]);

Route::resource('answers', 'AnswerController')->only([
    'store'
]);

Route::post('upvotes/select', 'UpvoteController@select');
Route::resource('upvotes', 'UpvoteController')->only([
    'store'
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

