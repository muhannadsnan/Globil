

<div  v-for="car in searchResult"  class="card-in-vue car-card col-xs-6 col-sm-4 col-md-3"  v-cloak>
	<div class="panel panel-info">

		<img :src="car.pic_file_name" alt="car.brand +' - '+ car.model">

		<div class="caption">

			<div class="hd">
				<strong>@{{ car.brand }}</strong> 
				<p>@{{ car.model }}</p>
				<small>year: @{{ car.year }}</small> 
				<label> @{{ car.price }} ,- </label>
			</div>
			
			<div class="foot">
			
				<a :href="'/cars/'+car.id" class="btn btn-info" target="_blank">Show</a>
				
				<wishlistbutton :data1="car.id" data2="{{auth()->id()}}"></wishlistbutton>			

			</div>
		</div>
	</div>

</div>
