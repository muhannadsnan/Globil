<?php

namespace App\Http\Controllers;

use App\Car;
use App\SavedSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

	public function getSavedSearch(SavedSearch $savedSearch)
	{ 
		foreach ($savedSearch->getAttributes() as $key => $value) { //decoding all attributes for the object
			$decoded[$key] = json_decode($value);
		}
		
		if( !$sSearchRes = Car::searchResult((object)$decoded)->get())
			Session::flash('message', 'Error while reading results for saved search!');
		Session::flash('message', 'Saved search results loaded!');

		//$sSearchRes = Car::fillCardData($sSearchRes); //in VUE

		$isSavedSearchLoaded = true;
		$savedSearches = SavedSearch::latest()->where('user_id', auth()->id())->take(5)->get();
		$isHomePage = true; // to load sidebar & searchbar

		return view('home', compact('savedSearch', 'sSearchRes', 
			'isSavedSearchLoaded', 'isHomePage', 'savedSearches') );
	}


	public function destroy(SavedSearch $savedSearch)
	{
		if(!$savedSearch->delete())
			Session::flash('error', 'Error while deleting the saved search!');
		else
			Session::flash('message', 'Saved search was deleted!');

		return back();
	}
}
