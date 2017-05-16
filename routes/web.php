<?php

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/control-panel', 'Auth\LoginController@controlPanel');
Route::get('/profile', 'Auth\LoginController@profile');


Route::get('/wish-list', 'WishListsController@wishList');
// Route::get('/messages', 'MessagesController@index');

Route::resource('car', 'CarsController');
