@extends('master')


@section ("content")

	<div class="myCars panel panel-primary">
		
		<div class="panel-heading">
			Manage my cars
		</div>
		<!-- <hr> -->

		<div class="panel-body">
			@forelse(auth()->user()->cars as $car)
		
				@include('cars._card')

			@empty
				You have created no cars.
			@endforelse
		</div>
		
	</div>

@endsection
