@extends('master')


@section('content')

	{{$car->brand}}

	{{$car->model}}

	{{$car->year}}

	{{$car->country}}

	${{$car->price}} 

	{{$car->user->name}}


	@foreach($car->pictures as $pic)
	
		<img src="{{asset('storage/images').'/'.$pic->id.'.'.$pic->ext}}" class="thumbnail col-md-2" />
	
	@endforeach
		

@endsection