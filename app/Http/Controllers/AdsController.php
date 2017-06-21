<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Picture;
use App\SubData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getAllAds()
	{
		$ads = Ad::latest()->get();
		return ['ok'=>1, 'message'=>'Advertisements loaded!', 'data'=>$ads];
	}

	public function getAdsTypes()
	{
		if(! $types = SubData::subdata('ads_type')->get())
			return ['ok'=>0, 'message'=>'Error while loading ads types!'];
		return ['ok'=>1, 'message'=>'Ads types loaded!', 'data'=>$types];
	}

	public function store(Request $request)
	 { 	//dd($request->all());
	 	//dd($_FILES);
		if(!$res = Ad::create($request->all()))
			return ['ok'=>0, 'message'=>'Error while storing ads!'];

		if(count($request->images) > 0){ //dd($request->images);
 			$pic_names = [];
 			if(($pic_names = Picture::createPicsForAds($request->images, $res->id)) != [] ){ //// insert OK? then upload pics
 				Picture::storePics($request->images, $pic_names, '/ads');
 			}
 		}
		return ['ok'=>1, 'message'=>'Advertisements created!'];
	}

	// Picture::destroyPicByFolder($pic, $folder)


}
