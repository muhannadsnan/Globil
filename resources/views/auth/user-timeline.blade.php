@extends('master')

@section ("title", "$user->name Timeline")


@section ("content")

<div class="user-timeline">
	
	<div class="user-profile row">
		<div class=" col-md-8 col-md-offset-2">
			<div class="blk col-sm-6 col-md-4">
				<img src="{{asset('storage/images/user/1.png')}}">
			</div>
			<div class="blk-right col-sm-6 col-md-4 ">
				<strong>{{$user->name}}</strong>
				<button class="btn btn-success pull-right">Message</button>
			</div>
		</div>
	</div>

	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#about">About</a></li>
		<li><a data-toggle="tab" href="#cars">Cars</a></li>
	</ul>

	<div class="tab-content">
		<div id="about" class="tab-pane col-md-10 col-md-offset-1 fade in active">
			<div class="line">
				<label>Fullname: </label>
				<strong>{{$user->fname}} {{$user->lname}} {{$user->type == 'C' ? ' (Business)' : ''}}</strong>				
			</div>
			<div class="line">
				<label>Phone: </label>
				<strong>{{$user->phone}}</strong>				
			</div>
			<div class="line">
				<label>email: </label>
				<strong>{{$user->email}}</strong>				
			</div>
			<div class="line">
				<label>Address: </label>
				<strong>{{$user->city}}, {{$user->zip}} {{$user->country}}</strong>				
			</div>
		</div>
		<div id="cars" class="tab-pane fade">
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

