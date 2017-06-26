@if( auth()->check() )


	@if($car->user_id != auth()->id())

		@if( auth()->user()->wishList->contains('car_id', $car->id) )
			@foreach(auth()->user()->wishList as $wish)

				@if($wish->car_id == $car->id)
				
				<wishlistbutton act="remove" data1="{{$car->id}}" data2="{{auth()->id()}}" data3="{{$wish->id}}"></wishlistbutton>

				@endif
			
			@endforeach

		@else
			<wishlistbutton act="add" data1="{{$car->id}}" data2="{{auth()->id()}}"></wishlistbutton>			
		@endif

	@endif
	

@else
<div class="WishListButton">
	<a href="/login" class="">
		<span class="fa" data-toggle="tooltip" data-placement="top"
				data-original-title="title">
			<i class="fa fa-heart-o"></i>
		</span>
	</a>
</div>
@endif