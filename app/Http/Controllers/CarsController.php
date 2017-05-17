<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except([]);	
	}

	public function store(Request $request)
	{
		//dd($request->all());
		$this->validate($request, Car::rules());
 		
 		Car::createCar($request);

 		Session::flash('message', 'Car was posted successfully!');

 		return back();
	}

	public function create()
	{
		return view('cars.create', compact(''));
	}

	

}
