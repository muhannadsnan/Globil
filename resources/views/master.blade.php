<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	
	@include('layout.head')

<body>
	<div class="page text-center" id="app">
			

		@include('layout.nav')


		<div class="container">
			
			<div class="row">
				<div class="col-md-9 content ">
				
					@yield('content')

				</div><!-- .blog-main -->

				<div class="col-md-3 sidebar">

					@include('layout.sidebar')

				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->

	</div>
	
		@include('layout.footer')

</body>
</html>
