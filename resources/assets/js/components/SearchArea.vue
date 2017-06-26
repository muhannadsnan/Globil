<template>
	<div class="search-area text-left">

		<div v-for="(area, i) in areas" class="areas">
			<input type="checkbox" name="area" :value="area.id" v-model="areaCheckboxes[i]"
					 @change="areaChanged($event.target.checked, area.id, area.title)"> 
			<label for="area">{{area.title}}</label> 

			<div v-for="city in cities" v-show="areaCheckboxes[i]" class="cities">
				<template  v-if="city.ntype2 == area.title">
					<input type="checkbox" name="city" :value="city.id" 
						@change="cityChanged($event.target.checked, city.id, city.title, area.id)">
					<label for="city">{{city.title}}</label> 
				</template>
			</div>
		</div> 
		    
	</div>
</template>


<script>
	export default {
		data(){
			return {
				loading: true,
				areas: [],
				cities: [],
				areaCheckboxes: [],
				// CheckedModels: [], 
				allChecked: [],
			}
		},

		methods: {

			getAreasWithCities(){
				axios.get('/read-data-with-subdata/area/city')
					.then(response => {
						this.areas = response.data.data
						this.cities = response.data.subdata
						this.loading = false
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},
			
			areaChanged(val, areaId, areaTitle){ 
				if(val == 1){ // add area to all-data
					this.allChecked.push([areaId, []])
				}
				else{ // remove area and it's cities
					this.allChecked = this.allChecked.filter(city => { 
						if(city[0] != areaId)
							return city
					})
				}
				this.sendAllFiltersToParent()
			},

			cityChanged(val, cityId, cityTitle, areaId){ 
				if(val == 1){ // add city to array in area item in all-data
					this.allChecked = this.allChecked.filter(area => { 
						if(area[0] == areaId){ 
							area[1].push(cityId)
						}
						return area
					})
				}
				else{
					this.allChecked = this.allChecked.filter(area => { // area[areaId] = [array of cities]
						// console.log(area[1]) // cities in area
						if(area[1].includes(cityId)){
							area[1] = area[1].filter(city => {
								if(city != cityId)
									return city
							})
						}
						return area
					})
				}
				this.sendAllFiltersToParent()
			},

			sendAllFiltersToParent(){
				this.$parent.$emit('area-changed', {CheckedAreas: this.allChecked})
				this.$emit('any-filter-change')
			},

			sendDataToParentWithoutNotifingAll(){
				this.$parent.$emit('area-changed', {CheckedAreas: this.allChecked})
			},
		},

		mounted() {
			// console.log('SearchBrandModel Component mounted.')
			this.getAreasWithCities()
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)
		},

		watch:{
			areas(val){
				this.areas.filter(b => {
					this.areaCheckboxes.push(false) 
				})
			},
		}
	}
</script>

<style lang="sass" scoped>
.cities input	
	margin-left: 30px !important
.cities label
	color: #46b8da
</style>
