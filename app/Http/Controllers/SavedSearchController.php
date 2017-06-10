<?php

namespace App\Http\Controllers;

use App\SavedSearch;
use Illuminate\Http\Request;

class SavedSearchController extends Controller
{
	public function store(Request $request)
	{
		if( !$res = SavedSearch::storeSearch($request))
			return ['ok' => 0, 'message' => "Error while storing data"];
		return ['ok' => 1, 'message' => "Saerch is saved successfully!", 'data' => $res];
	}
}
