<div class="col-xs-6 col-sm-4 col-md-3 car-card">

	<div class="thumbnail panel-info">

		<img src="{{ asset('storage/images') .'/'. @$car->pictures[0]->id .'.'. @$car->pictures[0]->ext }}" alt="...">

		<div class="caption">			

			<p class="hd">
				{{ $car->sub($car->brand) }}<br/>
				<strong>{{ $car->sub($car->model) }}</strong> <br/>
				<span>year: {{ $car->year }}</span>
			</p>

			<div class="foot">
			
				<a href="/cars/{{$car->id}}" class="btn btn-info" target="_blank">More</a>

				@include('wishlists.wishListButton')

			</div>


			@if(@$update)
				<a href="/cars/{{ $car->id }}/edit" class="edit-btn pull-right">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
				</a>
			@endif

		</div>
	</div>

</div>