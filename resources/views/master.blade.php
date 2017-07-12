<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	
	@include('layout.head')

<body>
	<div class="page text-center" id="app">
			

		@include('layout.nav')


		<div class="row">
			
			<div class="container-fluid">
				<?php 
				if(@$isHomePage || @$isPostShow){
					$searchbar_col_width = "col-md-2 col-sm-3";
					$content_col_width = "col-md-8 col-sm-7";
					$sidebar_col_width = "col-md-2 col-sm-2";
				}else{
					$searchbar_col_width = "";
					$content_col_width = "col-md-8 col-md-offset-2";
					$sidebar_col_width = "";
				}
				?>

				@if(@$isHomePage)
				
					<div class="{{$searchbar_col_width}}" id="searchbar">

						@include('layout.searchbar')

					</div><!-- .searchbar -->
				
				@endif
				

				<div class="{{$content_col_width}}" id="content">

					@if(@$isHomePage)
						<!-- <ads type="banner" items="1" refresh="15"></ads> -->
					@endif
				
					@yield('content')

				</div><!-- .content -->


				<div class="{{$sidebar_col_width}}" id="sidebar">

					@if(@$isHomePage)
						@include('layout.sidebar')
					@endif

				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->

	</div>
	
		@include('layout.footer')

</body>
</html>
