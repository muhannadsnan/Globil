@if (count($errors))
<div class="form-group text-left">
	<ul class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif