@extends('master')


@section("content")

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3>Edit Car:</h3>
		</div>

		<div class="panel-body">
			<form method="POST" action="/cars/{{$car->id}}" enctype="multipart/form-data">

				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				
				@include('layout.errors')
				@include('cars._form')

				@if(@$update)

					<div class="row">
						<edit-images carid="{{$car->id}}" path="{{asset('storage/images')}}"></edit-images>
					</div>

				@endif

				<input type="submit" value="Update" class="col-sm-6 col-sm-offset-3 btn btn-primary">
			</form>
		</div>
	</div>

@endsection

@section ("scripts")

	<script type="text/javascript">
		$(document).ready(function(){
			// $('select').val(function(){
			// 	return $(this).data('old')
			// });

			//updateRangeLabel();
		});	
	</script>

@endsection
	