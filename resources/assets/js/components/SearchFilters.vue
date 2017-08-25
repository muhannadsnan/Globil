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
				cars: [],
				showSaveButton: false,
				showModalSaveSearch: false,
			}
		},
		props: {
			paginator: {},
			is_active: 0,
			more_results: 0,
		},  
		methods: {
			storeSearch(){
				axios.post('/saved-search/', this.searchFilters)
						.then(response => {
								toastr.success(response.data.message)
								this.showSaveButton = false
								this.showModalSaveSearch = false // close modal
						})
						.catch(err => {
							if(err.response.status === 401)
								toastr.error(err.message, 'You must be logged in to save a search!')
							else
								toastr.error(err.message, 'Error was occured!')
						})  
			}, //<<
			
			FillSearchFilters(childData){
				this.searchResult = {}
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
				this.$emit('results-ready', {filters: this.cleanFilters()})

				//this.readCars()
			},

			// readCars(){
			// 	axios.post('/search/results', {req: this.searchFilters, paginator: this.$root.$data.paginator})
			// 			.then(response => {
			// 				this.cars = response.data.data
			// 				this.$emit('results-ready', {cars: this.cars, moreResults: response.data.moreResults, filters: this.searchFilters})
			// 			})
			// 			.catch(err => {
			// 				toastr.error(err.message, 'Error was occured!')
			// 			})
			// },
			removeBrand_modelFromSearchFilters(){
				this.searchFilters.brand_model = {}
			},

			cleanFilters(){
				if(this.searchFilters != {}){
					var res = this.searchFilters
					if(res.car_types){
						res.car_types = res.car_types.filter(ct => {
							return ct != 0
						})
					}
					if(res.wheel_drives){
						res.wheel_drives = res.wheel_drives.filter(wd => {
							return wd != 0
						})
					}
					if(res.gears){
						res.gears = res.gears.filter(gr => {
							return gr != 0
						})
					}
					if(res.fuel_types){
						res.fuel_types = res.fuel_types.filter(ft => {
							return ft != 0
						})
					}
					return res
				}
			},
		},
		mounted() {
			this.$on('brand-model-changed', this.FillSearchFilters)
			this.$on('price-range-changed', this.FillSearchFilters)
			this.$on('year-changed', this.FillSearchFilters)
			this.$on('car-type-changed', this.FillSearchFilters)
			this.$on('wheel-drive-changed', this.FillSearchFilters)
			this.$on('km-range-changed', this.FillSearchFilters)
			this.$on('fuel-type-changed', this.FillSearchFilters)
			this.$on('gear-changed', this.FillSearchFilters)
			this.$on('area-changed', this.FillSearchFilters)
			this.$root.$on('typing', this.removeBrand_modelFromSearchFilters)
		},
		watch:{
		}
	}
</script>