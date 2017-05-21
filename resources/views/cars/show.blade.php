@extends('master')


@section('content')

	<!-- {{$car->brand}}

	{{$car->model}}

	{{$car->year}}

	{{$car->country}}

	${{$car->price}} 

	{{$car->user->name}}


	 -->

<div class="card">
	<div class="container-fliud">
		<div class="wrapper row">

			<div class="preview col-md-6">
				<div class="preview-pic tab-content">
					<?php $active = true ?>
					@foreach($car->pictures as $pic)
						
						<div class="tab-pane {{$active? 'active' : ''}}" id="pic-{{$pic->id}}">
							<img src="{{asset('storage/images').'/'.$pic->id.'.'.$pic->ext}}" />
						</div>
						{{ $active = false }}

					@endforeach
				</div>

				<ul class="preview-thumbnail nav nav-tabs">
					<?php $active = true ?>
					@foreach($car->pictures as $pic)
						
						<li class="portfolio-box {{$active? 'active' : ''}}">
							<a data-target="#pic-{{$pic->id}}" data-toggle="tab">
								<img src="{{asset('storage/images').'/'.$pic->id.'.'.$pic->ext}}" />
							</a>
						</li>
						{{ $active = false }}

					@endforeach						
				</ul>
			</div>

			<div class="details col-md-6">
				<h3 class="product-title">men's shoes fashion</h3>
				<div class="rating">
					<div class="stars">
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>
					</div>
					<span class="review-no">41 reviews</span>
				</div>
				<p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
				<h4 class="price">current price: <span>$180</span></h4>
				<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
				<h5 class="sizes">sizes:
					<span class="size" data-toggle="tooltip" title="small">s</span>
					<span class="size" data-toggle="tooltip" title="medium">m</span>
					<span class="size" data-toggle="tooltip" title="large">l</span>
					<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
				</h5>
				<h5 class="colors">colors:
					<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
					<span class="color green"></span>
					<span class="color blue"></span>
				</h5>
				<div class="action">
					<!-- <button class="add-to-cart btn btn-default" type="button">add to cart</button> -->
					@if( auth()->check() && auth()->id() != $car->user_id)

						@if( count($wish = App\WishList::userHasCarInWashList( ['car_id' => $car->id, 'user_id' => $car->user_id])) > 0 )
						
						<ajax method="delete" url="/wish-list" css="btn btn-danger btn-lg wish-list" data1="{{ $wish[0]->id }}" >
							Remove from wish list
						</ajax>
						
						@else				

						<ajax url="/wish-list" css="like btn btn-default wish-list" data1="{{ $car->id }}" data2="{{ $car->user_id }}">
							Add to wish list
						</ajax>						

						@endif


					@elseif( auth()->guest() )
					
					<a href="/login" class="like btn btn-default wish-list"><span class="fa fa-heart"></span> Add to wish list</a>

					@endif
					
				</div>
			</div>
		</div>
	</div>
</div>



<div class="mfp-bg mfp-img-mobile mfp-ready hide"></div>

	<div class="mfp-wrap mfp-gallery mfp-close-btn-in mfp-auto-cursor mfp-img-mobile mfp-ready hide" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;">
	<div class="mfp-container mfp-image-holder mfp-s-ready">
	<div class="mfp-content">
	<div class="mfp-figure">
	<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	<figure>
	<img class="mfp-img" alt="" src="" style="height:100vh;">
	<figcaption>
	<div class="mfp-bottom-bar">
	<div class="mfp-title"></div>
	<div class="mfp-counter">2 of 6</div>
	</div>
	</figcaption>
	</figure>
	</div>
	</div>
	<div class="mfp-preloader">Loading image #2...</div>
<!-- 	<button title="Previous (Left arrow key)" type="button" class="mfp-arrow mfp-arrow-left mfp-prevent-close">
	</button>
	<button title="Next (Right arrow key)" type="button" class="mfp-arrow mfp-arrow-right mfp-prevent-close">
	</button> -->
	</div>
	</div>

@endsection

@section ("css")

	<link rel="stylesheet" type="text/css" href="https://blackrockdigital.github.io/startbootstrap-creative/vendor/magnific-popup/magnific-popup.css">

	<style>
	img {
	  max-width: 100%; }

	.preview {
	  display: -webkit-box;
	  display: -webkit-flex;
	  display: -ms-flexbox;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	  -webkit-flex-direction: column;
			-ms-flex-direction: column;
				 flex-direction: column; }
	  @media screen and (max-width: 996px) {
		 .preview {
			margin-bottom: 20px; } }

	.preview-pic {
	  -webkit-box-flex: 1;
	  -webkit-flex-grow: 1;
			-ms-flex-positive: 1;
				 flex-grow: 1; }

	.preview-thumbnail.nav-tabs {
	  border: none;
	  margin-top: 15px; }
	  .preview-thumbnail.nav-tabs li {
		 width: 18%;
		 margin-right: 2.5%; }
		 .preview-thumbnail.nav-tabs li img {
			max-width: 100%;
			display: block; }
		 .preview-thumbnail.nav-tabs li a {
			padding: 0;
			margin: 0; }
		 .preview-thumbnail.nav-tabs li:last-of-type {
			margin-right: 0; }

	.tab-content {
	  overflow: hidden; }
	  .tab-content img {
		 width: 100%;
		 -webkit-animation-name: opacity;
					animation-name: opacity;
		 -webkit-animation-duration: .3s;
					animation-duration: .3s; }

	.card {
	  margin-top: 0px;
	  background: #eee;
	  padding: 3em;
	  line-height: 1.5em; }

	@media screen and (min-width: 997px) {
	  .wrapper {
		 display: -webkit-box;
		 display: -webkit-flex;
		 display: -ms-flexbox;
		 display: flex; } }

	.details {
	  display: -webkit-box;
	  display: -webkit-flex;
	  display: -ms-flexbox;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	  -webkit-flex-direction: column;
			-ms-flex-direction: column;
				 flex-direction: column; }

	.colors {
	  -webkit-box-flex: 1;
	  -webkit-flex-grow: 1;
			-ms-flex-positive: 1;
				 flex-grow: 1; }

	.product-title, .price, .sizes, .colors {
	  text-transform: UPPERCASE;
	  font-weight: bold; }

	.checked, .price span {
	  color: #ff9f1a; }

	.product-title, .rating, .product-description, .price, .vote, .sizes {
	  margin-bottom: 15px; }

	.product-title {
	  margin-top: 0; }

	.size {
	  margin-right: 10px; }
	  .size:first-of-type {
		 margin-left: 40px; }

	.color {
	  display: inline-block;
	  vertical-align: middle;
	  margin-right: 10px;
	  height: 2em;
	  width: 2em;
	  border-radius: 2px; }
	  .color:first-of-type {
		 margin-left: 20px; }

	.add-to-cart, .like {
	  background: #ff9f1a;
	  padding: 1.2em 1.5em;
	  border: none;
	  text-transform: UPPERCASE;
	  font-weight: bold;
	  color: #fff;
	  -webkit-transition: background .3s ease;
				 transition: background .3s ease; }
	  .add-to-cart:hover, .like:hover {
		 background: #b36800;
		 color: #fff; }

	.not-available {
	  text-align: center;
	  line-height: 2em; }
	  .not-available:before {
		 font-family: fontawesome;
		 content: "\f00d";
		 color: #fff; }

	.orange {
	  background: #ff9f1a; }

	.green {
	  background: #85ad00; }

	.blue {
	  background: #0076ad; }

	.tooltip-inner {
	  padding: 1.3em; }

	@-webkit-keyframes opacity {
	  0% {
		 opacity: 0;
		 -webkit-transform: scale(3);
					transform: scale(3); }
	  100% {
		 opacity: 1;
		 -webkit-transform: scale(1);
					transform: scale(1); } }

	@keyframes opacity {
	  0% {
		 opacity: 0;
		 -webkit-transform: scale(3);
					transform: scale(3); }
	  100% {
		 opacity: 1;
		 -webkit-transform: scale(1);
					transform: scale(1); } }
	.preview-thumbnail .active {border: 1px solid red;}
	</style>

@endsection


@section ("scripts")

	<script>
	$('.preview-pic img').on('click', function(e){
		$('.mfp-wrap, .mfp-bg').removeClass('hide');
		var src = $('.preview-pic .active img').attr('src'); console.log(src);
		$('.mfp-img').attr('src', src);

	});

	$('.mfp-close, .mfp-container').on('click', function(){
		$('.mfp-wrap, .mfp-bg').addClass('hide');
	});
	</script>	



@endsection


