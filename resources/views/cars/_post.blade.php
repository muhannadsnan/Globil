	
<div class="col-md-6 form-group {{ $errors->has('brand') ? 'has-error' : '' }}">

	<subdata-select data1="brand" placeholder="Brand" @brand-changed="loadModelsByBrand" old="{{ old('brand') }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('model') ? 'has-error' : '' }}">

	<subdata-select :loadedmodels="models" placeholder="Model" loadingMSG="Select a brand to show models..."></subdata-select>
	
</div>





<div class="col-md-6 form-group {{ $errors->has('country') ? 'has-error' : '' }}">
	<input name="country" type="text" class="form-control" value="{{ old('country') }}" placeholder="Country" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('year') ? 'has-error' : '' }}">
	<input name="year" type="text" class="form-control" value="{{ old('year') }}" placeholder="Year" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('price') ? 'has-error' : '' }}">
	<input name="price" type="text" class="form-control" value="{{ old('price') }}" placeholder="Price" requiredX autofocus>
</div>





<div class="col-md-6 form-group {{ $errors->has('kilometer') ? 'has-error' : '' }}">
	<input name="kilometer" type="text" class="form-control" value="{{ old('kilometer') }}" placeholder="Kilometer" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('color') ? 'has-error' : '' }}">
	<input name="color" type="text" class="form-control" value="{{ old('color') }}" placeholder="Color" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
	<textarea name="desc" class="form-control" placeholder="Description" rows="3" requiredX autofocus>{{ old('desc') }}</textarea>
</div>


<div class="col-md-6 text-left form-group {{ $errors->has('fuel') ? 'has-error' : '' }} ">
	<p><strong>Fuel Type:</strong></p>
	<div class="col-xs-offset-1"> 
		<input name="fuel_type_bensin" type="checkbox" {{ old('fuel_type_bensin') == "on" ? 'checked' : '' }} autofocus> Bensin &nbsp; &nbsp;
		<input name="fuel_type_diesel" type="checkbox" {{ old('fuel_type_diesel') == "on" ? 'checked' : '' }} autofocus> Diesel <br/>
		<input name="fuel_type_gas" type="checkbox" {{ old('fuel_type_gas') == "on" ? 'checked' : '' }} autofocus> Gas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="fuel_type_electric" type="checkbox" {{ old('fuel_type_electric') == "on" ? 'checked' : '' }} autofocus> Electric 
	</div>
</div>

<!-- ------ -->

<div class="col-md-6 form-group {{ $errors->has('gear') ? 'has-error' : '' }}">
	<input name="gear" type="text" class="form-control" value="{{ old('gear') }}" placeholder="Gear" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
	<input name="weight" type="text" class="form-control" value="{{ old('weight') }}" placeholder="Weight" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('cylinder') ? 'has-error' : '' }}">
	<input name="cylinder" type="text" class="form-control" value="{{ old('cylinder') }}" placeholder="Cylinder" requiredX autofocus>
</div>

<!-- ----------------------------- -->

<div class="col-md-6 form-group {{ $errors->has('co2') ? 'has-error' : '' }}">
	<input name="co2" type="text" class="form-control" value="{{ old('co2') }}" placeholder="Co2" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('car_type') ? 'has-error' : '' }}">
	<input name="car_type" type="text" class="form-control" value="{{ old('car_type') }}" placeholder="Car type" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('roof_type') ? 'has-error' : '' }}">
	<input name="roof_type" type="text" class="form-control" value="{{ old('roof_type') }}" placeholder="Roof type" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('HP') ? 'has-error' : '' }}">
	<input name="HP" type="text" class="form-control" value="{{ old('HP') }}" placeholder="HP" requiredX autofocus>
</div>






<div class="col-md-6 form-group {{ $errors->has('wheel_drive') ? 'has-error' : '' }}">
	<input name="wheel_drive" type="text" class="form-control" value="{{ old('wheel_drive') }}" placeholder="Wheel drive" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('reg_nr') ? 'has-error' : '' }}">
	<input name="reg_nr" type="text" class="form-control" value="{{ old('reg_nr') }}" placeholder="Registering number" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('reg_fee') ? 'has-error' : '' }}">
	<input name="reg_fee" type="text" class="form-control" value="{{ old('reg_fee') }}" placeholder="Registering fee" requiredX autofocus>
</div>

<div class="col-md-6 form-group {{ $errors->has('yearly_fee') ? 'has-error' : '' }}">
	<input name="yearly_fee" type="text" class="form-control" value="{{ old('yearly_fee') }}" placeholder="Yearly fee" requiredX autofocus>
</div>


<div class="col-md-6 form-group {{ $errors->has('images') ? 'has-error' : '' }}">
	<input name="images[]" type="file" class="form-control" value="{{ old('images[]') }}" multiple >
</div>


