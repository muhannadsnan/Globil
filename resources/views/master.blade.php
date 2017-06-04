<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	
	@include('layout.head')

<body>
	<div class="page text-center" id="app">
			

		@include('layout.nav')


		<div class="container">
			
			<div class="row">
				<div class="col-md-2" id="searchbar">

					@include('layout.searchbar')

				</div><!-- .searchbar -->


				<div class="col-md-8" id="content">
				
					@yield('content')

				</div><!-- .content -->


				<div class="col-md-2" id="sidebar">

					@include('layout.sidebar')

				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->

	</div>
	
		@include('layout.footer')

</body>
</html>
