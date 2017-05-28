@extends('master')


@section("content")

@if($flash = session('message'))

<div class="form-group">
	<a href="/cars/create" class="btn btn-success"> Create another post !</a>
</div>

@else

<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Publish a post:</h3>
	</div>

	<div class="panel-body">
		<form method="POST" action="/cars" enctype="multipart/form-data">

			{{ csrf_field() }}
			
			@include('layout.errors')
			@include('cars._form')

			<input type="submit" value="Publish" class="col-sm-6 col-sm-offset-3 btn btn-primary">
		</form>
	</div>

	<!-- <div class="panel-footer">
		<div class="col-md-6 col-md-offset-3 NO-float">
		</div>
	</div> -->
</div>

@endif
	
@endsection

@section ("scripts")

	<script type="text/javascript">
		$(document).ready(function(){
			// $('select').val(function(){
			// 	return $(this).data('old')
			// });
		});
	</script>

@endsection

@section ("css")

	<link rel="stylesheet" type="text/css" href="{{ asset('select2.min.css') }}">

@endsection
	