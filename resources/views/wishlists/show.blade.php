@extends('master')


@section ("content")

	<div class="panel panel-default">
		<div class="panel-heading">
			My Wish List
		</div>

		<div class="panel-body">

			@if(count(auth()->user()->wishList))
			
				@foreach(auth()->user()->wishList->reverse() as $wish)
					
					<div class="wish-list-post  col-xs-12">
						<div class="col-xs-9">
							<a href="/cars/{{$wish->car->id}}" class="">
							<div class="hd">
								{{ $wish->car->brand }}, 
								{{ $wish->car->model }},
								{{ $wish->car->year }}
							</div>
						</a> 
								
						<span class="price text-left">{{ $wish->car->price . ' NOK' }}</span>
						<span class="kilometer text-right">{{ $wish->car->kilometer }}</span>

						<p>
							Posted By
							<a href="#">
								<strong>{{ $wish->user->name }}</strong>
							</a>
							 {{ $wish->car->created_at->diffForHumans() }}
						</p>

						<div class="caption">
							{{ substr($wish->car->desc, 0, 50) }}.. <br/>
						</div>
						</div>

						<div class="thumbnail text-right col-xs-3">
							<img src="{{ asset('storage/images'.'/'. $wish->car->pictures[0]->id .'.'. $wish->car->pictures[0]->ext) }}" />
						</div>
					</div>
					<hr>
					
					@endforeach

			@else
				<label>No cars in wish list.</label>
			@endif
							
		</div>	
	</div>

@endsection
