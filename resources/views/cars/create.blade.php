@extends('master')


@section("content")

@if($flash = session('message'))

<a href="/cars/create" class="btn btn-success"> Create another post !</a>

@else

<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Publish a post:</h3>
	</div>

	<div class="panel-body">
		<form method="POST" action="/cars">

			{{ csrf_field() }}
			
			@include('layout.errors')
			@include('cars._post')

	</div>

	<div class="panel-footer">
		<div class="col-md-6 col-md-offset-3 NO-float">
			<input type="submit" value="Publish" class="col-md-12 btn btn-primary NO-float">
			</form>
		</div>
	</div>
</div>

@endif
	
@endsection