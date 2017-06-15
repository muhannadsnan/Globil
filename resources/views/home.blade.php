@extends('master')

@section('content')
<!-- <h3>@{{loadingPage}}</h3> -->
<div class="loading " v-if="loadingPage">
	<h3>LOADING POSTS.. </h3><hr>
</div>
<div v-else class="col-md-12x" v-if=""  :class="{'blur': searchTyping}" v-cloak>
	 <div class="row">

			<div class="latest-posts col-md-12">
				 
				 <!-- <h3 class="hd-primary">Latest Posts</h3> -->
				 		<div v-show="searchResult[0] == 'init' ">
							@foreach($latestCars as $car)
							
								@include('cars._card')
							
							@endforeach
				 		</div>

				 		<div v-if="searchResult[0] != 'init' ">
				 			<div v-if="searchResult.length == 0" class="panel panel-info" v-cloak>
				 				<h3>No results found.</h3>
				 			</div>

				 			@include('cars._cardInVue')
				 		</div>
						
				 <div class="col-xs-12 form-group">
						<button class="btn btn-info btn-lg">Load more</button>
				 </div>

			</div>
	 </div>
</div>

@endsection
