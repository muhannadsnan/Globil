<?php

use App\Car;
use App\Events\CarPostedEvent;
use App\Notifications\CarPosted;
use App\User;

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

Route::get('/mark-notif-as-read', function(){
	if(auth()->check())
		auth()->user()->unreadNotifications->markAsRead();
});

Route::get('/get-notif', function(){
	if(auth()->check())
		return ['readNotif' => auth()->user()->readNotifications, 'unreadNotif' => auth()->user()->unreadNotifications];
});


Route::get('/not/{car}', function(Car $car){
	// $usersToNotify = User::whereIn('id', [1,3])->get();
	$usersToNotify = auth()->user();
	Notification::send($usersToNotify, new CarPosted($car));

	echo "Count notifications is: ". count(auth()->user()->unreadNotifications). "<br>";
	foreach (auth()->user()->unreadNotifications as $not) {
		echo $not->data['car']['brand'] ."<br>";
	}

	broadcast(new CarPostedEvent(auth()->user(), $car));

});


Route::get('/get-auth-user', function(){ return ['data'=>auth()->id()]; });