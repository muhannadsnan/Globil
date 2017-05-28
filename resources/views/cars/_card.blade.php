<div class="col-sm-6 col-md-4 car-card">

	<div class="thumbnail panel-info">

		<img src="{{ asset('storage/images') .'/'. $car->pictures[0]->id .'.'. $car->pictures[0]->ext }}" alt="...">

		<div class="caption">

			@include('wishlists.wishListButton')

			<span class="hd">{{ $car->sub($car->brand) }}, 
				<strong>{{ $car->sub($car->model) }}</strong> <br/>
				<small>year: {{ $car->year }}</small>
			</span>
			
			<p class="desc">
				{{ substr($car->desc, 0, 100) }} {{ strlen($car->desc) > 100 ? '...' : '' }}
			</p>

			<a href="/cars/{{$car->id}}" class="btn btn-info" role="button">See more</a>

			@if(@$update)
				<a href="/cars/{{ $car->id }}/edit" class="edit-btn pull-right">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
				</a>
			@endif

		</div>
	</div>

</div>