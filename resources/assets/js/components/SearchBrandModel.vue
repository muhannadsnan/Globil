<template>
	<div class="search-brand-model text-left">

		<div v-for="(brand, i) in brands" class="brands">
			<input type="checkbox" name="brand" :value="brand.id" v-model="brandCheckboxes[i]"
					 @change="brandChanged($event.target.checked, brand.id, brand.title)"
					 :disabled="$root.$data.searchKeyword != '' "> 
			<label for="brand">{{brand.title}}</label> 

			<div v-for="model in models" v-show="brandCheckboxes[i]" class="models">
				<template  v-if="model.ntype2 == brand.title">
					<input type="checkbox" name="model" :value="model.id" 
						@change="modelChanged($event.target.checked, model.id, model.title, brand.id)"
						:disabled="$root.$data.searchKeyword != '' "
						v-model="modelsChecked">
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
				allChecked: [],
				modelsChecked: [],
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
					Vue.set(this.$root.$data.isActiveAll, 2, true)
				}
				else{ // remove brand and it's models starting with models
					this.allChecked = this.allChecked.filter(car => { // remove brand array 
						return car[0] != brandId
					})
					this.modelsChecked = []
					this.allChecked.forEach(car => {
						// give me all models of cars, bcz they belong to checked brands
						car[1].forEach(rModel => { console.log(rModel)
							this.modelsChecked.push(rModel)
						}) 
					})
					if(this.allChecked.length == 0)
						Vue.set(this.$root.$data.isActiveAll, 2, false)
				} 
				this.sendAllFiltersToParent()
			},

			modelChanged(val, modelId, modelTitle, brandId){ 
				if(val == 1){ // add model to array in brand item in all-data
					this.allChecked.forEach(car => { 
						if(car[0] == brandId){ 
							car[1].push(modelId)
						}
					})
					Vue.set(this.$root.$data.isActiveAll, 3, true)
				}
				else{
					this.allChecked = this.allChecked.filter(car => { // car[brandId] = [array of models]
						console.log(car[1])
						if(car[1].includes(modelId)){
							car[1] = car[1].filter(model => {
								return model != modelId
							})
							this.modelsChecked.filter(model=> {
								return model != modelId
							})
						}
						return car
					})
					if(this.allChecked.length == 0)
						Vue.set(this.$root.$data.isActiveAll, 3, false)
				}
				this.sendAllFiltersToParent()
			},

			sendAllFiltersToParent(){
				this.$parent.$emit('brand-model-changed', {CheckedCars: this.allChecked})
				this.$emit('any-filter-change', {from: 'brand_model'})
			},
			sendDataToParentWithoutNotifingAll(e){
				if(e.from != 'brand_model')
					this.$parent.$emit('brand-model-changed', {CheckedCars: this.allChecked})
			},
		},

		mounted() {
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