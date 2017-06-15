<template>
	<div class="search-brand-model text-left">

		<div v-for="(brand, i) in brands" class="brands">
			<input type="checkbox" name="brand" :value="brand.id" v-model="brandCheckboxes[i]"
					 @change="brandChanged($event.target.checked, brand.id, brand.title)"> 
			<label for="brand">{{brand.title}}</label> 

			<div v-for="model in models" v-show="brandCheckboxes[i]" class="models">
				<template  v-if="model.ntype2 == brand.title">
					<input type="checkbox" name="model" :value="model.id" 
						@change="modelChanged($event.target.checked, model.id, model.title, brand.id)">
					<label for="model">{{model.title}}</label> 
				</template>
			</div>
		</div> 
		<hr>       
	</div>
</template>


<script>
	export default {
		data(){
			return {
				loading: true,
				brands: [],
				models: [],
				brandCheckboxes: [],
				// CheckedModels: [], 
				allChecked: [],
			}
		},

		methods: {

			getBrandsAndModels(){
				axios.get('/read-data-with-subdata/brand/model')
					.then(response => {
						this.brands = response.data.data
						this.models = response.data.subdata
						this.loading = false
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},
			
			brandChanged(val, brandId, brandTitle){ 
				if(val == 1){ // add brand to all-data
					this.allChecked.push([brandId, []])
				}
				else{ // remove brand and it's models
					this.allChecked = this.allChecked.filter(car => { 
						if(car[0] != brandId)
							return car
					})
				}
				this.sendAllFiltersToParent()
			},

			modelChanged(val, modelId, modelTitle, brandId){ 
				if(val == 1){ // add model to array in brand item in all-data
					this.allChecked = this.allChecked.filter(car => { 
						if(car[0] == brandId){ 
							car[1].push(modelId)
						}
						return car
					})
				}
				else{
					this.allChecked = this.allChecked.filter(car => { // car[brandId] = [array of models]
						console.log(car[1])
						if(car[1].includes(modelId)){
							car[1] = car[1].filter(model => {
								if(model != modelId)
									return model
							})
						}
						return car
					})
					this.sendAllFiltersToParent()
				}
			},

			sendAllFiltersToParent(){
				this.$parent.$emit('brand-model-changed', {CheckedCars: this.allChecked})
				this.$emit('any-filter-change')
			},

			sendDataToParentWithoutNotifingAll(){
				this.$parent.$emit('brand-model-changed', {CheckedCars: this.allChecked})
			},
		},

		mounted() {
			// console.log('SearchBrandModel Component mounted.')
			this.getBrandsAndModels()
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)
		},

		watch:{
			brands(val){
				this.brands.filter(b => {
					this.brandCheckboxes.push(false) 
				})
			},
		}
	}
</script>

<style lang="sass" scoped>
.models input	
	margin-left: 30px !important
.models label
	color: #46b8da
</style>
