<template>
	<div class="saved-search">
		<slot></slot>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				searchResult: ['init'],
				savedSearch: {},

				searchTyping: false,
				loadingPage: false,
				
			}
		},

		props: {
		},  

		methods: {

			refreshResults(allChecked){ 
				this.loadingPage = true;
				this.searchTyping = true;

				this.searchResult = [];

				if(allChecked.length != 0){// FILL CHECKED DATA INTO ARRAY TO SEND TO BACK-END

		         var brands = [];
		         allChecked.filter(car => {
		         	if(car[1].length == 0)
		         		brands.push(car[0]);
		         });  console.log(brands);

		         var models = [];
		         allChecked.filter(car => {
		         	car[1].filter(model => {
		         		models.push(model);	
		         	});
		         });  console.log(models);

					this.readCheckedCars('checkedModels', models);
					this.readCheckedCars('checkedBrands', brands);				
				}
				else{
					this.searchResult[0] = 'init'; // show latest posts instead of saerch filtering results
				}
				this.loadingPage = false;
				this.searchTyping = false;	
			}, //<<

			readCheckedCars(url, checkedCars){
				axios.post('/search/filter/'+url, checkedCars)
						.then(response => {
		         		if(response.data.data.length > 0){
		         			response.data.data.filter(car => {
			         			this.searchResult.push(car); 
			         		});
		         		}
						})
						.catch(err => {
							toastr.error('Error was occured!', err.message);
						})			
			}, //<<
		},

		mounted() {
			console.log('SavedSearch Component mounted.')
			//console.log(this.user)
			
			// @new-item-checked="refreshResults"
			// @item-un-checked="refreshResults"
			this.$on('new-item-checked', this.refreshResults);
			this.$on('item-un-checked', this.refreshResults);
		},

		watch:{
			searchResult(val){
				this.$emit('search-results-ready', this.searchResult);
			}
		}
	}
</script>
