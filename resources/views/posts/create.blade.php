@extends('master')


@section('content')
	<h1>Publish a post:</h1>
	<hr>

	<form method="POST" action="/posts">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" name="title" class="form-control" 2required>
		</div>

		<div class="form-group">
			<label for="body">Body:</label>
			<textarea name="body" class="form-control" 2required></textarea>
		</div>

		<div class="form-group">
			<input type="submit" value="Publish" class="form-control btn btn-primary">
		</div>

		@include('layout.errors')

	</form>
@endsection