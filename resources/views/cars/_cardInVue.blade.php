
<div  v-for="car in searchResult"  class="card-in-vue car-card col-xs-6 col-sm-4 col-md-3" >
	<div class="panel panel-info">

		<img :src="car.pic_file_name" alt="car.brand +' - '+ car.model">

		<div class="caption">

			<div class="hd">
				<strong>@{{ car.brand }}</strong> 
				<p>@{{ car.model }}</p>
				<small>year: @{{ car.year }}</small> <br>
				<label> @{{ car.price }} ,- </label>
				<p><small>@{{ car.area +', '+ car.city }}</small></p>
			</div>
			
			<div class="foot">
			
				<a :href="'/cars/'+car.id" class="btn btn-info" target="_blank">Show</a>

				<template v-if="car.wishlist_type">
					<template v-if="car.wishlist_type[0] == 1">				
						<wishlistbutton act="remove" :data1="car.id" data2="{{auth()->id()}}" :data3="car.wishlist_type[1]"></wishlistbutton>
					</template>

					<template v-if="car.wishlist_type[0] == 2">
						<wishlistbutton act="add" :data1="car.id" data2="{{auth()->id()}}"></wishlistbutton>
					</template>

					<template v-if="car.wishlist_type[0] == 3">
						<wishlistbutton act="add" :data1="car.id" data2="{{auth()->id()}}"></wishlistbutton>
					</template>
				</template>
				
				
			</div>
		</div>
	</div>

</div>
