<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Car;
use App\SavedSearch;
use App\Events\CarPostedEvent;
use App\Notifications\CarPosted;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


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
		return SubData::where('id', $this->fuel_type)->get(['title'])[0]->title;
	}
	public function scopeAreaSubdata($query)
	{
		if(!$this->manicipality) return 'No area';
		return SubData::where('id', $this->manicipality)->get(['title'])[0]->title;
	}
	public function scopeCitySubdata($query)
	{
		if(!$this->city) return 'No city';
		return SubData::where('id', $this->city)->get(['title'])[0]->title;
	}


	public function scopeSearchResult($query, $request)
	{ // dd($request);
		// BRAND, MODEL
		if(count(@$request->brand_model)){
			foreach ($request->brand_model as $brand) {
				$query->orWhere('brand', $brand[0]); //echo $brand[0];
				if(count($brand[1])){
					$query->whereIn('model', $brand[1]); //echo $model;
				}
			}
		}
		//AREA
		if(isset($request->areas) && count(@$request->areas) > 0){
			foreach ($request->areas as $area) {
				$query->orWhere('manicipality', $area[0]); //echo $area[0];
				if(count($area[1])){
					$query->whereIn('city', $area[1]); //echo $city;
				}
			}
		}
		//YEAR
		if(isset($request->years) && count(@$request->years) > 0){
			$query->whereIn('year', $request->years);
			//dd($request, $request->years, $query->get());
		}
		//CAR_TYPES
		if(isset($request->car_types) && count(@$request->car_types) > 0){
			$query->whereIn('car_type', $request->car_types);
			// dd($request->car_types, $query->get());
		}
		//WHEEL_DRIVES
		if(isset($request->wheel_drives) && count(@$request->wheel_drives) > 0){
			$query->whereIn('wheel_drive', $request->wheel_drives);
		}
		//FUEL_TYPES
		if(isset($request->fuel_types) && count(@$request->fuel_types) > 0){
			$query->whereIn('fuel_type', $request->fuel_types);
		}
		//GEAR
		if(isset($request->gears) && count(@$request->gears) > 0){
			$query->whereIn('gear', $request->gears);
		}
		//PRICE [1000,2000]
		if( @$request->priceRange !== null ){
			if((@$request->priceRange[0] == 0 || @$request->priceRange[0] == "0") && @$request->priceRange[1] > 0){
				$query->where('price', '<=', $request->priceRange[1]);
			}
			elseif(@$request->priceRange[0] > 0 && (@$request->priceRange[1] == 0 || @$request->priceRange[1] == "0")){
				$query->where('price', '>=', $request->priceRange[0]);
			}
			elseif(@$request->priceRange[0] > 0 && @$request->priceRange[1] > 0 || @$request->priceRange[0] != "0" && @$request->priceRange[1] != "0"){
				$query->whereBetween('price', $request->priceRange);
			}
		}
		//KM [0,100] -- [100,200] -- [100,0]		
		if(isset($request->kmRange)){
			if((@$request->kmRange[0] == 0 || @$request->kmRange[0] == "0") && @$request->kmRange[1] > 0){
				$query->where('kilometer', '<=', $request->kmRange[1]);
			}
			elseif(@$request->kmRange[0] > 0 && (@$request->kmRange[1] == 0 || @$request->kmRange[1] == "0")){
				$query->where('kilometer', '>=', $request->kmRange[0]);
			}
			elseif(@$request->kmRange[0] > 0 && @$request->kmRange[1] > 0 || @$request->kmRange[0] != "0" && @$request->kmRange[1] != "0"){
				$query->whereBetween('kilometer', @$request->kmRange);
			}
		}
		$query->orderBy('created_at', 'desc')->with('pictures'); //dd($res);
		return $query;
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
			"manicipality" => $request['manicipality'],
			"city" => $request['city'],
			"reg_nr" => $request['reg_nr'],
			"reg_fee" => $request['reg_fee'],
			"yearly_fee" => $request['yearly_fee'],
			"user_id" => Auth::id(),
		]);
	}

	protected static function rules() //=====================
	{
		return [
			"brand" => 'required|max:255',
			"model" => 'required|max:255',
			// "country" => 'required|max:255',
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
			"manicipality" => 'required|numeric',
			"city" => 'required|numeric',
			"reg_nr" => 'required|max:255',
			"reg_fee" => 'required|numeric',
			"yearly_fee" => 'required|numeric',
			//"images" => 'max:2000000|mimes:jpeg,jpg,bmp,png',
			"images" => 'max:2000000',
		];
	}

	public static function updateCar($request, $car) //==================
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
			"manicipality" => $request['manicipality'],
			"city" => $request['city'],
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


	public static function fillCardData($res) // returns array contains cards data
	{
		$car_subdata = [];
		foreach ($res as $key => $val) { //dd($key);
			$car_subdata[$key] = [
				'id' => $val->id,
				'brand' => $val->brandSubdata(),
				'model' => $val->modelSubdata(),
				'year' => $val->year,
				'price' => $val->price,
				'area' => $val->areaSubdata(),
				'city' => $val->citySubdata(),
				'pic_file_name' => asset('storage/images').'/'.$val->pictures[0]->id . '.' . $val->pictures[0]->ext,
			];
		}
		return $car_subdata;
	}


	public static function notify_users_for_savedSearch($car)
	{
		if($usersToNotify = $car->isCarInSavedsearch($car)){

			Notification::send($usersToNotify, new CarPosted($car));

			foreach ($usersToNotify as $userToNotify) {
				echo "broadcast to : {$userToNotify->name}<br>";
				broadcast(new CarPostedEvent($userToNotify->id, $car));
			}
		}
	}

	public static function isCarInSavedsearch($car)
	{
		$userIDS = [];
		// foreach row in SavedSearches, check whether each car attribute matches all
		//    columns that are not null
		// if so, then return user_id of the sSearch row

		$SavedSearches = SavedSearch::all();

		echo "Saved Search Rows<br>";
		foreach ($SavedSearches as $key => $row) { 
			echo "========== $key ========== <br>";

			$conainsBrand = false;
			$conainsModel = false;

			if($row->brand_model){ // ROW CONTAINS BRAND & MODEL  // [ [1,[4]], [2,[5]], [3,[7,9]] ]
				foreach (json_decode($row->brand_model, true) as $k => $arr) { 

					$conainsBrand = $conainsBrand || ($arr[0] == $car->brand); 
					if($arr[0] == $car->brand && count($arr[1]) && in_array($car->model, $arr[1]))
						$conainsModel = true;
				}
			}else{
				$conainsBrand = true;
				$conainsModel = true;
			}
			if(($row->min_kilometer == '' || $row->max_kilometer == '') ||
				(/*[0,900]*/(int)$row->min_kilometer == 0 && (int)$row->max_kilometer > 0 && $car->kilometer <= (int)$row->max_kilometer
				||/*[900,0]*/ (int)$row->min_kilometer > 0 && (int)$row->max_kilometer == 0 && $car->kilometer >= (int)$row->min_kilometer
				||/*[900,5000]*/$car->kilometer >= (int)$row->min_kilometer && $car->kilometer <= (int)$row->max_kilometer))
			{
				echo "$row->min_kilometer, $row->max_kilometer<br>";
			}

			if($conainsBrand && $conainsModel &&
				($row->country == '' || strpos($row->country, (string)$car->country) !== false) &&
				($row->years == '' || strpos($row->years, (string)$car->year) !== false) &&
				($row->color == '' || strpos($row->color, (string)$car->color) !== false) &&
				($row->desc == '' || strpos($row->desc, (string)$car->desc) !== false) &&
				($row->fuel_type == '' || strpos($row->fuel_type, (string)$car->fuel_type) !== false) &&
				($row->cylinder == '' || strpos($row->cylinder, (string)$car->cylinder) !== false) &&
				($row->car_type == '' || strpos($row->car_type, (string)$car->car_type) !== false) &&
				($row->roof_type == '' || strpos($row->roof_type, (string)$car->roof_type) !== false) &&
				($row->wheel_drive == '' || strpos($row->wheel_drive, (string)$car->wheel_drive) !== false) &&
				($row->reg_nr == '' || strpos($row->reg_nr, (string)$car->reg_nr) !== false) &&
				($row->wheel_drive == '' || strpos($row->wheel_drive, (string)$car->wheel_drive) !== false) &&
				
				(($row->min_price == '' || $row->max_price == '') ||
				(/*[0,900]*/(int)$row->min_price == 0 && (int)$row->max_price > 0 && $car->price <= (int)$row->max_price
				||/*[900,0]*/ (int)$row->min_price > 0 && (int)$row->max_price == 0 && $car->price >= (int)$row->min_price
				||/*[900,5000]*/$car->price >= (int)$row->min_price && $car->price <= (int)$row->max_price)) &&

				(($row->min_kilometer == '' || $row->max_kilometer == '') ||
				(/*[0,900]*/(int)$row->min_kilometer == 0 && (int)$row->max_kilometer > 0 && $car->kilometer <= (int)$row->max_kilometer
				||/*[900,0]*/ (int)$row->min_kilometer > 0 && (int)$row->max_kilometer == 0 && $car->kilometer >= (int)$row->min_kilometer
				||/*[900,5000]*/$car->kilometer >= (int)$row->min_kilometer && $car->kilometer <= (int)$row->max_kilometer)) &&

				(($row->min_weight == '' || $row->max_weight == '') ||
				(/*[0,900]*/(int)$row->min_weight == 0 && (int)$row->max_weight > 0 && $car->weight <= (int)$row->max_weight
				||/*[900,0]*/ (int)$row->min_weight > 0 && (int)$row->max_weight == 0 && $car->weight >= (int)$row->min_weight
				||/*[900,5000]*/$car->weight >= (int)$row->min_weight && $car->weight <= (int)$row->max_weight)) &&

				(($row->min_co2 == '' || $row->max_co2 == '') ||
				(/*[0,900]*/(int)$row->min_co2 == 0 && (int)$row->max_co2 > 0 && $car->co2 <= (int)$row->max_co2
				||/*[900,0]*/ (int)$row->min_co2 > 0 && (int)$row->max_co2 == 0 && $car->co2 >= (int)$row->min_co2
				||/*[900,5000]*/$car->co2 >= (int)$row->min_co2 && $car->co2 <= (int)$row->max_co2)) &&

				(($row->min_HP == '' || $row->max_HP == '') ||
				(/*[0,900]*/(int)$row->min_HP == 0 && (int)$row->max_HP > 0 && $car->HP <= (int)$row->max_HP
				||/*[900,0]*/ (int)$row->min_HP > 0 && (int)$row->max_HP == 0 && $car->HP >= (int)$row->min_HP
				||/*[900,5000]*/$car->HP >= (int)$row->min_HP && $car->HP <= (int)$row->max_HP)) &&

				(($row->min_reg_fee == '' || $row->max_reg_fee == '') ||
				(/*[0,900]*/(int)$row->min_reg_fee == 0 && (int)$row->max_reg_fee > 0 && $car->reg_fee <= (int)$row->max_reg_fee
				||/*[900,0]*/ (int)$row->min_reg_fee > 0 && (int)$row->max_reg_fee == 0 && $car->reg_fee >= (int)$row->min_reg_fee
				||/*[900,5000]*/$car->reg_fee >= (int)$row->min_reg_fee && $car->reg_fee <= (int)$row->max_reg_fee))


				&& !in_array($row->user_id, $userIDS)
				// REAMINING AREA in SSEARCH TABLE  with MUNICIPALITY & CITY in CAR TABLE
				){
					$userIDS[$key] = $row->user_id;
				}
				
		}

		//dd($userIDS);
		return User::whereIn('id', $userIDS)->get();

	}
}
