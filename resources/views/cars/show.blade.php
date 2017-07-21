@extends('master')

@section ("title", " | {$car->brandSubdata()} {$car->modelSubdata()}")

@section ("scripts")
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
	<script type="text/javascript">
		var map = null; // MAP FROM BING V7
		var credentials = "AkPkv0jxRL4GMO7fEBnjRiOaURk1aPKWnxAErI5aSuopapNXw7ZvY6TbTevdDO8r";
		GetMap();
		function GetMap() { //
			// Define the address on which to centre the map
			var addressLine = ""; // "54 Chiswell Street" - Street Address
			var locality = "<?php echo $car->citySubdata(); ?>"; // City or town name
			var adminDistrict = "<?php echo $car->areaSubdata(); ?>"; // County
			var country = ""; // "UK" Country, obviously
			var postalCode = "" //Postcode
			// Construct a request to the REST geocode service
			var geocodeRequest = "http://dev.virtualearth.net/REST/v1/Locations" 
			                     + "?countryRegion=" + country
			                     + "&addressLine=" + addressLine
			                     + "&locality=" + locality
			                     + "&adminDistrict=" + adminDistrict
			                     + "&postalCode=" + postalCode
			                     + "&key=" + credentials
			                     + "&jsonp=GeocodeCallback"; // This function will be called after the geocode service returns its results
			CallRestService(geocodeRequest);// Call the service
		}
		function GeocodeCallback(result) { // Check that we have a valid response
			if (result && result.resourceSets && result.resourceSets.length > 0 && result.resourceSets[0].resources && result.resourceSets[0].resources.length > 0) {
			  var coords = result.resourceSets[0].resources[0].point.coordinates;
			  centerPoint = new Microsoft.Maps.Location(coords[0], coords[1]);
			  map = new Microsoft.Maps.Map(document.getElementById("mapDiv"),
			                     { credentials: credentials, center: centerPoint,
			                       mapTypeId: Microsoft.Maps.MapTypeId.aerial,
			                       zoom: 12
			                     });
			  var pushpin = new Microsoft.Maps.Pushpin(map.getCenter()); // Add a pushpin as well
			  map.entities.push(pushpin);
			}
		}
		// A generic function to call a REST service & insert JSON results into the head of the document
		function CallRestService(request) {
			var script = document.createElement("script");
			script.setAttribute("type", "text/javascript");
			script.setAttribute("src", request);
			var dochead = document.getElementsByTagName("head").item(0);
			dochead.appendChild(script);
		}      
  </script>
@endsection


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
				<br>
				<!-- ATTRIBS -->
				<div class="col-sm-4 text-left">
					<span>Current price: </span> <label>{{$car->price}} ,- </label> <br>
					<span>Kilometer: </span> <label>{{$car->km}}</label> <br>
					<span>Fuel:</span> <label>{{$car->fuelSubdata()}}</label> <br>
					<span>Registration nr: </span> <label>{{$car->reg_nr}}</label> <br>
					<small>{{$car->created_at->diffForHumans()}}</small> <br>
					<span>Location: </span> <label>{{$car->areaSubdata()?$car->areaSubdata():'No area'}}, {{$car->citySubdata()?$car->citySubdata():'No city'}}</label> <br>
				</div>


				<!-- USER PROFILE  -->
				<div class="user-profile col-sm-2 pull-left">
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

				<!-- MAP -->
				<div class="map col-sm-5 pull-right" id='mapDiv' ></div>

			</div> <!-- END details -->

			<!-- DESCRIPTION -->
				<div class="panel panel-primary col-sm-12">
					<div class="container-fluid">
						<h4>DESCRIPTION</h4>
						<div class="text-left">
							{{$car->desc}}       
						</div>
					</div>
				</div>
		</div> <!-- END containerX -->
	</div> <!-- END rowX -->


</div> <!-------- END card -------->

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


