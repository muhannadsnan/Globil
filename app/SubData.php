<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubData extends Model
{
	protected $table = 'sub-data';
	protected $fillable = ['ntypex', 'title'];

// ============= SCOPEs ============= 

	

	public function scopeSubData($query, $ntype, $ntype2 = null, $ntype3 = null, $subID = null) // Dynamic scope
	{
		$res = $query->where('ntype', 'like', $ntype); // $brands = SubData::subData('brand')->get();

		if(! is_null($ntype2) ){
			$res->where('ntype2', 'like', $ntype2); // SubData::subData('model', 'BMW')->get();  SubData::subData('year', 'BMW')->get();

			if( ! is_null($ntype3)){
				$res->where('ntype3', 'like', $ntype3); //SubData::subData('year', 'M3', 'BMW')->get();
			}			
		}

		return $res;
	}


	// SEARCH FILTERS SCOPE

	public function scopeSearchFilters($query, $filters = [])
	{
		return $query->where($filters); // SubData::SearchFilters(['brand'=>'BMW', 'model'=>'M3', 'roofType'=>3, 'ABS'=>1])->get();
	}
}
