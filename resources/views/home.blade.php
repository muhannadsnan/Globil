@extends('master')

@section('content')

<div class="container">
	<div class=" row">


		<div class="latest-posts col-md-8">
			
			<h3 class="hd-primary">Latest Posts</h3>

			@foreach($latestCars as $car)
			
			<div class="col-sm-6 col-md-4 car">
				<div class="thumbnail panel-info">
					<img src="https://cdn.gearpatrol.com/wp-content/uploads/2016/12/German-Car-Guide-Gear-Patrol-LEad-Featured.jpg" alt="...">
					<div class="caption">
						<h4>{{$car->brand}} - ( {{$car->model}} ) <small>year: {{$car->year}}</small></h4>
						
						<p class="desc">Description goes here.. Description goes here..Description goes here..</p>
						<a href="#" class="btn btn-default" role="button">See more</a>
					</div>
				</div>
			</div>
			
			@endforeach
				

			<div class="col-xs-12 form-group">
				<button class="btn btn-info btn-lg">Load more</button>
			</div>

		</div>



	</div>

</div>
@endsection
