@if(isset($isHomePage) && $isHomePage)

<div class="saved-search panel panel-success">
	<div class="panel-heading">
		Saved Search
	</div>

	<div class="panel-body text-left">
		@if(isset($savedSearch))
		
			@foreach($savedSearch as $savedS)
		
				<li><a href="/saved-search/{{$savedS->id}}" class="">
					{{ ! is_null($savedS->title) ? $savedS->title : "Saved Search {$savedS->id}" }}
				</a></li>		
			
			@endforeach		

			@if(count($savedSearch) == 0)
			
				No Saved Searches yet.
			
			@endif
		
		@endif
	</div>
</div>

@endif

<!-- <div class="ads panel panel-warning">
	<div class="panel-heading">
		Advertisements
	</div>

	<div class="panel-body">

		<ads type="sidebar" items="4" refresh="20"></ads>

	</div>
</div> -->


