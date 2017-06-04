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

	public function fillCardData($res)
	{
		$car_subdata = [];
		foreach ($res as $key => $val) {
			$car_subdata[$key] = [
				'pic_file_name' => asset('storage/images').'/'.$val->pictures[0]->id . '.' . $val->pictures[0]->ext,
				'brand' => $val->sub($val->brand),
				'model' => $val->sub($val->model),
				'year' => $val->year,
			];
		}
		return $car_subdata;
	}



	public function readCarsByBrandId($brandId)
	{
		if( !$res = Car::searchFilters(['brand' => $brandId]))
			return ['ok' => 0, 'message' => "Error while loading search data!"];

		$data = $this->fillCardData($res);
		return ['ok' => 1, 'message' => "Search data is loaded successfully!", 'data' => $data];
	}
}
