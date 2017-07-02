<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
	// protected $fillable = [
	// 	'brand', 'model', 'country', 'price', 'year', 'kilometer', 'color', 'desc',
	// 	'fuel_type_bensin', 'fuel_type_diesel', 'fuel_type_gas', 'fuel_type_electric', 
	// 	'gear', 'weight', 'cylinder', 'co2', 'car_type', ....];

	
// ============= SEARCH FILTERS SCOPE =============

	public function scopeSearchFilters($query, $filters = [], $orderBy = '')
	{
		$query->where($filters);
		if($orderBy){
			$query->orderBy($orderBy);	
		}
		return $query->get(); // dd($res);	 
	}


	public function scopeBrandSubdata($query)
	{
		return SubData::where('id', $this->brand)->get(['title'])[0]->title;
	}


	public function scopeModelSubdata($query)
	{
		return SubData::where('id', $this->model)->get(['title'])[0]->title;
	}


	public function scopeFuelSubdata($query)
	{
		$fuel = $query->get(['fuel_type_bensin', 'fuel_type_diesel', 'fuel_type_electric'])[0];
		return $fuel;
	}


	public function scopeSearchResult($query, $request)
	{
		// BRAND, MODEL
		if(count($request->brand_model)){
			foreach ($request->brand_model as $brand) {
				$query->orWhere('brand', $brand[0]); //echo $brand[0];
				if(count($brand[1])){
					$query->whereIn('model', $brand[1]); //echo $model;
				}
			}
		}

		//PRICE [1000,2000]
		if($request->priceRange[0] == 0 && $request->priceRange[1] > 0){
			$query->where('price', '<=', $request->priceRange[1]);
		}
		elseif($request->priceRange[0] > 0 && $request->priceRange[1] == 0){
			$query->where('price', '>=', $request->priceRange[0]);
		}
		elseif($request->priceRange[0] > 0 && $request->priceRange[0] > 0){
			$query->whereBetween('price', $request->priceRange);
		}

		//YEAR
		if(count($request->years)){
			$query->whereIn('year', $request->year);
		}

		//CAR_TYPES
		if(count($request->car_types)){
			foreach ($request->car_types as $key => $value) {
				if($value){
					$query->Where('car_type', $value);
				}
			}
		}

		//WHEEL_DRIVES
		if(count($request->wheel_drives)){
			foreach ($request->wheel_drives as $key => $value) {
				if($value){
					$query->Where('wheel_drive', $value);
				}
			}
		}

		//KM [0,100] -- [100,200] -- [100,0]		
		if($request->kmRange[0] == 0 && $request->kmRange[1] > 0){
			$query->where('kilometer', '<=', $request->kmRange[1]);
		}
		elseif($request->kmRange[0] > 0 && $request->kmRange[1] == 0){
			$query->where('kilometer', '>=', $request->kmRange[0]);
		}
		elseif($request->kmRange[0] > 0 && $request->kmRange[0] > 0){
			$query->whereBetween('kilometer', $request->kmRange);
		}

		//FUEL_TYPES
		if(count($request->fuel_types)){
			foreach ($request->fuel_types as $key => $value) {
				if($value){
					$query->Where('fuel_type', $value);
				}
			}
		}

		//GEAR
		if(count($request->gears)){
			foreach ($request->gears as $key => $value) {
				if($value){
					$query->orWhere('gear', $value);
				}
			}
		}

		$query->orderBy('created_at', 'desc')->with('pictures'); //dd($res);
		return $query->get();
	}

// ============= RELATIONSHIPs =============

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function pictures()
	{
		return $this->hasMany(Picture::class);
	}

// ============= CREATE, UPDATE, RULES =============

	public static function createCar($request)
	{
		//Car::create($request->all());
		return Car::create([
			"brand" => $request['brand'],
			"model" => $request['model'],
			"country" => $request['country'],
			"price" => $request['price'],
			"year" => $request['year'],
			"kilometer" => $request['kilometer'],
			"color" => $request['color'],
			"desc" => $request['desc'],
			"fuel_type" => $request['fuel_type'],
			"gear" => $request['gear'],
			"weight" => $request['weight'],
			"cylinder" => $request['cylinder'],
			"co2" => $request['co2'],
			"car_type" => $request['car_type'],
			"roof_type" => $request['roof_type'],
			"HP" => $request['HP'],
			"wheel_drive" => $request['wheel_drive'],
			"reg_nr" => $request['reg_nr'],
			"reg_fee" => $request['reg_fee'],
			"yearly_fee" => $request['yearly_fee'],
			"user_id" => Auth::id(),
		]);
	}


	protected static function rules()
	{
		return [
			"brand" => 'required|max:255',
			"model" => 'required|max:255',
			"country" => 'required|max:255',
			"year" => 'required|max:255',
			"price" => 'required|numeric',
			"kilometer" => 'required|numeric',
			"color" => 'required|max:7',
			"desc" => 'required', //required_without
			"fuel_type" => 'required|numeric',
			"gear" => 'required|numeric',
			"weight" => 'required|numeric',
			"cylinder" => 'required|numeric',
			"co2" => 'required|numeric',
			"car_type" => 'required|numeric',
			"roof_type" => 'required|numeric',
			"HP" => 'required|numeric',
			"wheel_drive" => 'required|numeric',
			"reg_nr" => 'required|max:255',
			"reg_fee" => 'required|numeric',
			"yearly_fee" => 'required|numeric',
			//"images" => 'max:2000000|mimes:jpeg,jpg,bmp,png',
			"images" => 'max:2000000',
		];
	}

	public static function updateCar($request, $car)
	{
		$updateCar = Car::updateOrCreate(['id'=>$car->id], [
			"brand" => $request['brand'], 
			"model" => $request['model'],
			"country" => $request['country'],
			"price" => $request['price'],
			"year" => $request['year'],
			"kilometer" => $request['kilometer'],
			"color" => $request['color'],
			"desc" => $request['desc'],
			"fuel_type" => $request['fuel_type'],
			"gear" => $request['gear'],
			"weight" => $request['weight'],
			"cylinder" => $request['cylinder'],
			"co2" => $request['co2'],
			"car_type" => $request['car_type'],
			"roof_type" => $request['roof_type'],
			"HP" => $request['HP'],
			"wheel_drive" => $request['wheel_drive'],
			"reg_nr" => $request['reg_nr'],
			"reg_fee" => $request['reg_fee'],
			"yearly_fee" => $request['yearly_fee'],
			"user_id" => Auth::id(),
		]);
	}

	public static function sub($id)
	{
		return SubData::find($id)['title'];
	}

}
