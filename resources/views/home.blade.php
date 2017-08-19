@extends('master')

@section ('saved-search')
	
	@if(@$isSavedSearchLoaded)
		<div class="loadedSavedSearch panel panel-default">
			 <div class="panel-body">
				<h3><strong>Saved search: </strong><label>{{$savedSearch->title}}</label></h3>
				<p class="col-md-6">
					<?php 
						if($savedSearch->brand_model){
							echo 'Brands: ';
							foreach($savedSearch->idsToBrands() as $brand){
			 					echo $brand.' [ ';
			 					if(count(@$savedSearch->idsToModels()[$brand])){
			 						foreach($savedSearch->idsToModels()[$brand] as $model){
				 						echo $model.' ';
				 					}
			 					}
			 					echo ' ] , ';
							}
						}
					?>
				</p>
				<p class="col-md-6">
					<?php 
						if($savedSearch->areas){
							echo 'Areas: ';
							foreach($savedSearch->idsToAreas() as $manicipality){
			 					echo $manicipality.' [ ';
			 					if(count(@$savedSearch->idsToCities()[$manicipality])){
			 						foreach($savedSearch->idsToCities()[$manicipality] as $city){
				 						echo $city.' ';
				 					}
			 					}
			 					echo ' ] , ';
							}
						}
					?>
				</p>
				<p class="col-md-6">
					{{$savedSearch->min_price ? 'Price from ' . $savedSearch->min_price . 
							($savedSearch->max_price ? ' to ' . $savedSearch->max_price : '') . ' NOK' : '' }}</p> 						
				<p class="col-md-6">
					{{$savedSearch->years ? 'Years: ' . $savedSearch->years : '' }}</p>
				<p class="col-md-6">
					{{$savedSearch->fuel_type ? 'Fuel type: ' . $savedSearch->fuel_typeSubdata() : '' }}</p>
				<p class="col-md-6">
					{{$savedSearch->gear ? 'Gear: ' . $savedSearch->gearSubdata() : '' }}</p>
				<p class="col-md-6">
					{{$savedSearch->cylinder ? 'Cylinder: ' . $savedSearch->cylinderSubdata() : '' }}</p>
				<p class="col-md-6">
					{{$savedSearch->car_type ? 'Car type: ' . $savedSearch->car_typeSubdata() : '' }}</p>
				<p class="col-md-6">
					{{$savedSearch->wheel_drive ? 'Wheel drive: ' . $savedSearch->wheel_driveSubdata() : '' }}</p>
				<p class="col-md-6"><?php 
					if($savedSearch->min_kilometer){
						if($savedSearch->min_kilometer == 0 && $savedSearch->max_kilometer > 0){
							echo 'kilometer less than '.$savedSearch->max_kilometer;
						}elseif($savedSearch->min_kilometer > 0){
							echo 'Kilometer starting from '.$savedSearch->min_kilometer;
							if($savedSearch->max_kilometer > 0)
								echo  ' to ' . $savedSearch->max_kilometer;
						}
					} ?></p>
				 </div>
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

	<div v-if="loadingPage || searchResult[0] == 'init' " class="loading" >
		<h3>LOADING CARS..</h3>
		<img src="{{asset('images/loading/loading-car.gif')}}">
	</div>
	<div v-else class="col-md-12x" :class="{'blur': searchTyping || loadingPage}" v-cloak>
		 <div class="row">

				<div class="latest-posts col-md-12" hide>

					<div class="xx" v-if="isSavedSearchPage" v-show=" ! isActiveSearch">
						@yield('saved-search')					
					</div>
					
					<div class="xx" v-show="searchResult[0] != 'init' && ( !isSavedSearchPage || isActiveSearch)">
						<div class="row">

			 				<h3 v-if="searchResult.length == 0 && !loadingPage">
			 					No results found.</h3>

			 				@include('cars._cardInVue')
				 		</div>
						 
						<div class="col-xs-12 form-group">
							<button v-if="isActiveSearch" @click="loadingModel = true; loadMoreResults();" :disabled="moreResults == 0" class="btn btn-info btn-lg">Load more</button>
							<button v-else @click="loadingModel = true; loadMoreLatestPosts();" :disabled="moreResults == 0" class="btn btn-warning btn-lg">Load more</button>
						</div>
					</div>		 			

				</div>				 		
		 </div>
	</div>
@endsection
