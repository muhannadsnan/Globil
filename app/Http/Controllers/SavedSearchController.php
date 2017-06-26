<?php

namespace App\Http\Controllers;

use App\SavedSearch;
use Illuminate\Http\Request;

class SavedSearchController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function store(Request $request)
	{
		if( !$res = SavedSearch::storeSearch($request))
			return ['ok' => 0, 'message' => "Error while storing data"];
		return ['ok' => 1, 'message' => "Search is saved successfully!", 'data' => $res];
	}
}
