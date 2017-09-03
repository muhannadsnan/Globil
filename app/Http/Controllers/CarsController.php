<?php

namespace App\Http\Controllers;

use App\Car;
use App\Notifications\CarPosted;
use App\Picture;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CarsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['show', 'getLatestPosts']);	  
		// View::addExtension('html', 'php');
	}

// ==================  CREATE CAR  ====================

	public function create()
	{ 
		if(@auth()->user()->plan() == 'standard')
			Session::flash('info', "Dear user, you are subscribed to standard plan, and this is the only car you can publish. Your membership expires in (".@auth()->user()->daysRemaining().") days.");
		
		return view('cars.create', compact(''));
	}

	public function store(Request $request) //==============================
	{
		//dd($request->all());
		$this->validate($request, Car::rules());
 		
 		$car = Car::createCar($request);

 		if(count($request->images) > 0){ //dd($request->images);
 			$pic_names = [];
 			if(($pic_names = Picture::createPicsForCar($request->images, $car->id)) != [] ){ //// insert OK? then upload pics
 				Picture::storePics($request->images, $pic_names);
 			}
 		}

 		Session::flash('message', 'Car was posted successfully!');

 		Car::notify_users_for_savedSearch($car);

 		return redirect('/my-cars');
	}

// ==================  EDIT CAR  ====================
	
	public function edit(Car $car)
	{
		$update = true;
		
		return view('cars.edit', compact('car', 'update'));
	}

	public function update(Request $request, Car $car) //===============
	{
		$this->validate($request, Car::rules());
 		
 		if(! Car::updateCar($request, $car))
 			Session::flash('message', 'Error while updating car!');

 		if(count($request->images) > 0){ //dd($request->images);
 			$pic_names = [];
 			if(($pic_names = Picture::createPicsForCar($request->images, $car->id)) != [] ){ // insert OK? then upload pics
 				Picture::storePics($request->images, $pic_names);
 			}
 		}

 		Session::flash('message', 'Car was updated successfully!');

 		return redirect("/my-cars");
	}

	public function show(Car $car)
	{
		return view('cars.show', compact('car'));
	}

	public function myCars()
	{
		$myCarsPage = true;
		return view('cars.myCars', compact('myCarsPage'));
	}

	public function destroy(Car $car)
	{ 
		if(!$car->delete())
			Session::flash('error', 'Error while deleting the car!');
		else
			Session::flash('message', 'Car was deleted!');

		return back();
	}

}
