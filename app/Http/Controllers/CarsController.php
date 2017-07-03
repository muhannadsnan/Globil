<?php

namespace App\Http\Controllers;

use App\Car;
use App\Picture;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CarsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['show', 'getLatestPosts']);	  View::addExtension('html', 'php');
	}

	public function store(Request $request)
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

 		return redirect('/cars/create');
	}

	public function create()
	{
		return view('cars.create', compact(''));
	}

	public function edit(Car $car)
	{
		$update = true;
		
		return view('cars.edit', compact('car', 'update'));
	}

	//  === === UPDATE CAR

	public function update(Request $request, Car $car)
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

 		return redirect("/cars/{$car->id}/edit");
	}

	public function show(Car $car)
	{
		return view('cars.show', compact('car'));
	}

	public function myCars()
	{
		$update = true;
		return view('cars.myCars', compact('update'));
	}


}
