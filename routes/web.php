<?php
use App\Car;
use App\Events\CarPostedEvent;
use App\Notifications\CarPosted;
use App\User;
use Illuminate\Support\Facades\File;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/our-offers', 'HomeController@ourOffers');
Route::get('/our-offers/{id}', 'HomeController@ourOffers');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/control-panel', 'Auth\LoginController@controlPanel')->middleware('auth');
Route::get('/profile', 'Auth\LoginController@profile')->middleware('auth');
Route::get('/users/{user}', 'Auth\LoginController@userTimeline');

// ============== Wishlist
Route::get('/wish-list', 'WishListsController@index');
Route::post('/wish-list', 'WishListsController@store');
Route::delete('/wish-list/{car_id}', 'WishListsController@destroy');
// ============== messages
Route::get('/messages', 'MessagesController@index');
Route::post('/messages', 'MessagesController@store');
Route::post('/messages/toUser', 'MessagesController@sendMessageToUser');
Route::get('/read-convs-with-user-info', 'MessagesController@getConvsWithUserInfo');
Route::get('/read-messages-by-conv-id/{convId}', 'MessagesController@getMessagesByConvId');

// ============== Car
Route::get('/cars/readLatestPosts', 'SearchController@getLatestCars');
Route::resource('cars', 'CarsController');
Route::get('/cars/create', 'CarsController@create')->middleware('check_create_car');
Route::get('/cars/{car}/edit', 'CarsController@edit')->middleware('car_owner');
Route::post('/cars', 'CarsController@store')->middleware('check_create_car');
Route::get('/my-cars', 'CarsController@myCars');
Route::delete('/cars/{car}', 'CarsController@destroy')->middleware('car_owner');

// ============== SubData
Route::get('/readSubData/{data1}/{data2}', 'SubDataController@readSubData'); // readSubData/model/Mercedes
Route::get('/readSubdataBySubID/{ntype2}/{subID}', 'SubDataController@readSubdataBySubID'); // readSubData/5
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
Route::delete('/saved-search/{savedSearch}', 'SavedSearchController@destroy');
Route::get('/my-saved-searches', 'Auth\LoginController@userSavedSearches');


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
	if(auth()->check()){
		return [
			'readNotif' => auth()->user()->readNotifications, 
			'unreadNotif' => auth()->user()->unreadNotifications,
			'user_id' => auth()->id()
		];
	}
});

Route::get('/not/{car}', function(Car $car){ // for test
	Car::notify_users_for_savedSearch($car);
});

Route::get('/get-countries', function(){
	$path = public_path('storage\json') . "\countries.json";
	return response()->json(['data' => File::get($path)]);
});

Route::get('/payment/{plan}', 'Auth\LoginController@getpayment')->middleware('auth');
Route::post('/payment', 'Auth\LoginController@pay')->middleware('auth');

// Route::get('/after-reg', 'Auth\LoginController@afterReg')->middleware('auth');
