@extends('master')

@section('title', ' - Posts')

@section('content')

	<div class="posts">
		
		@foreach($posts as $post)
			<div class="blog-post">
			    <h2 class="blog-post-title">
			    	<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
			    </h2>

			    <p class="blog-post-meta">On {{ $post->created_at->toFormattedDateString() }} 
			    By <a href="/userPosts/{{ $post->user->name }} "> {{ $post->user->name }} </a></p>

			    <p>{{ $post->body }}</p>
			</div>
		@endforeach

	</div>
@endsection	