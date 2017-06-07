<template>
	<div class="SearchBrandModel text-left">

		<div v-for="(brand, i) in brands" >
			<input type="checkbox" name="brand" :value="brand.id" v-model="brandCheckboxes[i]"
					 @change="brandChanged($event.target.checked, brand.id, brand.title)"> 
			<label for="brand">{{brand.title}}</label> 

			<div v-for="model in models" v-show="brandCheckboxes[i]">
				<template  v-if="model.ntype2 == brand.title">
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="model" :value="model.id" 
						@change="modelChanged($event.target.checked, model.id, model.title, brand.id)">
					<label for="model">{{model.title}}</label> 
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
				brands: [],
				models: [],
				brandCheckboxes: [],
				// CheckedModels: [], 
				allChecked: [],
			}
		},

		methods: {

			getBrandsAndModels(){
				axios.get('/read-brands-with-models')
					.then(response => {
						this.brands = response.data.brands;
						this.models = response.data.models;
						this.loading = false;
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
					})
			},
			
			brandChanged(val, brandId, brandTitle){ 
				if(val == 1){ // add brand to all-data
					this.allChecked.push([brandId, []]);
					this.$parent.$emit('new-item-checked', this.allChecked);
				}
				else{ // remove brand and it's models
					this.allChecked = this.allChecked.filter(car => { 
						if(car[0] != brandId)
							return car;
					});
					this.$parent.$emit('item-un-checked', this.allChecked);
				}
			},

			modelChanged(val, modelId, modelTitle, brandId){ 
				if(val == 1){ // add model to array in brand item in all-data
					this.allChecked = this.allChecked.filter(car => { 
						if(car[0] == brandId){ 
							car[1].push(modelId);
						}
						return car;
					});

					this.$parent.$emit('new-item-checked', this.allChecked);
				}
				else{
					this.allChecked = this.allChecked.filter(car => { // car[brandId] = [array of models]
						console.log(car[1]);
						if(car[1].includes(modelId)){
							car[1] = car[1].filter(model => {
								if(model != modelId)
									return model;
							});
						}
						return car;
					});

					this.$parent.$emit('item-un-checked', this.allChecked);
				}
			},
		},

		mounted() {
			console.log('SearchBrandModel Component mounted.')
			this.getBrandsAndModels();
		},

		watch:{
			brands(val){
				this.brands.filter(b => {
					this.brandCheckboxes.push(false); 
				})
			},
		}
	}
</script>
