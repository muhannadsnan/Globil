@extends('master')


@section('content')

<div class="card">
	<div class="rowX">
		<div class="containerX"> 

			<!-- SLIDER >> -->

		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">

		      @foreach($car->pictures as $key => $pic)
		      	<li data-target="#myCarousel" data-slide-to="{{$key}}"  class="active"></li>
		      @endforeach

		    </ol>

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner">
		    <?php $active = true; ?>
		    @foreach($car->pictures as $key => $pic)
		    
		    	<div class="item {{$active ? 'active' : ''}}">
		        <img src="{{asset('storage/images'.'/'.$pic->id.'.'.$pic->ext)}}" alt="Los Angeles" style="width:100%;">
		        <div class="carousel-caption">
		          <p>{{count($car->pictures)}}/{{$key+1}}</p>
		        </div>
		      </div>
		    	<?php $active = false; ?>
		    @endforeach      

		    </div>

		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right"></span>
		      <span class="sr-only">Next</span>
		    </a>
		  </div>

			<!-- END SLIDER << -->

			<div class="details col-sm-12">
				<h3> 
					<div class="action">
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
					</div>

					{{$car->brandSubdata()}} - {{$car->modelSubdata()}} ({{$car->year}})
				</h3>

				<!-- USER PROFILE  -->
				<div class="user-profile col-sm-2 pull-right">
					<div class="blk">
						<a href="/users/{{$car->user->id}}">
							<img src="{{asset('storage/images/user/1.png')}}">
							<span>{{$car->user->name}}</span>
						</a>
					</div>

					@if(auth()->check())					
						<button @click="showModal=true; " class="btn btn-success">Message</button>
					@else	
						<a href="/login" class="btn btn-success">Message</a>
					@endif
				</div> <!-- END USER PROFILE -->
				

				<h4 class="price">current price: <span>{{$car->price}} ,- </span></h4>
				<h4 class="price">kilometer: <span>{{$car->km}}</span></h4>
				<h4 class="price">fuel: 
					<span>
						{{$car->fuelSubdata()}}
					</span>
					</h4>
				<h4 class="price">registration nr: <span>{{$car->reg_nr}}</span></h4>
				<h4 class="price"><small>{{$car->created_at->diffForHumans()}}</small></small>

			</div>
		</div>
	</div>


	<div class="panel panel-defualt ">
		<div class="panel-heading">

			<h4>DESCRIPTION</h4>
			<div class="panelbodyX text-left">
				{{$car->desc}}			
			</div>

		</div>
	</div>
</div>

<form action="/messages/toUser" method="post">
	<modal title="Send message to {{$car->user->name}}" v-show="showModal" @clk-close-modal="showModal=false; message = ''; ">
		{{ csrf_field() }}
		<input type="hidden" name="toUser" value="{{$car->user->id}}">

		<div class="form-group">
			<textarea v-model="message" name="msg" rows="5" placeholder="Message text.." class="form-control"></textarea>
		</div>

		<template slot="buttons">
			<input type="submit" value="Send" v-show="message.length > 0" class="btn btn-primary">
			<input type="submit" value="Send" v-show="message.length == 0" class="btn btn-primary" disabled="disabled">
		</template>
	</modal>
</form>

@endsection


@section ("css")
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection


@section ("scripts")
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection


