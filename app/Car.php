<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{

	// protected $fillable = ['...'];

	public static function createCar($request)
	{
		Car::create([
			"brand" => $request['brand'],
			"model" => $request['model'],
			"country" => $request['country'],
			"price" => $request['price'],
			"year" => $request['year'],
			"kilometer" => $request['kilometer'],
			"color" => $request['color'],
			"desc" => $request['desc'],
			"fuel_type_bensin" => $request['fuel_type_bensin'] == "on" ? 1 : null,
			"fuel_type_diesel" => $request['fuel_type_diesel'] == "on" ? 1 : null,
			"fuel_type_gas" => $request['fuel_type_gas'] == "on" ? 1 : null,
			"fuel_type_electric" => $request['fuel_type_electric'] == "on" ? 1 : null,
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
			"brand" => 'requiRed|max:255',
			"model" => 'required|max:255',
			"country" => 'required|max:255',
			"year" => 'required|max:255',
			"price" => 'required|numeric',
			"kilometer" => 'required|numeric',
			"color" => 'required|max:7',
			"desc" => 'required', //required_without
			"fuel_type_bensin" => 'required_without_all:fuel_type_diesel,fuel_type_gas,fuel_type_electric',
			"fuel_type_diesel" => 'required_without_all:fuel_type_bensin,fuel_type_gas,fuel_type_electric',
			"fuel_type_gas" => 'required_without_all:fuel_type_bensin,fuel_type_diesel,fuel_type_electric',
			"fuel_type_electric" => 'required_without_all:fuel_type_bensin,fuel_type_diesel,fuel_type_gas',
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
		];
	}
}
