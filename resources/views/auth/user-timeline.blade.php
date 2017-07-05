@extends('master')

@section ("title", "$user->name Timeline")


@section ("content")

<div class="user-timeline">
	
	<ul class="nav nav-tabs">
		<li><a data-toggle="tab" href="#about">About</a></li>
		<li class="active"><a data-toggle="tab" href="#cars">Cars</a></li>
	</ul>

	<div class="tab-content">
		<div id="about" class="tab-pane fade">
			<h3>ABOUT</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		</div>
		<div id="cars" class="tab-pane fade in active">
			<div class="posts">
				
				@foreach($user->cars as $car)
				
					@include('cars._card')
				
				@endforeach
					
			</div>
		</div>
	</div>
</div>
@endsection


@section ("css")

<style>
	.tab-content{margin: 10px 0px;}	
</style>

@endsection

