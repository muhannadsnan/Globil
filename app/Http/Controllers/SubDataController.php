<?php

namespace App\Http\Controllers;

use App\SubData;
use Illuminate\Http\Request;

class SubDataController extends Controller
{
	public function readSubData($data1, $data2 = null /*, $data3 = null*/)
	{ //dd($data1,$data2);
		if($data2=="undefined") $data2 = null;

		if( !$res = SubData::subData($data1, $data2)->get())
			return ['ok' => 0, 'message' => 'Error while loading "$data1"'];
		return ['ok' => 1, 'message' => "$data1 is loaded successfully!", 'data' => $res];
	}

	public function readModelsBySubID($subID)
	{ //dd($subID);
		$brand = SubData::find($subID)->title; //dd($brand);
		if( !$res = SubData::subData('model', $brand )->get())
			return ['ok' => 0, 'message' => 'Error while loading "models"'];
		return ['ok' => 1, 'message' => "Models are loaded successfully!", 'data' => $res];
	}
}
