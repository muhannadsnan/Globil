<hr>

Thanks for registering in our great BLOG, <strong>{{ $user->name }}</strong> !!

<hr>

<h2>Here are some latest posts:</h2>

<ul class="form-control">
	@foreach($posts as $post)

		<li>
			<a href="homestead.app/posts/{{ $post->id }}" class="text-capitalize">{{ $post->title }}</a>
			By <a href="homestead.app/posts/{{ $post->user->name }}" class="text-capitalize">{{ $post->user->name }}</a>
			({{ $post->created_at->diffForHumans() }})
		</li>

	@endforeach
</ul>