<?php

namespace App\Http\Controllers;

use App\SubData;
use Illuminate\Http\Request;

class SubDataController extends Controller
{
	public function readSubData($data1, $data2 = null /*, $data3 = null*/)
	{ //dd($data1,$data2);
		if($data2=="undefined") $data2 = null;

		if( !$res = SubData::subData($data1, $data2)->get())
			return ['ok' => 0, 'message' => "Error while loading {$data1}!"];
		return ['ok' => 1, 'message' => "{$data1} is loaded successfully!", 'data' => $res];
	}

	public function readSubdataBySubID($ntype2, $subID)
	{ //dd($subID);
		@$parentTitle = SubData::find($subID)->title; //dd($parentTitle);
		if( !$res = SubData::subData($ntype2, $parentTitle )->get())
			return ['ok' => 0, 'message' => 'Error while loading "models"!'];
		return ['ok' => 1, 'message' => "Models are loaded successfully!", 'data' => $res];
	}

	public function readDataWithSubdata($data, $subdata)
	{
		if( !$dataRes = SubData::subData($data)->get())
			return ['ok' => 0, 'message' => "Error while loading {$data}!"];

		if( !$subdataRes = SubData::subData($subdata)->get())
			return ['ok' => 0, 'message' => "Error while loading {$subdata}!"];

		return ['ok' => 1, 'message' => "Data is loaded successfully!", 'data' => $dataRes, 'subdata' => $subdataRes];
	}
	

	public function readSubDataTypes()
	{
		if( !$res = SubData::distinct()->get(['ntype']))
			return ['ok' => 0, 'message' => 'Error while loading "NTypes"!'];
		return ['ok' => 1, 'message' => "NTypes are loaded successfully!", 'data' => $res];
	}

	public function store(Request $request)
	{ //dd($request->all());
		if(! $res = SubData::create($request->all() ) )
			return ['ok' => 0, 'message' => 'Error while creating Subdata!'];
		return ['ok' => 1, 'message' => "Subdata created!"];
	}

	public function update(Request $request, SubData $sub)
	{
		if(! $res = SubData::updateSubdata($request, $sub ) )
			return ['ok' => 0, 'message' => 'Error while updating Subdata!'.$sub->id];
		return ['ok' => 1, 'message' => "Subdata updated! #$sub->id"];
	}

	public function destroy(SubData $sub)
	{
		if( !$res = $sub->delete())
			return ['ok' => 0, 'message' => 'Error while deleting Subdata!'];
		return ['ok' => 1, 'message' => "Subdata #$sub->id deleted! "];
	}
}
