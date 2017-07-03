@extends('master')

@section('content')

<div class="loading " v-if="loadingPage">
	<h3>LOADING POSTS.. </h3>
	<hr>
</div>

<div v-else class="col-md-12x" v-if=""  :class="{'blur': searchTyping}" v-cloak>
	 <div class="row">

			<div class="latest-posts col-md-12">
				 
				 <!-- <h3 class="hd-primary">Latest Posts</h3> -->
				 		<div v-show="searchResult[0] == 'init' " class="row">
<!-- 							@foreach($latestCars as $car)
							
								@include('cars._card')
							
							@endforeach
					 		 -->
							<!--  <div class="col-xs-12">
						 		<div class="pagination">
									{{ $latestCars->links() }}				 			
						 		</div>
					 		</div> -->
				 		</div>

				 		<div v-if="searchResult[0] != 'init' " class="row">
				 			<div v-if="searchResult.length == 0" class="panel panel-info" v-cloak>
				 				<h3>No results found.</h3>
				 			</div>

				 			@include('cars._cardInVue')

				 		</div>

<!-- 				 		<div class="col-xs-12">
					 		<pagination :data="paginator"
						 		@pagination-change-page="getPaginateResults"></pagination>
				 		</div> -->

				 <div class="col-xs-12 form-group">
						<button v-if="isActiveSearch" @click="loadMoreResults" :disabled="moreResults == 0" class="btn btn-info btn-lg">Load more</button>
						<button v-else @click="loadMoreLatestPosts" :disabled="moreResults == 0" class="btn btn-warning btn-lg">Load more</button>
				 </div>

			</div>

				 		
	 </div>
</div>

@endsection

