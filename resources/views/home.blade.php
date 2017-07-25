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
			<p>
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
			<p>{{$savedSearch->country ? 'Country: ' . $savedSearch->country : '' }}</p>
			<p>{{$savedSearch->min_price ? 'Price from ' . $savedSearch->min_price . 
						($savedSearch->max_price ? ' to ' . $savedSearch->max_price : '') : '' }}</p> 						
			<p>{{$savedSearch->years ? 'Years: ' . $savedSearch->years : '' }}</p>
			<p>{{$savedSearch->fuel_type ? 'Fuel type: ' . $savedSearch->fuel_type : '' }}</p>
			<p>{{$savedSearch->gear ? 'Gear: ' . $savedSearch->gear : '' }}</p>
			<p>{{$savedSearch->cylinder ? 'Cylinder: ' . $savedSearch->cylinder : '' }}</p>
			<p>{{$savedSearch->car_type ? 'Car type: ' . $savedSearch->car_type : '' }}</p>
			<p>{{$savedSearch->wheel_drive ? 'Wheel drive: ' . $savedSearch->wheel_drive : '' }}</p>
			<p><?php 
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
		<h3>LOADING CARS..</h3>	<hr>
	</div>

	<div v-else class="col-md-12x" :class="{'blur': searchTyping}" v-cloak>
		 <div class="row">

				<div class="latest-posts col-md-12">

					<div class="xx" v-if="isSavedSearchPage" v-show=" ! isActiveSearch">
						@yield('saved-search')					
					</div>
					
					<div class="xx" v-show="searchResult[0] != 'init' && ( !isSavedSearchPage || isActiveSearch)">
						<div class="row">
				 			<div v-if="searchResult.length == 0" class="panel panel-info search-results">
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
	</div>
@endsection
