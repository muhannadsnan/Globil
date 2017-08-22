<?php

namespace App;

use App\SavedSearch;
use App\User;

//use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
	protected $table = 'saved_searches';

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public static function storeSearch($request)
	{ //dd($request);
		SavedSearch::create([ 
				'title' => is_null($request->title) ? '' : $request->title,
				'users' => ! $request->users ? null : json_encode($request->users),
				'user_id' => auth()->id(),
				'brand_model' => ! $request->brand_model ? null : json_encode($request->brand_model),
				'areas' => ! $request->areas ? null : json_encode($request->areas),
				'min_price' => ! $request->priceRange ? null : $request->priceRange[0],
				'max_price' => ! $request->priceRange ? null : $request->priceRange[1],
				'years' => ! $request->years ? null : json_encode($request->years),
				'car_type' => ! $request->car_types ? null : json_encode($request->car_types),
				'wheel_drive' => ! $request->wheel_drives ? null : json_encode($request->wheel_drives),
				'min_kilometer' => $request->kmRange[0],
				'max_kilometer' => $request->kmRange[1],
				'fuel_type' => ! $request->fuel_types ? null : json_encode($request->fuel_types),
				'gear' => ! $request->gears ? null : json_encode($request->gears),
				'country' => ! $request->countries ? null : json_encode($request->countries),
				'color' => ! $request->colors ? null : json_encode($request->colors),
				'desc' => ! $request->desc ? null : json_encode($request->desc),
				'cylinder' => ! $request->cylinders ? null : json_encode($request->cylinders),
				'roof_type' => ! $request->roof_types ? null : json_encode($request->roof_types),
				'reg_nr' => $request->reg_nr,
				'min_weight' => $request->weightRange[0],
				'max_weight' => $request->weightRange[1],
				'min_co2' => $request->co2Range[0],
				'max_co2' => $request->co2Range[1],
				'min_HP' => $request->hpRange[0],
				'max_HP' => $request->hpRange[1],
				'min_reg_fee' => $request->regFeeRange[0],
				'max_reg_fee' => $request->regFeeRange[1],
				'min_yearly_fee' => $request->yearlyFeeRange[0],
				'max_yearly_fee' => $request->yearlyFeeRange[1],
			]);
		return true;
	}

	public function idsToBrands()
	{ 
		$res = [];
		foreach (json_decode($this->brand_model) as $key => $brand) { 
			$res[$key] = $this->idToTitle($brand[0]);
		} //dd($res);
		return $res;
	}

	public function idsToModels()
	{ 
		$res = [];
		foreach (json_decode($this->brand_model) as $brand) { 
			$i = 0;
			foreach ($brand[1] as $model) {
				$res[$this->idToTitle($brand[0])][$i] = $this->idToTitle($model); $i++;
			}
		} //dd($res);
		return $res;
	}

	public function idsToAreas()
	{ 
		$res = [];
		foreach (json_decode($this->areas) as $key => $area) { 
			$res[$key] = $this->idToTitle($area[0]);
		} //dd($res);
		return $res;
	}

	public function idsToCities()
	{ 
		$res = [];
		foreach (json_decode($this->areas) as $area) { 
			$i = 0;
			foreach ($area[1] as $city) {
				$res[$this->idToTitle($area[0])][$i] = $this->idToTitle($city); $i++;
			}
		} //dd($res);
		return $res;
	}

	//===================  SCOPES  ==================================

	public function scopeIdToTitle($query, $id)
	{
		return SubData::where('id', $id)->get(['title'])[0]->title;
	}

	public function scopeFuel_typeSubdata($query, $getAsString = true)
	{  //dd(json_decode($this->fuel_type, true));
		$fuel_types = "";
		foreach (json_decode($this->fuel_type, true) as $key => $val) {
			if($getAsString)
				$fuel_types .= SubData::where('id', $val)->get(['title'])[0]->title . ', ';
			else
				$fuel_types[$key] = SubData::where('id', $val)->get(['title'])[0]->title;
		}
		return $fuel_types;
	}
	public function scopeCar_typeSubdata($query, $getAsString = true)
	{
		$car_type = "";
		foreach (json_decode($this->car_type, true) as $key => $val) {
			if($getAsString)
				$car_type .= SubData::where('id', $val)->get(['title'])[0]->title . ', ';
			else
				$car_type[$key] = SubData::where('id', $val)->get(['title'])[0]->title;
		}
		return $car_type;
	}
	public function scopeGearSubdata($query, $getAsString = true)
	{
		$gear = "";
		foreach (json_decode($this->gear, true) as $key => $val) {
			if($getAsString)
				$gear .= SubData::where('id', $val)->get(['title'])[0]->title . ', ';
			else
				$gear[$key] = SubData::where('id', $val)->get(['title'])[0]->title;
		}
		return $gear;
	}
	public function scopeCylinderSubdata($query, $getAsString = true)
	{
		$cylinder = "";
		foreach (json_decode($this->cylinder, true) as $key => $val) {
			if($getAsString)
				$cylinder .= SubData::where('id', $val)->get(['title'])[0]->title . ', ';
			else
				$cylinder[$key] = SubData::where('id', $val)->get(['title'])[0]->title;
		}
		return $cylinder;
	}
	public function scopeWheel_driveSubdata($query, $getAsString = true)
	{
		$wheel_drive = "";
		foreach (json_decode($this->wheel_drive, true) as $key => $val) {
			if($getAsString)
				$wheel_drive .= SubData::where('id', $val)->get(['title'])[0]->title . ', ';
			else
				$wheel_drive[$key] = SubData::where('id', $val)->get(['title'])[0]->title;
		}
		return $wheel_drive;
	}

	//=======================================================
	
	public static function getSummerize($savedSearch)
	{ 
		if($savedSearch->brand_model){
			echo '<p class="col-md-6">';
			echo 'Brands: ';
			foreach($savedSearch->idsToBrands() as $brand){
					echo $brand.' [ ';
					if(count(@$savedSearch->idsToModels()[$brand])){
						foreach($savedSearch->idsToModels()[$brand] as $model){
	 						echo $model.' ';
	 					}
					}
					echo ' ] , ';
			}
			echo '</p>';
		}
		if($savedSearch->areas){
			echo '<p class="col-md-6">';
			echo 'Areas: ';
			foreach($savedSearch->idsToAreas() as $manicipality){
					echo $manicipality.' [ ';
					if(count(@$savedSearch->idsToCities()[$manicipality])){
						foreach($savedSearch->idsToCities()[$manicipality] as $city){
	 						echo $city.' ';
	 					}
					}
					echo ' ] , ';
			}
			echo '</p>';
		}
		echo $savedSearch->min_price ?
				'<p class="col-md-6">'.
					'Price: from ' . $savedSearch->min_price . 
					($savedSearch->max_price ? ' to ' . $savedSearch->max_price : '') . ' NOK' : '';
		echo '</p>';
		echo $savedSearch->years ?
				'<p class="col-md-6">'.
					'Years: ' . $savedSearch->years : ''; 
		echo '</p>';
		echo $savedSearch->fuel_type ?
				'<p class="col-md-6">'.
					'Fuel type: ' . $savedSearch->fuel_typeSubdata() : ''; 
		echo '</p>';
		echo $savedSearch->gear ?
				'<p class="col-md-6">'.
					'Gear: ' . $savedSearch->gearSubdata() : '';
		echo '</p>';
		echo $savedSearch->cylinder ?
				'<p class="col-md-6">'.
					'Cylinder: ' . $savedSearch->cylinderSubdata() : ''; 
		echo '</p>';
		echo $savedSearch->car_type ?
				'<p class="col-md-6">'.
					'Car type: ' . $savedSearch->car_typeSubdata() : ''; 
		echo '</p>';
		echo $savedSearch->wheel_drive ?
				'<p class="col-md-6">'.
					'Wheel drive: ' . $savedSearch->wheel_driveSubdata() : '';
		echo '</p>';
		
		if ($savedSearch->min_kilometer){
			echo '<p class="col-md-6">';
			if($savedSearch->min_kilometer == 0 && $savedSearch->max_kilometer > 0){
				echo 'kilometer less than '.$savedSearch->max_kilometer;
			}elseif($savedSearch->min_kilometer > 0){
				echo 'Kilometer starting from '.$savedSearch->min_kilometer;
				if($savedSearch->max_kilometer > 0)
					echo  ' to ' . $savedSearch->max_kilometer;
			}
			echo '</p>';
		}
	}
}