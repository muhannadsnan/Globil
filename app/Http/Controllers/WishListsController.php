<?php

namespace App\Http\Controllers;

use App\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishListsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['store']);	
	}

	public function index()
	{
		return view('wishlists.show', compact(''));
	}

	public function store(Request $request)
	{ //dd($request->all());
		if( ! WishList::addToWishList($request->all()) )
			return ['ok'=>0, 'message'=>'Error while adding the car to wash list! Try again later.'];
		return ['ok'=>1, 'message'=>'Car is added to wish list!'];
	}

	public function destroy(WishList $wish)
	{
		if( ! $wish->delete() )
			return ['ok'=>0, 'message'=>'Error while deleting the car from wash list! Try again later.'];
		return ['ok'=>1, 'message'=>'Car is deleted from wish list!'];
	}
}
