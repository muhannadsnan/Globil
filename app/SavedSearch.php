<?php

namespace App;

use App\SavedSearch;

//use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
	protected $table = 'saved_searches';


	public static function storeSearch($request)
	{ //dd($request);
		SavedSearch::create([ 
				'title' => is_null($request->title) ? '' : $request->title,
				'users' => ! $request->users ? null : json_encode($request->users),
				'user_id' => auth()->id(),
				'brand_model' => ! $request->brand_model ? null : json_encode($request->brand_model),
				'min_price' => ! $request->priceRange ? null : $request->priceRange[0],
				'max_price' => ! $request->priceRange ? null : $request->priceRange[1],
				'year' => ! $request->years ? null : json_encode($request->years),
				'car_type' => ! $request->car_types ? null : json_encode($request->car_types),
				'wheel_drive' => ! $request->wheel_drives ? null : json_encode($request->wheel_drives),
				'min_kilometer' => $request->kmRange[0],
				'max_kilometer' => $request->kmRange[1],
				'fuel_type' => ! $request->fuel_types ? null : json_encode($request->fuel_types),
				'gear' => ! $request->gears ? null : json_encode($request->gears),
				// 'areas' => $request->areas, 
				// [
				// 	[vestfold, [v1,v2,v4] ], 
				// 	[østfold, [o1,o2,o3] ],
				// 	[nordland, [n1,n2,n3] ]
				// ]

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

	public function scopeIdToTitle($query, $id)
	{
		return SubData::where('id', $id)->get(['title'])[0]->title;
	}
}