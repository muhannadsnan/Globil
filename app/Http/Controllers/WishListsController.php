<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishListsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');	
	}

	public function wishList()
	{
		return view('wishlists.show', compact(''));
	}
}
