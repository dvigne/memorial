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

Route::resource('/', 'CommentsController')->only('index');
Route::resource('comments', 'CommentsController')
  ->except('index')
  ->middleware('auth');
Route::get('photos', 'PhotosController@index')->name('photos');
Auth::routes();
