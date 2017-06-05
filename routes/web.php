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
Route::get('/my-cars', 'CarsController@myCars');

// ============== Sub Data
Route::get('/readSubData/{data1}/{data2}', 'SubDataController@readSubData'); // readSubData/model/Mercedes
Route::get('/readSubData/{subID}', 'SubDataController@readModelsBySubID'); // readSubData/5
Route::get('/read-brands-with-models', 'SubDataController@readBrandsWithModels'); // readSubData/5


// ==============  Pics
Route::get('/images-for-car/{car}', 'PicturesController@readPicsByCar');
Route::delete('/images-for-car/{pic}', 'PicturesController@destroyPicByCar');

// ==============  Search
Route::get('/search/general/{keyword}', 'SearchController@searchGeneral');
// Route::get('/search/filter/brand/{brandId}', 'SearchController@readCarsByBrandId');
// Route::post('/search/filter/model', 'SearchController@readCarsByModelIds'); // array of IDs
Route::post('/search/filter/checkedBrands/', 'SearchController@readCheckedBrands');
Route::post('/search/filter/checkedModels/', 'SearchController@readCheckedModels');