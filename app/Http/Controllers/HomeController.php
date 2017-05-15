<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
		public function __construct()
		{
			//$this->middleware('auth');
		}

		public function index()
		{
			$latestCars = Car::latest()->get();
			return view('home', compact('latestCars'));
		}
}
