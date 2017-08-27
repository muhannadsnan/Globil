@extends('master')


@section ("content")

	<div class="my-wish-list panel panel-primary">
		<div class="panel-heading">
			My Wish List
		</div>

		<div class="panel-body">

			@if(count(auth()->user()->wishList))
			
				@foreach(auth()->user()->wishList->reverse() as $wish)
					
					<div class="blk panel col-xs-12 ">
						<div class="col-xs-8">
							<a href="/cars/{{$wish->car->id}}" class="hd">
								{{ $wish->car->brandSubdata() }}, 
								{{ $wish->car->modelSubdata() }},
								{{ $wish->car->year }}
							</a>

							<div>
								<p class="price">{{ $wish->car->price . ' NOK' }}</p> 
								<span class="kilometer text-right">{{ $wish->car->kilometer . ' Kilometer' }}</span>
							</div>

							<small>
								Posted By <a href="#"> <strong>{{ $wish->car->user->name }}</strong> </a>
								{{ $wish->car->created_at->diffForHumans() }}
							</small>

<!-- 							<div class="caption">
								{{ substr($wish->car->desc, 0, 50) }}.. <br/>
							</div> -->
						</div>

						<div class="thumbnailZ text-rightz col-xs-3Z">
							<?php
							$pic0_id = @count($wish->car->pictures[0]->id) ? $wish->car->pictures[0]->id : 'no-image';
							$pic0_ext = @count($wish->car->pictures[0]->id) ? $wish->car->pictures[0]->ext : 'png';
							?>
							<img class="thumbnail" src="{{ asset('storage/images'.'/'. $pic0_id .'.'. $pic0_ext) }}" />
						</div>		
					</div>
					
				@endforeach

			@else
				<label>No cars in wish list.</label>
			@endif
							
		</div>	
	</div>

@endsection
