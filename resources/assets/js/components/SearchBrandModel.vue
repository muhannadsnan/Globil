<template>
	<div class="SearchBrandModel text-left">
		<span v-if="loading">Loading data..</span>

		<div v-for="(brand, i) in brands" v-else>
			<input type="checkbox" name="brand" :value="brand.id" v-model="brandCheckboxes[i]"
					 @change="brandChanged($event.target.checked, brand.id, brand.title)"> 
			<label for="brand">{{brand.title}}</label> 

			<div v-for="model in models" v-show="brandCheckboxes[i]">
				<template  v-if="model.ntype2 == brand.title">
					&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="model" :value="model.id">
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
				if(val == 1)
					this.$emit('brand-checked', brandId);
				else
					this.$emit('brand-unchecked', brandTitle);
			}
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
