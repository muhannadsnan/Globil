@extends('master')

@section('content')
<!-- .well -->
<div class="well">
	<h1 class="text-info">Welcome to Globil!</h1> 
	<h3>Let's find something great.</h3>
	<h4>Search in oursite. You can find thousands of results.</h4>
	
	<div class="panel panel-default col-md-6 col-md-offset-3">
		<form action="/search" method="POST">
			<div class="input-group form-group  panel-header">

				<span class="input-group-btn">
					<a href="#" class="expand-advanced-search btn btn-default">More filters</a>
				</span>
				<input type="text" class="form-control" placeholder="Search">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-success">Find</button>
				</span>
			</div>

			<div class="advanced-filtering panel-body " style="display:none;">
				<h1>Here goes advanced filtering..</h1>
			</div>

		</form>
	</div>
			
</div><!-- END.well -->


<div class="container">
	 <div class=" row">


			<div class="latest-posts col-md-8">
				 
				 <h3 class="hd-primary">Latest Posts</h3>

						@foreach($latestCars as $car)
						
							 @include('cars._card')
						
						@endforeach
						
				 <div class="col-xs-12 form-group">
						<button class="btn btn-info btn-lg">Load more</button>
				 </div>

			</div>



	 </div>

</div>
@endsection
