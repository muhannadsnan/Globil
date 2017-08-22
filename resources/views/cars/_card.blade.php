
<div class="card-in-vue car-card col-xs-6 col-sm-4 col-md-3" >
	<div class="panel panel-info">

		@if(@$myCarsPage)
					
			<div class="tool-btns">
				<button href="/cars/{{$car->id}}" @click="showModal = true" class="btn btn-danger" target="_blank">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</button>
			
				<a href="/cars/{{$car->id}}/edit" class="btn btn-success" TARGET="_BLANK">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
			</div>
		
		@endif

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
			
				<a href="/cars/{{$car->id}}" class="btn btn-info btn1" target="_blank">
					<i class="fa fa-hand-o-right" aria-hidden="true"></i>
				</a>
				
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


		<form action="/cars/{{ $car->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('delete') }}

			<modal title="Delete car confirmation" v-show="showModal" v-cloak
						@clk-close-modal="showModal=false">
				<strong class="alert-danger">Are you sure you want to delete the car 
							{{$car->brandSubdata() .' '. $car->modelSubdata()}}?</strong>

				<template slot="buttons">
					<div class="width-100">
						<button type="submit" href="/cars/{{$car->id}}" class="btn btn-danger btn1" target="_blank">
							<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
						</button>

						<button  @click.prevent="showModal = false" class="btn btn-info btn2">Cancel</button> 						
					</div>
				</template>

			</modal>
		</form>

</div>
