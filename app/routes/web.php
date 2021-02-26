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

Route::redirect('/', '/hamburgers');
Route::get(   '/hamburgers', 'hamburgerController@index')->middleware('auth');
Route::get(   '/hamburgers/create', 'hamburgerController@postHamburgerInformation');
Route::post(  '/hamburgers', 'hamburgerController@UpHamburgerDate')->name('hamburger_store');
Route::get(   '/hamburgers/{id}','hamburgerController@show')->name('hamburger_show');
Route::get(   '/hamburgers/edit/{id}','hamburgerController@edit')->name('post_edit');
Route::post(  '/hamburgers/update','hamburgerController@update')->name('post_update');
Route::post(  '/hamburgers/destroy/{id}','hamburgerController@destroy')->name('post_destroy');
Route::post(  '/hamburgers/{id}/likes', 'hamburgerController@like')->name('post_like');
Route::post(  '/hamburgers/{id}/likes/{like}', 'hamburgerController@unlike')->name('post_unlike');
Route::get(   '/hamburgers/{id}/likes/{like}', 'hamburgerController@unlike');


Auth::routes();





