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
			
			$car_subdata = $this->fillCardData($res);
		}
		
		return ['ok' => 1, 'message' => "Cars that match your search..", 'data' => $car_subdata];
	}

	public function fillCardData($res) // returns array contains cards data
	{
		$car_subdata = [];
		foreach ($res as $key => $val) {
			$car_subdata[$key] = [
				'pic_file_name' => asset('storage/images').'/'.$val->pictures[0]->id . '.' . $val->pictures[0]->ext,
				'brand' => $val->sub($val->brand),
				'model' => $val->sub($val->model),
				'year' => $val->year,
				'price' => $val->price,
			];
		}
		return $car_subdata;
	}

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
	}
}
