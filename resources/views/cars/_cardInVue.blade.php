

<div class="col-sm-6 col-md-4 car-card"  v-for="car in searchResult">
	<div class="thumbnail panel-info">

		<img :src="car.pic_file_name" alt="...">

		<div class="caption">

			<span class="hd">@{{ car.brand }}, 
				<strong>@{{ car.model }}</strong> <br/>
				<small>year: @{{ car.year }}</small>
			</span>
			
			<a href="/cars/car.id" class="btn btn-info" role="button">Explore</a>

		</div>
	</div>

</div>
