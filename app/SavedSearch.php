<?php

namespace App;

use App\SavedSearch;

//use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
	protected $table = 'saved_searches';


	public static function storeSearch($request)
	{
		SavedSearch::create([ 
				'title' => is_null($request->title) ? '' : $request->title,
				'users' => ! $request->users ? null : json_encode($request->users),
				'brand_model' => ! $request->brand_model ? null : json_encode($request->brand_model),
				'country' => ! $request->country ? null : json_encode($request->country),
				'year' => ! $request->year ? null : json_encode($request->year),
				'color' => ! $request->color ? null : json_encode($request->color),
				'desc' => ! $request->desc ? null : json_encode($request->desc),
				'fuel_type' => ! $request->fuel_type ? null : json_encode($request->fuel_type),
				'gear' => ! $request->gear ? null : json_encode($request->gear),
				'cylinder' => ! $request->cylinder ? null : json_encode($request->cylinder),
				'car_type' => ! $request->car_type ? null : json_encode($request->car_type),
				'roof_type' => ! $request->roof_type ? null : json_encode($request->roof_type),
				'wheel_drive' => ! $request->wheel_drive ? null : json_encode($request->wheel_drive),
				'reg_nr' => ! $request->reg_nr ? null : json_encode($request->reg_nr),
				'min_price' => $request->min_price,
				'max_price' => $request->max_price,
				'min_kilometer' => $request->min_kilometer,
				'max_kilometer' => $request->max_kilometer,
				'min_weight' => $request->min_weight,
				'max_weight' => $request->max_weight,
				'min_co2' => $request->min_co2,
				'max_co2' => $request->max_co2,
				'min_HP' => $request->min_HP,
				'max_HP' => $request->max_HP,
				'min_reg_fee' => $request->min_reg_fee,
				'max_reg_fee' => $request->max_reg_fee,
				'min_yearly_fee' => $request->min_yearly_fee,
				'max_yearly_fee' => $request->max_yearly_fee,
			]);
		return true;
	}
}