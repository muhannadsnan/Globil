<?php

namespace App\Http\Controllers;

use App\Car;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
	public function readPicsByCar(Car $car)
	{ //dd($car->pictures);
		if( ! $pics = $car->pictures)
			return ['ok' => 0, 'message' => 'Error while loading images'];
		return ['ok' => 1, 'message' => "Images were loaded successfully!", 'data' => $pics];
	}


	public function destroyPicByCar(Picture $pic)
	{
		if( ! $pic->delete() )
			return ['ok' => 0, 'message' => 'Error while removing images'];

		@unlink(public_path("/storage/images/$pic->id.$pic->ext"));
		return ['ok' => 1, 'message' => "Images were removed successfully!"];
	}


	public function destroyPicByFolder(Picture $pic, $folder="")
	{
		if( ! $pic->delete() )
			return ['ok' => 0, 'message' => 'Error while removing images'];

		@unlink(public_path("/storage/images/$folder/$pic->id.$pic->ext"));
		return ['ok' => 1, 'message' => "Images were removed successfully!"];
	}
}
