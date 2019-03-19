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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/post', 'PostController@index')->name('index');
Route::get('/post/create', 'PostController@create')->name('create');
Route::get('/post/edit/{post}', 'PostController@edit')->name('edit');
Route::get('/post/detail/{post}', 'PostController@detail')->name('detail');
Route::get('/post/detailRegular/{post}', 'PostController@detailRegular')->name('detailRegular');
Route::post('/post/storeComment/', 'PostController@storeComment')->name('storeComment');
Route::get('/post/delete/{post}', 'PostController@delete')->name('delete');
Route::post('/post/store/', 'PostController@store')->name('store');

Route::get('/tag', 'TagController@index')->name('index');
Route::get('/tag/create', 'TagController@create')->name('create');
Route::get('/tag/edit/{tag}', 'TagController@edit')->name('edit');
Route::get('/tag/detail/{tag}', 'TagController@detail')->name('detail');
Route::get('/tag/delete/{tag}', 'TagController@delete')->name('delete');
Route::post('/tag/store/', 'TagController@store')->name('store');