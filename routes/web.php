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
Route::post('questions/search', 'QuestionController@search');

Route::resource('answers', 'AnswerController')->only([
    'store'
]);

Route::post('upvotes/select', 'UpvoteController@select');
Route::resource('upvotes', 'UpvoteController')->only([
    'store'
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/admin/users',  'AdminController@users')->name('admin.users' );
Route::get('/admin/users/{id}/login',  'AdminController@userLogin')->name('admin.user.login' );
Route::get('/admin/users/{id}/delete',  'AdminController@userDelete')->name('admin.user.delete' );

Route::post('/delete_question', 'AdminController@deleteQuestion')->name('deleteQuestion');
Route::post('/delete_answer', 'AdminController@deleteAnswer')->name('deleteAnswer');
