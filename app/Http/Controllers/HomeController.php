<?php

namespace App\Http\Controllers;

use App\Car;
use App\SavedSearch;
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
			$savedSearch = SavedSearch::latest()->take(5)->get();
			return view('home', compact('latestCars', 'savedSearch'));
		}
}
