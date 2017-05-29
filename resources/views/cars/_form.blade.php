	
<div class="col-md-6 form-group {{ $errors->has('brand') ? 'has-error' : '' }}">

	<subdata-select 
		data1="brand" 
		placeholder="Brand"
	 	@brand-changed="loadModelsByBrand" 
	 	@brand-loaded="loadModelsBySubID"
	 	old="{{ old('brand') ? old('brand') : @$car->brand }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('model') ? 'has-error' : '' }}">

	<subdata-select 
		:loadedmodels="models" 
		placeholder="Model" 
		showanyway="true" 
		loadingMSG="Select a brand to show models..." 
		name="model" old="{{ old('model') ? old('model') : @$car->model }}"></subdata-select>
	
</div>


<div class="col-md-6 form-group {{ $errors->has('country') ? 'has-error' : '' }}">

	<subdata-select 
		data1="country" 
		placeholder="Country" 
		old="{{ old('country') ? old('country') : @$car->country }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('year') ? 'has-error' : '' }}">

	<input type="number" name="year" value="{{ old('year') ? old('year') : @$car->year }}" 
		min="1950" max="{{date("Y")}}" onchange="updateRangeLabel(this.value);" class="form-control">

</div>

<!-- ------------ PRICE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('price') ? 'has-error' : '' }}">

	<input name="price" type="number" class="form-control" value="{{ old('price') ? old('price') : @$car->price }}" placeholder="Price" requiredX autofocus>

</div>


<div class="col-md-6 form-group {{ $errors->has('kilometer') ? 'has-error' : '' }}">

	<input name="kilometer" type="number" class="form-control" value="{{ old('kilometer') ? old('kilometer') : @$car->kilometer }}" placeholder="Kilometer" requiredX autofocus>

</div>


<div class="col-md-6 form-group {{ $errors->has('color') ? 'has-error' : '' }}">

	<subdata-select 
		data1="color" 
		placeholder="Color" 
		old="{{ old('color') ? old('color') : @$car->color }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('desc') ? 'has-error' : '' }}">

	<textarea name="desc" class="form-control" placeholder="Description" rows="3" requiredX autofocus>{{ old('desc') ? old('desc') : @$car->desc }}</textarea>

</div>

<!-- ------------ FUEL -------------- -->

<div class="col-md-6 text-left form-group {{ $errors->has('fuel_type_bensin') ? 'has-error' : '' }} ">

	<p><strong>Fuel Type:</strong></p>

	<div class="col-xs-offset-1"> 
		<input name="fuel_type_bensin" type="checkbox" {{ old('fuel_type_bensin') == "on" ? 'checked' : (@$car->fuel_type_bensin=='1'? "checked":'') }} autofocus> Bensin &nbsp; &nbsp;
		<input name="fuel_type_diesel" type="checkbox" {{ old('fuel_type_diesel') == "on" ? 'checked' : (@$car->fuel_type_diesel=='1'? "checked":'') }} autofocus> Diesel <br/>
		<input name="fuel_type_gas" type="checkbox" {{ old('fuel_type_gas') == "on" ? 'checked' : (@$car->fuel_type_gas=='1'? "checked":'') }} autofocus> Gas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="fuel_type_electric" type="checkbox" {{ old('fuel_type_electric') == "on" ? 'checked' : (@$car->fuel_type_electric=='1'? "checked":'') }} autofocus> Electric 
	</div>

</div>

<!-- ------------ GEAR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('gear') ? 'has-error' : '' }}">

	<subdata-select 
		data1="gear" 
		placeholder="Gear" 
		old="{{ old('gear') ? old('gear') : @$car->gear }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
	<input name="weight" type="number" class="form-control" value="{{ old('weight') ? old('weight') : @$car->weight }}" placeholder="Weight" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('cylinder') ? 'has-error' : '' }}">

	<subdata-select data1="cylinder" placeholder="Cylinder" old="{{ old('cylinder') ? old('cylinder') : @$car->cylinder }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('co2') ? 'has-error' : '' }}">
	<input name="co2" type="number" class="form-control" value="{{ old('co2') ? old('co2') : @$car->co2 }}" placeholder="Co2" requiredX autofocus>
</div>

<!-- ------------ CAR TYPE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('car_type') ? 'has-error' : '' }}">
	
	<subdata-select 
		data1="car_type" 
		placeholder="Car Type" 
		old="{{ old('car_type') ? old('car_type') : @$car->car_type }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('roof_type') ? 'has-error' : '' }}">

	<subdata-select 
		data1="roof_type" 
		placeholder="Roof Type" 
		old="{{ old('roof_type') ? old('roof_type') : @$car->roof_type }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('HP') ? 'has-error' : '' }}">
	<input name="HP" type="number" class="form-control" value="{{ old('HP') ? old('HP') : @$car->HP }}" placeholder="HP" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('wheel_drive') ? 'has-error' : '' }}">
	
	<subdata-select 
		data1="wheel_drive" 
		placeholder="Wheel Drive" 
		old="{{ old('wheel_drive') ? old('wheel_drive') : @$car->wheel_drive }}"></subdata-select>

</div>

<!-- ------------ REG NR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('reg_nr') ? 'has-error' : '' }}">
	<input name="reg_nr" type="text" class="form-control" value="{{ old('reg_nr') ? old('reg_nr') : @$car->reg_nr }}" placeholder="Registering number" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('reg_fee') ? 'has-error' : '' }}">
	<input name="reg_fee" type="number" class="form-control" value="{{ old('reg_fee') ? old('reg_fee') : @$car->reg_fee }}" placeholder="Registering fee" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('yearly_fee') ? 'has-error' : '' }}">
	<input name="yearly_fee" type="number" class="form-control" value="{{ old('yearly_fee') ? old('yearly_fee') : @$car->yearly_fee }}" placeholder="Yearly fee" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('images') ? 'has-error' : '' }}">
	<input name="images[]" type="file" class="form-control" value="{{ old('images[]') }}" multiple >
</div>


