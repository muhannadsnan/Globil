<template>
	<div class="search-filters">
		<slot></slot>
		<button v-if="showSaveButton" @click="showModalSaveSearch=true" class="btn btn-primary">Save Search</button>

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
				// searchResult: ['init'],
				// checkedCars: [],
				// priceRange: [0,0],
				searchFilters: {},

				// searchTyping: false,
				// loadingPage: false,
				
				showSaveButton: false,
				showModalSaveSearch: false,
			}
		},

		props: {
		},  

		methods: {

			// refreshResultsByCheck(){ 
			// 	this.loadingPage = true
			// 	this.searchTyping = true

			// 	// To empty array in Vue without causing reactivity problem is this
			// 	while(this.searchResult.length > 0){
			// 		this.searchResult.pop()
			// 	}

			// 	if(this.checkedCars.length != 0){// FILL CHECKED DATA INTO ARRAY TO SEND TO BACK-END

		 //         var brands = []
		 //         this.checkedCars.filter(car => {
		 //         	if(car[1].length == 0)
		 //         		brands.push(car[0])
		 //         });  //console.log(brands)

		 //         var models = []
		 //         this.checkedCars.filter(car => {
		 //         	car[1].filter(model => {
		 //         		models.push(model)	
		 //         	})
		 //         });  //console.log(models)

			// 		this.readCheckedCars('checkedModels', models)
			// 		this.readCheckedCars('checkedBrands', brands)

			// 	}
			// 	else{
			// 		// this.searchResult[0] = 'init' 
			// 		// https://vuejs.org/v2/guide/list.html#Array-Change-Detection
			// 		Vue.set(this.searchResult, 0, 'init'); // show latest posts instead of saerch filtering results
			// 	}

			// 	this.loadingPage = false
			// 	this.searchTyping = false	
			// 	this.showSaveButton = true // show save button when change
			// }, //<<

			// readCheckedCars(url, checkedCars){
			// 	axios.post('/search/filter/'+url, checkedCars)
			// 			.then(response => {
		 //         		if(response.data.data.length > 0){
		 //         			response.data.data.filter(car => {
			//          			this.searchResult.push(car) 
			//          		})
			//          		//this.refreshResultsByPrice()
		 //         		}
			// 			})
			// 			.catch(err => {
			// 				toastr.error(err.message, 'Error was occured!')
			// 			})			
			// }, //<<

			storeSearch(){
				axios.post('/saved-search/', this.searchFilters)
						.then(response => {
		         		toastr.success(response.data.message)
		         		this.showSaveButton = false
		         		this.showModalSaveSearch = false // close modal
		         		//this.searchFilters = {}
						})
						.catch(err => {
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
