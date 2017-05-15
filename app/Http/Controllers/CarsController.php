<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except();	
	}

	public function latestPosts()
	{
		
	}
}
