<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

	public static function createPicsForCar($pictures, $car_id)
	{
		$img_names = [];

		foreach ($pictures as $pic) {

			$newPic = Picture::create([
				'car_id' => $car_id,
				'ext' => explode(".", $pic->getClientOriginalName())[1],
			]);

			array_push($img_names, $newPic->id . '.' . $newPic->ext);
		}//dd($img_names);
		return $img_names;
	}

	public static function createPicsForAds($pictures, $ads_id)
	{
		$img_names = [];
		//dd($pictures);
		foreach ($pictures as $pic) { //dd($pic);
			$explode = explode(".", $pic->getClientOriginalName());
			$newPic = Picture::create([
				'ads_id' => $ads_id,
				'ext' => $explode[count($explode)-1],
			]);

			array_push($img_names, $newPic->id . '.' . $newPic->ext);
		}//dd($img_names);
		return $img_names;
	}


	public static function storePics($pictures, $pic_names, $folder="")
	{
		//dd($pic_names);
		$i = 0;
		foreach ($pictures as $pic) {
			//$pic->store('public/images'); //dd($pic);
			//$img = Image::make($pic)->resize(320, 240)->store('public/images');/*save('public/bar.jpg')*/
			$pic->move(storage_path('app/public/images'.$folder), $pic_names[$i]);
			$i++;
		}
		return true;
	}


	public function car()
	{
		return $this->belongsTo('\App\Car');
	}

}
