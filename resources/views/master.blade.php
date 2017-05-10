<!DOCTYPE html>
<html lang="en">
	
	@include('layout.head')

<body>
	<div class="page text-center">
			

		@include('layout.nav')


		<div class="container">
			
			<div class="row">
				<div class="col-md-8 content ">
				
					@yield('content')

				</div><!-- .blog-main -->

				<div class="col-md-3 sidebar">

					@include('layout.sidebar')

				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->


		@include('layout.footer')

	</div>
	
</body>
</html>
