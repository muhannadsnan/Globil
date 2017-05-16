@extends('master')


@section("content")

<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Publish a post:</h3>
	</div>

	<div class="panel-body">
		<form method="POST" action="/posts">
			{{ csrf_field() }}
			
			@include('post')

			@include('layout.errors')

		</form>
	</div>

	<div class="footer">
		<div class="form-group">
			<input type="submit" value="Publish" class="form-control btn btn-primary">
		</div>
	</div>
</div>
	
@endsection