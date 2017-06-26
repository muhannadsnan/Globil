<template>
	<div class="search-filters">
		<slot></slot>
		
		<div class="form-group">
			<button v-if="showSaveButton" @click="showModalSaveSearch=true" class="btn btn-primary">Save Search</button>
		</div>			

		<modal title="Title for Saved Search" v-show="showModalSaveSearch" @clk-close-modal="showModalSaveSearch=false">
			<div class="form-group">
				<input type="text" placeholder="Title for Saved Search.. (optional)" v-model="searchFilters.title" class="form-control" @keyup.enter="storeSearch">
			</div>
			<template slot="buttons">
				<button v-if="showSaveButton" @click="storeSearch" class="btn btn-primary">Save Search</button>									
			</template>
		</modal>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				searchFilters: {},
				
				showSaveButton: false,
				showModalSaveSearch: false,
			}
		},

		props: {
		},  

		methods: {

			storeSearch(){
				axios.post('/saved-search/', this.searchFilters)
						.then(response => {
		         		toastr.success(response.data.message)
		         		this.showSaveButton = false
		         		this.showModalSaveSearch = false // close modal
		         		//this.searchFilters = {}
						})
						.catch(err => {
							if(err.response.status === 401)
								toastr.error(err.message, 'You must be logged in to save a search!')
							else
								toastr.error(err.message, 'Error was occured!')
						})	
			}, //<<

			FillSearchFilters(childData){
				if(childData.CheckedCars)
					this.searchFilters.brand_model = childData.CheckedCars
				if(childData.priceRange)
					this.searchFilters.priceRange = childData.priceRange
				if(childData.CheckedYears)
					this.searchFilters.years = childData.CheckedYears
				if(childData.CheckedCarTypes)
					this.searchFilters.car_types = childData.CheckedCarTypes
				if(childData.CheckedWheelDrives)
					this.searchFilters.wheel_drives = childData.CheckedWheelDrives
				if(childData.kmRange)
					this.searchFilters.kmRange = childData.kmRange
				if(childData.CheckedFuelTypes)
					this.searchFilters.fuel_types = childData.CheckedFuelTypes
				if(childData.CheckedGears)
					this.searchFilters.gears = childData.CheckedGears
				if(childData.CheckedAreas)
					this.searchFilters.areas = childData.CheckedAreas

				this.showSaveButton = true
			},
		},

		mounted() {
			console.log('searchFilters Component mounted.')
			this.$on('brand-model-changed', this.FillSearchFilters)
			this.$on('price-range-changed', this.FillSearchFilters)
			this.$on('year-changed', this.FillSearchFilters)
			this.$on('car-type-changed', this.FillSearchFilters)
			this.$on('wheel-drive-changed', this.FillSearchFilters)
			this.$on('km-range-changed', this.FillSearchFilters)
			this.$on('fuel-type-changed', this.FillSearchFilters)
			this.$on('gear-changed', this.FillSearchFilters)
			this.$on('area-changed', this.FillSearchFilters)
		},

		watch:{

			searchFilters: {
		   	handler: function (val, oldVal) { 
		   		console.log(val)
		   	},
		   	deep: true
		   },
		}
	}
</script>
