<div class="row">
	
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
		data1="model" old="{{ old('model') ? old('model') : @$car->model }}"></subdata-select>
	
</div>


<!-- <div class="col-md-6 form-group {{ $errors->has('country') ? 'has-error' : '' }}">

	<subdata-select 
		data1="country" 
		placeholder="Country" 
		old="{{ old('country') ? old('country') : @$car->country }}"></subdata-select>

</div> -->


<div class="col-md-6 form-group {{ $errors->has('year') ? 'has-error' : '' }}">

	<div class="SubDataSelect input-group">
        <span class="input-group-addon">Year</span>
        <select class="form-control" name="year" autofocus requiredX> 

            @if(!@$update)	<option selected disabled> </option>  @endif
            @foreach(range(date("Y"), 1950) as $year)
            	<option value="{{$year}}" {{ old('year') == $year || @$car->year == $year ? 'selected' : '' }} >
            		{{$year}}</option>
            @endforeach            	

        </select>
    </div>
</div>

<!-- ------------ PRICE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('price') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Price</span>@endif
		<input name="price" step="1" type="number" class="form-control" value="{{ old('price') ? old('price') : @$car->price }}" placeholder="Price" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>


<div class="col-md-6 form-group {{ $errors->has('kilometer') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Kilometer</span>@endif
		<input name="kilometer" step="1" type="number" class="form-control" value="{{ old('kilometer') ? old('kilometer') : @$car->kilometer }}" placeholder="Kilometer" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
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

	<subdata-select 
		data1="fuel_type" 
		placeholder="Fuel Type" 
		old="{{ old('fuel_type') ? old('fuel_type') : @$car->fuel_type }}"></subdata-select>

</div>

<!-- ------------ GEAR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('gear') ? 'has-error' : '' }}">

	<subdata-select 
		data1="gear" 
		placeholder="Gear" 
		old="{{ old('gear') ? old('gear') : @$car->gear }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Weight</span>@endif
		<input name="weight" step="1" type="number" class="form-control" value="{{ old('weight') ? old('weight') : @$car->weight }}" placeholder="Weight" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif	
</div>


<div class="col-md-6 form-group {{ $errors->has('cylinder') ? 'has-error' : '' }}">

	<subdata-select data1="cylinder" placeholder="Cylinder" old="{{ old('cylinder') ? old('cylinder') : @$car->cylinder }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('co2') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">CO2</span>@endif
		<input name="co2" step="1" type="number" class="form-control" value="{{ old('co2') ? old('co2') : @$car->co2 }}" placeholder="Co2" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>

<!-- ------------ CAR TYPE -------------- -->

<div class="col-md-6 form-group {{ $errors->has('car_type') ? 'has-error' : '' }}">
	
	<subdata-select 
		data1="car_type" 
		placeholder="Car Type" 
		old="{{ old('car_type') ? old('car_type') : @$car->car_type }}"></subdata-select>

</div>

<!-- ------------ AREA -------------- -->

<div class="col-md-6 form-group {{ $errors->has('manicipality') ? 'has-error' : '' }}">
	
	<subdata-select 
		data1="area" 
		placeholder="Manicipality"
	 	@area-changed="loadCitiesByArea" 
	 	@area-loaded="loadCitiesBySubID"
	 	name="manicipality"
	 	old="{{ old('manicipality') ? old('manicipality') : @$car->manicipality }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('city') ? 'has-error' : '' }}">
	
	<subdata-select 
		:loadedcities="cities" 
		placeholder="City" 
		showanyway="true" 
		loadingMSG="Select a municipality to show cities..." 
		name="city"
		data1="city" old="{{ old('city') ? old('city') : @$car->city }}"></subdata-select>

</div>


<div class="col-md-6 form-group {{ $errors->has('roof_type') ? 'has-error' : '' }}">

	<subdata-select 
		data1="roof_type" 
		placeholder="Roof Type" 
		old="{{ old('roof_type') ? old('roof_type') : @$car->roof_type }}"></subdata-select>

</div>

<div class="col-md-6 form-group {{ $errors->has('HP') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group">
		<span class="input-group-addon">HP</span>@endif
		<input name="HP" step="1" type="number" class="form-control" value="{{ old('HP') ? old('HP') : @$car->HP }}" 
				placeholder="HP" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>

<div class="col-md-6 form-group {{ $errors->has('wheel_drive') ? 'has-error' : '' }}">
	
	<subdata-select 
		data1="wheel_drive" 
		placeholder="Wheel Drive" 
		old="{{ old('wheel_drive') ? old('wheel_drive') : @$car->wheel_drive }}"></subdata-select>

</div>

<!-- ------------ REG NR -------------- -->

<div class="col-md-6 form-group {{ $errors->has('reg_nr') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Reg nr</span>@endif
		<input name="reg_nr" type="text" class="form-control" value="{{ old('reg_nr') ? old('reg_nr') : @$car->reg_nr }}"
				placeholder="Registering number" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>

<div class="col-md-6 form-group {{ $errors->has('reg_fee') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Reg fee</span>@endif
		<input name="reg_fee" step="1" type="number" class="form-control" 
				value="{{ old('reg_fee') ? old('reg_fee') : @$car->reg_fee }}" placeholder="Registering fee" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>

<div class="col-md-6 form-group {{ $errors->has('yearly_fee') ? 'has-error' : '' }}">
	@if(@$update) <div class="SubDataSelect input-group"><span class="input-group-addon">Yearly fee</span>@endif
		<input name="yearly_fee" step="1" type="number" class="form-control" 
				value="{{ old('yearly_fee') ? old('yearly_fee') : @$car->yearly_fee }}" placeholder="Yearly fee" autocomplete="off" min="0" requiredX autofocus>
	@if(@$update) </div> @endif
</div>

<div class="col-md-6 form-group {{ $errors->has('images') ? 'has-error' : '' }}">
	<input name="images[]" type="file" class="form-control" value="{{ old('images[]') }}" multiple >
</div>


</div>