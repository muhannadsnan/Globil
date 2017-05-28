	
<div class="col-md-6 form-group {{ $errors->has('brand') ? 'has-error' : '' }}">

	<subdata-select 
		data1="brand" 
		placeholder="Brand"
	 	@brand-changed="loadModelsByBrand" 
	 	@brand-loaded="loadModelsBySubID"
	 	old="{{ old('brand') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('model') ? 'has-error' : '' }}">

	<subdata-select 
		:loadedmodels="models" 
		placeholder="Model" 
		showanyway="true" 
		loadingMSG="Select a brand to show models..." 
		name="model" old="{{ old('model') }}"></subdata-select>
	
</div>


<div class="col-md-6 form-group {{ $errors->has('country') ? 'has-error' : '' }}">

	<subdata-select data1="country" placeholder="Country" old="{{ old('country') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('year') ? 'has-error' : '' }}">

	<select name="year" class="form-control" value="{{ old('year') }}" autofocus>

		<option disabled selected> Year </option>

		@foreach(range(date("Y"), 1970) as $num)
			<option value="{{ $num }}">{{ $num }}</option>		
		@endforeach

	</select>

</div>

<!-- ------------ PRICE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('price') ? 'has-error' : '' }}">

	<input name="price" type="number" class="form-control" value="{{ old('price') }}" placeholder="Price" requiredX autofocus>

</div>


<div class="col-md-6 form-group {{ $errors->has('kilometer') ? 'has-error' : '' }}">

	<input name="kilometer" type="number" class="form-control" value="{{ old('kilometer') }}" placeholder="Kilometer" requiredX autofocus>

</div>


<div class="col-md-6 form-group {{ $errors->has('color') ? 'has-error' : '' }}">

	<subdata-select data1="color" placeholder="Color" old="{{ old('color') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('desc') ? 'has-error' : '' }}">

	<textarea name="desc" class="form-control" placeholder="Description" rows="3" requiredX autofocus>{{ old('desc') }}</textarea>

</div>

<!-- ------------ FUEL -------------- -->

<div class="col-md-6 text-left form-group {{ $errors->has('fuel_type_bensin') ? 'has-error' : '' }} ">

	<p><strong>Fuel Type:</strong></p>

	<div class="col-xs-offset-1"> 
		<input name="fuel_type_bensin" type="checkbox" {{ old('fuel_type_bensin') == "on" ? 'checked' : '' }} autofocus> Bensin &nbsp; &nbsp;
		<input name="fuel_type_diesel" type="checkbox" {{ old('fuel_type_diesel') == "on" ? 'checked' : '' }} autofocus> Diesel <br/>
		<input name="fuel_type_gas" type="checkbox" {{ old('fuel_type_gas') == "on" ? 'checked' : '' }} autofocus> Gas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="fuel_type_electric" type="checkbox" {{ old('fuel_type_electric') == "on" ? 'checked' : '' }} autofocus> Electric 
	</div>

</div>

<!-- ------------ GEAR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('gear') ? 'has-error' : '' }}">

	<subdata-select data1="gear" placeholder="Gear" old="{{ old('gear') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
	<input name="weight" type="number" class="form-control" value="{{ old('weight') }}" placeholder="Weight" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('cylinder') ? 'has-error' : '' }}">

	<subdata-select data1="cylinder" placeholder="Cylinder" old="{{ old('cylinder') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('co2') ? 'has-error' : '' }}">
	<input name="co2" type="number" class="form-control" value="{{ old('co2') }}" placeholder="Co2" requiredX autofocus>
</div>

<!-- ------------ CAR TYPE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('car_type') ? 'has-error' : '' }}">
	
	<subdata-select data1="car_type" placeholder="Car Type" old="{{ old('car_type') }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('roof_type') ? 'has-error' : '' }}">

	<subdata-select data1="roof_type" placeholder="Roof Type" old="{{ old('roof_type') }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('HP') ? 'has-error' : '' }}">
	<input name="HP" type="number" class="form-control" value="{{ old('HP') }}" placeholder="HP" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('wheel_drive') ? 'has-error' : '' }}">
	
	<subdata-select data1="wheel_drive" placeholder="Wheel Drive" old="{{ old('wheel_drive') }}"></subdata-select>

</div>

<!-- ------------ REG NR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('reg_nr') ? 'has-error' : '' }}">
	<input name="reg_nr" type="text" class="form-control" value="{{ old('reg_nr') }}" placeholder="Registering number" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('reg_fee') ? 'has-error' : '' }}">
	<input name="reg_fee" type="number" class="form-control" value="{{ old('reg_fee') }}" placeholder="Registering fee" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('yearly_fee') ? 'has-error' : '' }}">
	<input name="yearly_fee" type="number" class="form-control" value="{{ old('yearly_fee') }}" placeholder="Yearly fee" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('images') ? 'has-error' : '' }}">
	<input name="images[]" type="file" class="form-control" value="{{ old('images[]') }}" multiple >
</div>

