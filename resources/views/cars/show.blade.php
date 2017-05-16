@extends('master')

@section('content')

	<a href="/userPosts/{{ $post->user->name }}"> {{ $post->user->name }} </a>
	Created at: {{ $post->created_at }}
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->body }}</p>

	<hr>
	
	<h3> Comments: </h3>
	<div class="well comments">
		@if(count($post->comments))
			<ul class="list-group form-group">

				@foreach($post->comments as $comment)
					<li class="list-group-item">
						<strong>{{ $comment->user->name }}: </strong> {{ $comment->body }} &nbsp;
						<span class="label label-default">({{ $comment->created_at->diffForHumans() }})</span>
					</li>
				@endforeach
			
			</ul>

		@else
			<div class="form-group">
				No comments yet.
			</div>
		@endif

		<form method="POST" action="/comments/{{ $post->id }}">
		{{ csrf_field() }}

			<div class="form-group">
				<textarea name="body" class="form-control" placeholder="Add your comment.." required></textarea>
			</div>

			<div class="form-group">
				<input type="submit" value="Publish" class="btn btn-primary">
			</div>

			<div class="errors form-group">
				@include('layout.errors')
			</div>
		</form>

	</div> <!-- end .wel -->

	

@endsection