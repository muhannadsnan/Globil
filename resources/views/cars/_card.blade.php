<div class="car-card col-xs-6 col-sm-4 col-md-3 ">

	<div class="thumbnail panel-info">

		<img src="{{ asset('storage/images') .'/'. @$car->pictures[0]->id .'.'. @$car->pictures[0]->ext }}" alt="...">

		<div class="caption">			

			<p class="hd">
				<strong>{{ $car->sub($car->brand) }}</strong>
				<p>{{ $car->sub($car->model) }}</p>
				<small>year: {{ $car->year }}</p>
			</p>

			<div class="foot">
			
				<a href="/cars/{{$car->id}}" class="btn btn-info" target="_blank">Show</a>

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