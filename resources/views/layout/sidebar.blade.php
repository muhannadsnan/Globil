
<div class="saved-search panel panel-success">
	<div class="panel-heading">
		Saved Search
	</div>

	<div class="panel-body">
		@foreach($savedSearch as $savedS)
		
			<li><a href="/saved-search/{{$savedS->id}}" class="">
				{{ ! is_null($savedS->title) ? $savedS->title : "Saved Search {$savedS->id}" }}
			</a></li>		
		
		@endforeach		

		@if(count($savedSearch) == 0)
		
			No Saved Searches yet.
		
		@endif
	</div>
</div>	


<div class="ads panel panel-warning">
	<div class="panel-heading">
		Advertisements
	</div>

	<div class="panel-body">
		<a href="#" class="thumbnail">
			<img src="http://www.takepart.com/sites/default/files/styles/tp_gallery_slide/public/slogan-itok=C7mRvp9G.jpg"/>
		</a>

		<a href="#" class="thumbnail">
			<img src="http://www.toxel.com/wp-content/uploads/2008/07/ua2.jpg"/>
		</a>

		<a href="#" class="thumbnail">
			<img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/6/005/07d/138/3b48a74.jpg"/>
		</a>


	</div>
</div>