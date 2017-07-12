@extends('master')

@section ('saved-search')
	
	@if(@$isSavedSearchLoaded)
		<div class="loadedSavedSearch">
			<small></small>
			<label>{{$savedSearch->title}}</label>
			<p>
				<?php 
					if($savedSearch->brand_model){
						echo 'Brands: ';
						foreach($savedSearch->idsToBrands() as $brand){
		 					echo $brand.' [ ';
		 					if(count($savedSearch->idsToModels())){
		 						foreach($savedSearch->idsToModels()[$brand] as $model){
			 						echo $model.' ';
			 					}
		 					}
		 					echo ' ] , ';
						}
					}
				?>
			</p>
			<p>{{$savedSearch->country ? 'Country: ' . $savedSearch->country : '' }}</p>
			<p>{{$savedSearch->years ? 'Years: ' . $savedSearch->years : '' }}</p>
			<p>{{$savedSearch->color ? 'Color: ' . $savedSearch->color : '' }}</p>
			<p>{{$savedSearch->fuel_type ? 'Fuel type: ' . $savedSearch->fuel_type : '' }}</p>
			<p>{{$savedSearch->gear ? 'Gear: ' . $savedSearch->gear : '' }}</p>
			<p>{{$savedSearch->cylinder ? 'Cylinder: ' . $savedSearch->cylinder : '' }}</p>
			<p>{{$savedSearch->car_type ? 'Car type: ' . $savedSearch->car_type : '' }}</p>
			<p>{{$savedSearch->roof_type ? 'Roof type: ' . $savedSearch->roof_type : '' }}</p>
			<p>{{$savedSearch->wheel_drive ? 'Wheel drive: ' . $savedSearch->wheel_drive : '' }}</p>
			<p>{{$savedSearch->reg_nr ? 'Reg number: ' . $savedSearch->reg_nr : '' }}</p>
			<p>{{$savedSearch->min_price ? 'Price from ' . $savedSearch->min_ : '' }}</p> 
			<p>{{$savedSearch->max_price ? 'to ' . $savedSearch->max_price : '' }}</p>
			<p>{{$savedSearch->min_kilometer ? 'Kilometer from ' . $savedSearch->min_kilo : '' }}</p>
			<p>{{$savedSearch->max_kilometer ? 'to ' . $savedSearch->max_kilometer : '' }}</p>
			<p>{{$savedSearch->min_weight ? 'Weight from ' . $savedSearch->min_w : '' }}</p>
			<p>{{$savedSearch->max_weight ? 'to ' . $savedSearch->max_weight : '' }}</p>
			<p>{{$savedSearch->min_co2 ? 'CO2 from ' . $savedSearch->mi : '' }}</p>
			<p>{{$savedSearch->max_co2 ? 'to ' . $savedSearch->max_co2 : '' }}</p>
			<p>{{$savedSearch->min_hp ? 'HP from ' . $savedSearch->m : '' }}</p>
			<p>{{$savedSearch->max_hp ? 'to ' . $savedSearch->max_hp : '' }}</p>
			<p>{{$savedSearch->min_reg_fee ? 'Reg fee from ' . $savedSearch->min_re : '' }}</p>
			<p>{{$savedSearch->max_reg_fee ? 'to ' . $savedSearch->max_reg_fee : '' }}</p>
			<p>{{$savedSearch->min_yearly_fee ? 'Yearly fee' . $savedSearch->min_yearl : '' }}</p>
			<p>{{$savedSearch->max_yearly_fee ? 'to ' . $savedSearch->max_yearly_fee : '' }}</p>
		</div>
		<!-- ============================ -->
		<div class="row">
			@foreach($sSearchRes as $car)
				
				@include('cars._card')
			
			@endforeach
		</div>
		<!-- ============================ -->
	@endif

@endsection


@section('content')

	<div v-if="loadingPage" class="loading">
		<h3>LOADING POSTS..</h3>	<hr>
	</div>

	<div v-else class="col-md-12x" v-if=""  :class="{'blur': searchTyping}" v-cloak>
		 <div class="row">

				<div class="latest-posts col-md-12">

					@yield('saved-search')

					<hr>
					
		 			<div v-if="searchResult[0] != 'init' " class="row">
			 			<div v-if="searchResult.length == 0" class="panel panel-info search-results" v-cloak>
			 				<h3>No results found.</h3>			 				
			 			</div>
		 				@include('cars._cardInVue')
			 		</div>
					 
					<div class="col-xs-12 form-group">
						<button v-if="isActiveSearch" @click="loadMoreResults" :disabled="moreResults == 0" class="btn btn-info btn-lg">Load more</button>
						<button v-else @click="loadMoreLatestPosts" :disabled="moreResults == 0" class="btn btn-warning btn-lg">Load more</button>
					</div>

				</div>				 		
		 </div>
	</div>
@endsection
