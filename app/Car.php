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
	public function scopeFuel_typeSubdata($query)
	{
		return SubData::where('id', $this->fuel_type)->get(['title'])[0]->title;
	}
	public function scopeCar_typeSubdata($query)
	{
		return SubData::where('id', $this->car_type)->get(['title'])[0]->title;
	}
	public function scopeGearSubdata($query)
	{
		return SubData::where('id', $this->gear)->get(['title'])[0]->title;
	}
	public function scopeCylinderSubdata($query)
	{
		return SubData::where('id', $this->cylinder)->get(['title'])[0]->title;
	}
	public function scopeWheel_driveSubdata($query)
	{
		return SubData::where('id', $this->wheel_drive)->get(['title'])[0]->title;
	}
	public function scopeAreaSubdata($query)
	{
		if(!$this->manicipality)
			return 'No area';
		return SubData::where('id', $this->manicipality)->get(['title'])[0]->title;
	}
	public function scopeCitySubdata($query)
	{
		if(!$this->city)
			return 'No city';
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

				if(isset($request->areas) && count(@$request->areas) > 0){
					$query->Where(function ($query) use ($request) {
						foreach($request->areas as $area) {
							$query->orWhere('manicipality', $area[0]); //echo $area[0];
							if(count($area[1])){
								$query->whereIn('city', $area[1]); //echo $city;
							}
							$query = Car::mostFilters($query, $request);
						}
					});

				}else{
					$query = Car::mostFilters($query, $request);
				}
			}
		// no brand_model, but areas yes
		}elseif(isset($request->areas) && count(@$request->areas) > 0){ 
			$query->Where(function ($query) use ($request) {
				foreach($request->areas as $area) {
					$query->orWhere('manicipality', $area[0]); //echo $area[0];
					if(count($area[1])){
						$query->whereIn('city', $area[1]); //echo $city;
					}
				}
			});
			$query = Car::mostFilters($query, $request);		
		//no brand_model, no areas, only checks mostFilters
		}else{
			$query = Car::mostFilters($query, $request);
		}

		$query->orderBy('created_at', 'desc')->with('pictures'); //dd($res);
		return $query;
	}

	// public function areaFilters($query, $request)
	// {		
	// 	foreach($request->areas as $area) {
	// 		$query->orWhere('manicipality', $area[0]); //echo $area[0];
	// 		if(count($area[1])){
	// 			$query->whereIn('city', $area[1]); //echo $city;
	// 		}
	// 		$query = Car::mostFilters($query, $request);
	// 	}
	// 	return $query;
	// }

	public function mostFilters($query, $request)
	{
		//YEAR
		if(isset($request->years) && count(@$request->years) > 0){
			$query->whereIn('year', $request->years);//dd($request, $request->years, $query->get());
		}
		//CAR_TYPES
		if(isset($request->car_types) && count(@$request->car_types) > 0){
			$query->whereIn('car_type', $request->car_types);// dd($request->car_types, $query->get());
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
		foreach ($res as $key => $val) { 
			@$car_subdata[$key] = [
				'id' => $val->id,
				'brand' => $val->brandSubdata(),
				'model' => $val->modelSubdata(),
				'year' => $val->year,
				'price' => $val->price,
				'area' => $val->areaSubdata(),
				'city' => $val->citySubdata(),
				'pic_file_name' => @$val->pictures[0] ?
					asset('storage/images').'/'. @$val->pictures[0]->id . '.' . @$val->pictures[0]->ext
					: asset('storage/images').'/no-image.png',
				'wishlist_type' => $val->wishlist_type()
			];
		} //dd($car_subdata);
		return $car_subdata;
	}


	public static function notify_users_for_savedSearch($car)
	{
		if($usersToNotify = $car->isCarInSavedsearch($car)){

			Notification::send($usersToNotify, new CarPosted($car));

			foreach ($usersToNotify as $UserToNotify) {
				echo "broadcast to : {$UserToNotify->name}<br>";
				broadcast(new CarPostedEvent($UserToNotify->id, $car));
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
			$carIsnotMine = false; 
			if($row->user_id != auth()->id())
				$carIsnotMine = true;
			echo "row.user_id($row->user_id) : car.user_id($car->user_id) >> ".($carIsnotMine? 'car is not mine': 'car is mine')."<br>";

			$conainsBrand = false;
			$containsModel = false;
			if($row->brand_model){ // ROW CONTAINS BRAND & MODEL  // [ [1,[4]], [2,[5]], [3,[7,9]] ]
				foreach (json_decode($row->brand_model, true) as $k => $arr) { 

					$conainsBrand = $conainsBrand || ($arr[0] == $car->brand); 
					
					if(count($arr[1]) == 0){ // no models selected
						$containsModel = true;
					}
					elseif($arr[0] == $car->brand && count($arr[1]) && in_array($car->model, $arr[1])){						
						$containsModel = true;
					}
				}
			}else{
				$conainsBrand = true;
				$containsModel = true;
			}

			$containsArea = false;
			$containsCity = false;
			if($row->areas){ // ROW CONTAINS AREAS  // [ [1,[4]], [2,[5]], [3,[7,9]] ]
				foreach (json_decode($row->areas, true) as $k => $arr) { 

					$containsArea = $containsArea || ($arr[0] == $car->manicipality); 
					
					if(count($arr[1]) == 0){ // no city selected
						$containsCity = true;
					}
					elseif($arr[0] == $car->manicipality && count($arr[1]) && in_array($car->city, $arr[1])){
							$containsCity = true;
					}
				}
			}else{
				$containsArea = true;
				$containsCity = true;
			}

			echo "params: $carIsnotMine + $conainsBrand + $containsModel + $containsArea + $containsCity<br>";
			// ============  Print to debug:
			if($carIsnotMine && $containsArea && $containsCity)
			{
				echo "++ $carIsnotMine , $containsArea , $containsCity<br>";
			}

			if($carIsnotMine && $conainsBrand && $containsModel && $containsArea && $containsCity &&
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


	public function wishlist_type()
	{
		if( auth()->check() && auth()->id() != $this->user_id){ //dd($this->id);
			if( auth()->user()->wishList->contains('car_id', $this->id) ){  //dd(2);
				foreach(auth()->user()->wishList as $wish){  //dd(3);
					if($wish->car_id == $this->id){ // the car exists in my wishlist
						//<wishlistbutton act="remove" data1="{{car.id}}" data2="{{auth()->id()}}" data3="{{$wish->id}}"></wishlistbutton>
						return [1, $wish->id];
					}					
				}
			}
			else { // the car does not exist in my wishlist
				//<wishlistbutton act="add" data1="{{car.id}}" data2="{{auth()->id()}}"></wishlistbutton>			
				return [2];
			}
		}
		elseif( auth()->guest() ){
			//<a href="/login" class="like btn btn-default wish-list"><span class="fa fa-heart"></span> Add to wish list</a>
			return [3];
		}
	}


}
