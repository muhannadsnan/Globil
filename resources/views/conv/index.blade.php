@extends('master')

@section ('title', " | Conversations")

@section ('content')

	<div class="col-sm-4 conversations">
		<input type="search" placeholder="Search conversations.." class="form-control">
		<hr>

		<conversations @conv-clicked="convClicked" ></conversations>

	</div>


	<div class="col-sm-7 conv_messages">

		<messages></messages>

	</div>

@endsection
	