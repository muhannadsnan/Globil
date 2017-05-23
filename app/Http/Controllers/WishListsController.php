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
		$wishlists = WishList::latest()->get();
		return view('wishlists.show', compact('wishlists'));
	}

	public function store(Request $request)
	{ 
		if( ! $wish = WishList::addToWishList($request->all()) )
			return ['ok'=>0, 'message'=>'Error while adding the car to wash list! Try again later.'];

		return ['ok'=>1, 'message'=>'Car is added to wish list!', 'wish' => $wish];
	}

	public function destroy(WishList $wish)
	{
		if( ! $wish->delete() )
			return ['ok'=>0, 'message'=>'Error while deleting the car from wash list! Try again later.'];
		return ['ok'=>1, 'message'=>'Car is deleted from wish list!'];
	}
}
