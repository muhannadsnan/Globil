<?php

namespace App\Http\Controllers;

use App\Car;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['show']);	
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

	public function show(Car $car)
	{
		return view('cars.show', compact('car'));
	}

}
