@section ("this_wishlist")

	@if( auth()->check() && auth()->id() != $car->user_id)
		@if( auth()->user()->wishList->contains('car_id', $car->id) )
			@foreach(auth()->user()->wishList as $wish)
				@if($wish->car_id == $car->id)				
				<wishlistbutton act="remove" data1="{{$car->id}}" data2="{{auth()->id()}}" data3="{{$wish->id}}"></wishlistbutton>
				@endif			
			@endforeach
		@else 
				<wishlistbutton act="add" data1="{{$car->id}}" data2="{{auth()->id()}}"></wishlistbutton>			
		@endif
	@elseif( auth()->guest() )					
		<a href="/login" class="like btn btn-default wish-list"><span class="fa fa-heart"></span> Add to wish list</a>
	@endif

@endsection
	

<div class="card-in-vue  car-card col-xs-6 col-sm-4 col-md-3" >
	<div class="panel panel-info">

		<img src="{{asset('storage/images').'/'.$car->pictures[0]->id.'.'.$car->pictures[0]->ext}}" alt="{{$car->brand .' - '. $car->model}}">

		<div class="caption">

			<div class="hd">
				<strong>{{ $car->brandSubdata() }}</strong> 
				<p>{{ $car->modelSubdata() }}</p>
				<small>year: {{ $car->year }}</small> 
				<label> {{ $car->price }} ,- </label>
				<p>{{ $car->area .', '. $car->city }}</p>
			</div>

			<div class="foot">
			
				<a href="/cars/{{$car->id}}" class="btn btn-info" target="_blank">Show</a>
				
				@yield('this_wishlist')

			</div>
		</div>
	</div>

</div>