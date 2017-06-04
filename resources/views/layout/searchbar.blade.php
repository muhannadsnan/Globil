
<!-- #SEARCHBAR -->

<div class="panel panel-info">

	<div class="list-group panel">


		<div class="form-group">
			<input type="search" @keyup.enter="searchKeyEnter()" v-model="searchKeyword" class="form-control" placeholder="Search car brands and models.." >
		</div>

		<div class="panel-info">
			<div class="panel-heading">
				<h3>Filters</h3>			
			</div>

			<!-- <div class="panel-body">
				@foreach(App\SubData::where('ntype', 'brand')->get() as $sub)
				
					<div class="text-left  ">
						<input type="checkbox" name="brand" value="{{$sub->title}}">
						<label for="brand">{{$sub->title}}</label>
					</div>
				
				@endforeach
			</div> -->

			<search-brand-model 
				@brand-checked="filterCars"
				@brand-unchecked="removeCars"></search-brand-model>
			
		</div>
		
			

	</div>

</div>