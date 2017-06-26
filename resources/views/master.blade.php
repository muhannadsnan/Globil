<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	
	@include('layout.head')

<body>
	<div class="page text-center" id="app">
			

		@include('layout.nav')


		<div class="container">
			
			<div class="row">
				<?php 
				if(isset($isHomePage) && $isHomePage){
					$searchbar_col_width = "col-md-2 col-sm-4";
					$content_col_width = "col-md-8 col-sm-8";
				}else{
					$searchbar_col_width = "";
					$content_col_width = "col-md-10";
				}
				?>

				@if(isset($isHomePage) && $isHomePage)
				
					<div class="<?=$searchbar_col_width?>" id="searchbar">

						@include('layout.searchbar')

					</div><!-- .searchbar -->
				
				@endif
				

				<div class="<?=$content_col_width?>" id="content">

					@if(isset($isHomePage) && $isHomePage)
						<ads type="banner" items="1" refresh="15"></ads> <!-- BANNER ADS -->
					@endif
				
					@yield('content')

				</div><!-- .content -->


				<div class="col-md-2 col-sm-12" id="sidebar">

					@include('layout.sidebar')

				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->

	</div>
	
		@include('layout.footer')

</body>
</html>
