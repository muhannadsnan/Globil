
<div class="card-in-vue car-card col-xs-6 col-sm-4 col-md-3" >
	<div class="panel panel-info">

		<img src="{{ @$car->pictures[0] ? asset('storage/images').'/'.$car->pictures[0]->id.'.'.$car->pictures[0]->ext 
						: asset('storage/images').'/no-image.png' }}" alt="{{$car->brand .' - '. $car->model}}">

		<div class="caption">

			<div class="hd">
				<strong>{{ $car->brandSubdata() }}</strong> 
				<p>{{ $car->modelSubdata() }}</p>
				<small>year: {{ $car->year }}</small> <br>
				<label> {{ $car->price }} ,- </label>
				<p>{{ $car->areaSubdata() .', '. $car->citySubdata() }}</p>
			</div>

			<div class="foot">
			
				<a href="/cars/{{$car->id}}" class="btn btn-info" target="_blank">Show</a>
				
					@if( auth()->check() && auth()->id() != $car->user_id)
		@if( @$wish = auth()->user()->wishList->where('car_id', $car->id)->first() )
			<wishlistbutton act="remove" data1="{{$car->id}}" data2="{{auth()->id()}}" data3="{{$wish->id}}"></wishlistbutton>
		@else 
			<wishlistbutton act="add" data1="{{$car->id}}" data2="{{auth()->id()}}"></wishlistbutton>			
		@endif
	@elseif( auth()->guest() )					
		<a href="/login" class="like btn btn-default wish-list"><span class="fa fa-heart"></span> Add to wish list</a>
	@endif

			</div>
		</div>
	</div>

</div>