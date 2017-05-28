@extends('master')


@section("content")

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3>Publish a post:</h3>
		</div>

		<div class="panel-body">
			<form method="PATCH" action="/cars" enctype="multipart/form-data">

				{{ csrf_field() }}
				
				@include('layout.errors')
				@include('cars._form')

				<input type="submit" value="Update" class="col-sm-6 col-sm-offset-3 btn btn-primary">
			</form>
		</div>
	</div>

@endsection

@section ("scripts")

	<script type="text/javascript">
		$(document).ready(function(){
			$('select').val(function(){
				return $(this).data('old')
			});
		});
	</script>

@endsection
	