@extends('master')


@section ("content")

	<div class="myCars panel panel-primary">
		
		<div class="panel-heading">
			<h3>Manage my cars</h3>
		</div>

		<div class="panel-body">
			@forelse(auth()->user()->cars as $car)
		
				@include('cars._card')

			@empty
				You have created no cars.
			@endforelse
		</div>
		
	</div>

@endsection
