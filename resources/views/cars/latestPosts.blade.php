<div class="col-sm-6 col-md-4 car">

	<div class="thumbnail panel-info">
		<img src="{{ asset('storage/images') .'/'. $car->pictures[0]->id .'.'. $car->pictures[0]->ext }}" alt="...">
		<div class="caption">

			<h4>{{$car->brand}}, 
				<strong>{{$car->model}}</strong> <br/>
				<small>year: {{$car->year}}</small>
			</h4>
			
			<p class="desc">
				{{ substr($car->desc, 0, 100) }} {{ strlen($car->desc) > 100 ? '...' : '' }}
				
			</p>

			<a href="/cars/{{$car->id}}" class="btn btn-default" role="button">See more</a>
		</div>
	</div>

</div>