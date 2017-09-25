@if(@$isHomePage)

<div class="saved-search panel panel-success">
	<div class="panel-heading">
		Saved Search
	</div>

	<div class="panel-body text-left">
		@if(isset($savedSearches))
		
			@foreach($savedSearches as $savedS)	

				<li><a href="/saved-search/{{$savedS->id}}" class="" v-cloak>
					{{ ! is_null($savedS->title) ? $savedS->title : "Saved Search {$savedS->id}" }}
				</a></li>		
					
			@endforeach

			@if(count($savedSearches) == 0)			
				<label class="" v-cloak>No Saved Searches yet.</label>			
			@else
				<a href="/my-saved-searches" class="btn btn-success">See all</a>			
			@endif
		
		@endif
	</div>
</div>

@endif