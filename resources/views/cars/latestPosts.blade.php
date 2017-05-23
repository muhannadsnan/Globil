<div class="col-sm-6 col-md-4 car">

	<div class="thumbnail panel-info">
		<img src="{{ asset('storage/images') .'/'. $car->pictures[0]->id .'.'. $car->pictures[0]->ext }}" alt="...">
		<div class="caption">

			@if(auth()->check())
			
				@if( auth()->user()->wishList->contains('car_id', $car->id) )
					@foreach(auth()->user()->wishList as $wish)

						@if($wish->car_id == $car->id)
						
						<wishlistbutton act="remove" data1="{{$car->id}}" data2="{{auth()->id()}}" data3="{{$wish->id}}"></wishlistbutton>

						@endif
					
					@endforeach

				@else
						<wishlistbutton act="add" data1="{{$car->id}}" data2="{{auth()->id()}}"></wishlistbutton>			
				@endif

			@else

			<a href="/login" class="">
				<span class="fa" data-toggle="tooltip" data-placement="top"
						data-original-title="title">
					<i class="fa fa-heart-o"></i>
				</span>
			</a>
			
			@endif

			<span class="hd">{{$car->brand}}, 
				<strong>{{$car->model}}</strong> <br/>
				<small>year: {{$car->year}}</small>
			</span>
			
			<p class="desc">
				{{ substr($car->desc, 0, 100) }} {{ strlen($car->desc) > 100 ? '...' : '' }}
				
			</p>

			<a href="/cars/{{$car->id}}" class="btn btn-default" role="button">See more</a>
		</div>
	</div>

</div>