<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubData;

class SubData extends Model
{
	protected $table = 'sub-data';
	protected $fillable = ['ntype', 'ntype2', 'ntype3', 'title'];

	public static function updateSubdata($request, $sub)
	{
		$sub->fill($request->all());
		$sub->save();
		return true;
	}

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

}