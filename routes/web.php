<?php

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/control-panel', 'Auth\LoginController@controlPanel');
Route::get('/profile', 'Auth\LoginController@profile');


Route::get('/wish-list', 'WishListsController@index');
Route::post('/wish-list', 'WishListsController@store');
Route::delete('/wish-list/{wish}', 'WishListsController@destroy');
// Route::get('/messages', 'MessagesController@index');

Route::resource('cars', 'CarsController');


// ============== Sub Data
Route::get('/readSubData/{data1}/{data2}', 'SubDataController@readSubData'); // readSubData/model/Mercedes