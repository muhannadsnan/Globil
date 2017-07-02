

<div class="col-xs-6 col-sm-4 col-md-3  car-card"  v-for="car in searchResult"  v-cloak>
	<div class="thumbnail panel-info">

		<img :src="car.pic_file_name" alt="...">

		<div class="caption">

			<span class="hd">@{{ car.brand }}, 
				<strong>@{{ car.model }}</strong> <br/>
				<small>year: @{{ car.year }}</small> <br>
				<strong> @{{ car.price }} ,- </strong>
			</span>
			
			<a href="/cars/car.id" class="btn btn-info" role="button">Explore</a>

		</div>
	</div>

</div>
