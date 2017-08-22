@extends('master')


@section ("content")

	<div class="myCars">
		
		<h4><label>Manage my cars</label></h4>
		<hr>

		<div class="body">
			@forelse(auth()->user()->cars as $car)
		
				@include('cars._card')

			@empty
				You have created no cars.
			@endforelse
		</div>
		
	</div>

@endsection
