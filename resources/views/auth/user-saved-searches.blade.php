@extends('master')

@section ("title", " - My saved searches")


@section ("content")

<div class="my-saved-searches">
	@if(@$savedSearches)
	
		@foreach($savedSearches as $sSearch)
			
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
		@endforeach
					
	
	@endif
</div>
	
@endsection


@section ("css")

@endsection

