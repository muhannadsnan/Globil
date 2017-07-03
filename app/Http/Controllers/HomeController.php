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
			$latestCars = Car::latest()->paginate(4);
			$savedSearch = SavedSearch::latest()->where('user_id', auth()->id())->take(5)->get();
			$isHomePage = true;
			return view('home', compact('latestCars', 'savedSearch', 'isHomePage'));
		}
}
