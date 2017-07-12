<?php

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/control-panel', 'Auth\LoginController@controlPanel')->middleware('auth');
Route::get('/profile', 'Auth\LoginController@profile')->middleware('auth');
Route::get('/users/{user}', 'Auth\LoginController@userTimeline');


Route::get('/wish-list', 'WishListsController@index');
Route::post('/wish-list', 'WishListsController@store');
Route::delete('/wish-list/{car_id}', 'WishListsController@destroy');
Route::get('/messages', 'MessagesController@index');
Route::post('/messages', 'MessagesController@store');
Route::post('/messages/toUser', 'MessagesController@sendMessageToUser');

Route::get('/cars/readLatestPosts', 'SearchController@getLatestCars');
Route::resource('cars', 'CarsController');
Route::get('/my-cars', 'CarsController@myCars');

// ============== Sub Data
Route::get('/readSubData/{data1}/{data2}', 'SubDataController@readSubData'); // readSubData/model/Mercedes
Route::get('/readSubData/{subID}', 'SubDataController@readModelsBySubID'); // readSubData/5
Route::get('/read-data-with-subdata/{data}/{subdata}', 'SubDataController@readDataWithSubdata');
Route::get('/read-subdata-types', 'SubDataController@readSubDataTypes');
Route::post('/subdata', 'SubDataController@store');
Route::patch('/subdata/{sub}', 'SubDataController@update');
Route::delete('/subdata/{sub}', 'SubDataController@destroy');

// ==============  Pics
Route::get('/images-for-car/{car}', 'PicturesController@readPicsByCar');
Route::delete('/images-for-car/{pic}', 'PicturesController@destroyPicByCar');
Route::delete('/images-for-ad/{pic}', 'PicturesController@destroyPicByAd');

// ==============  Search
Route::get('/search/general/{keyword}', 'SearchController@searchGeneral');

Route::post('/search/results', 'SearchController@readResults');

Route::post('/saved-search', 'SavedSearchController@store');
Route::get('/saved-search/{savedSearch}', 'SavedSearchController@getSavedSearch');

// ==============  Messages
Route::get('/read-convs-with-user-info', 'MessagesController@getConvsWithUserInfo');
Route::get('/read-messages-by-conv-id/{convId}', 'MessagesController@getMessagesByConvId');

// ==============  Ads
Route::get('/read-ads', 'AdsController@getAllAds');
Route::get('/read-ads-items/{items}/{type}', 'AdsController@getAdsItems');
Route::get('/read-ads-types', 'AdsController@getAdsTypes');

Route::post('/ads', 'AdsController@store');
Route::delete('/ads/{ad}', 'AdsController@destroy');
Route::patch('/ads/{ad}', 'AdsController@update');
Route::post('/ads/{ad}/pics', 'AdsController@updatePics');
Route::get('/ads/{ad}/pics', 'AdsController@readPics');
