@extends('master')

@section ("title", " - My saved searches")


@section ("content")

<div class="my-saved-searches">
	<h3>My saved searches</h3>
	<hr>
	@if(@$savedSearches)
	
		@forelse($savedSearches as $sSearch)
			
			<form method="post" action="/saved-search/{{$sSearch->id}}">
				{{ method_field('delete') }}
				{{ csrf_field() }}

				<div class="panel panel-primary">
					<div class="panel-heading">
						{{$sSearch->title}}
						<span class="btns">
							<a href="/saved-search/{{$sSearch->id}}" class="btn btn-info" TARGET="_BLANK">Show</a>
							<input type="submit" class="btn btn-danger" value="Delete">
						</span>
					</div>
					<div class="panel-body">
						{{ $sSearch->getSummerize($sSearch) }}
					</div>
				</div>
			</form>

		@empty
			<label>You don't have any saved search.</label>
		@endforelse
					
	
	@endif
</div>
	
@endsection


@section ("css")

@endsection

