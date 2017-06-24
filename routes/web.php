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
Route::get('/messages', 'MessagesController@index');
Route::post('/messages', 'MessagesController@store');

Route::resource('cars', 'CarsController');
Route::get('/my-cars', 'CarsController@myCars');

// ============== Sub Data
Route::get('/readSubData/{data1}/{data2}', 'SubDataController@readSubData'); // readSubData/model/Mercedes
Route::get('/readSubData/{subID}', 'SubDataController@readModelsBySubID'); // readSubData/5
Route::get('/read-data-with-subdata/{data}/{subdata}', 'SubDataController@readDataWithSubdata'); // readSubData/5


// ==============  Pics
Route::get('/images-for-car/{car}', 'PicturesController@readPicsByCar');
Route::delete('/images-for-car/{pic}', 'PicturesController@destroyPicByCar');
Route::delete('/images-for-ad/{pic}', 'PicturesController@destroyPicByAd');

// ==============  Search
Route::get('/search/general/{keyword}', 'SearchController@searchGeneral');
// Route::get('/search/filter/brand/{brandId}', 'SearchController@readCarsByBrandId');
// Route::post('/search/filter/model', 'SearchController@readCarsByModelIds'); // array of IDs
Route::post('/search/filter/checkedBrands/', 'SearchController@readCheckedBrands');
Route::post('/search/filter/checkedModels/', 'SearchController@readCheckedModels');
Route::post('/search/filter/price-range', 'SearchController@readCarsInPriceRange');


Route::post('/saved-search', 'SavedSearchController@store');

Route::get('/read-convs-with-user-info', 'MessagesController@getConvsWithUserInfo');
Route::get('/read-messages-by-conv-id/{convId}', 'MessagesController@getMessagesByConvId');

// ==============  Ads
Route::get('/read-ads', 'AdsController@getAllAds');
Route::get('/read-ads-types', 'AdsController@getAdsTypes');
Route::post('/ads', 'AdsController@store');
Route::delete('/ads/{ad}', 'AdsController@destroy');
Route::patch('/ads/{ad}', 'AdsController@update');
Route::post('/ads/{ad}/pics', 'AdsController@updatePics');
Route::get('/ads/{ad}/pics', 'AdsController@readPics');
