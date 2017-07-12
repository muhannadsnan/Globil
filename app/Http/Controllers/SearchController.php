<?php

namespace App\Http\Controllers;

use App\Car;
use App\SubData;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function searchGeneral($keyword)
	{
		@$key = SubData::where('title', 'LIKE', strtolower($keyword).'%')
							->get();
		@$res = Car::where("brand", $key[0]->ntype == 'brand' ? $key[0]->id : '')
					->orWhere("model", $key[0]->ntype == 'model' ? $key[0]->id : '')
					->get();

		$car_subdata = [];

		if( count($res) > 0){ // results found ? fill data
			
			$car_subdata = Car::fillCardData($res);
		}
		
		return ['ok' => 1, 'message' => "Cars that match your search..", 'data' => $car_subdata];
	}

	// public function fillCardData($res) // returns array contains cards data
	// {
	// 	$car_subdata = [];
	// 	foreach ($res as $key => $val) { //dd($key);
	// 		$car_subdata[$key] = [
	// 			'id' => $val->id,
	// 			'brand' => $val->brandSubdata($val->brand),
	// 			'model' => $val->modelSubdata($val->model),
	// 			'year' => $val->year,
	// 			'price' => $val->price,
	// 			'pic_file_name' => asset('storage/images').'/'.$val->pictures[0]->id . '.' . $val->pictures[0]->ext,
	// 		];
	// 	}
	// 	return $car_subdata;
	// }





/*
	public function readCheckedBrands(Request $request)
	{
		if( !$res = Car::whereIn('brand', $request->all())->orderBy('brand')->orderBy('model')->get() )
			return ['ok' => 0, 'message' => "Error while loading search data!"];

		$data = $this->fillCardData($res);
		return ['ok' => 1, 'message' => "Search data is loaded successfully!", 'data' => $data];
	}

	public function readCheckedModels(Request $request)
	{
		if( !$res = Car::whereIn('model', $request->all())->orderBy('brand')->get() )
			return ['ok' => 0, 'message' => "Error while loading search data!"];
		
		$data = $this->fillCardData($res);
		return ['ok' => 1, 'message' => "Search data is loaded successfully!", 'data' => $data];
	}

	public function readCarsInPriceRange(Request $request) // [0,5000]
	{
		if( !$res = Car::whereBetween('price', $request->all())->orderBy('price', 'desc')->get() )
			return ['ok' => 0, 'message' => "Error while loading search data!"];
		
		$data = $this->fillCardData($res);
		return ['ok' => 1, 'message' => "Search data is loaded successfully!", 'data' => $data];
	}*/

	public function readResults(Request $request)
	{  //dd($request->paginator);
		$req = (object) $request->req;
		$paginator = $request->paginator;
		$page = $paginator['current_page'];
		$perpage = $paginator['per_page'];
		$skip = ($page-1) * $perpage; //dd($page, $perpage, $skip); //($page == 1 ? 0 : $page - 1)

		if( !$res = Car::searchResult($req)->skip($skip)->take($perpage)->get())
			return ['ok' => 0, 'message' => "Error while loading search result!"];
		$data = Car::fillCardData($res);
		$more_results = Car::searchResult($req)->skip($skip+$perpage)->take($perpage)->get()->count();
		//dd($data);
		return ['ok' => 1, 'message' => "Search result is loaded successfully!",
		/*'paginator' => collect($res)->except(['data']),*/ 'data' => $data, 'moreResults'=>$more_results];
	}


	public function getLatestCars()
	{ 
		$page = $_GET['page'];
		$perpage = $_GET['per_page'];
		$skip = ($page == 1 ? 0 : $page - 1) * $perpage;
		$user_id = auth()->check() ? auth()->id() : 0; //dd($user_id);

		if( !$paginator = Car::latest()->skip($skip)->take($perpage)->get()) //->paginate(4)
			return ['ok' => 0, 'message' => "Error while loading the latest posts!"];

		$data = Car::fillCardData($paginator);
		$more_results = Car::latest()->skip($page*$perpage)->take($perpage)->get()->count();
		return ['ok' => 1, 'message' => "Latest posts are loaded successfully!", 
			'data'=>$data, 'moreResults'=>$more_results, 
			// becuase it is the first request in the app
			'user_id'=>$user_id, 'wish_list'=>auth()->user()->wishList];
	}

}
