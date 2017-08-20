@extends('master')

@section ('saved-search')
	
	@if(@$isSavedSearchLoaded)
		<div class="loadedSavedSearch panel panel-default">
			<div class="panel-body">
				<h3><strong>Saved search: </strong><label>{{$savedSearch->title}}</label></h3>
				{{ $savedSearch->getSummerize($savedSearch) }}
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
