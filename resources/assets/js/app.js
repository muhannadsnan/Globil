
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example', require('./components/Example.vue'));
Vue.component('ajax', require('./components/Ajax.vue'));
Vue.component('wishlistbutton', require('./components/WishListButton.vue'));
Vue.component('subdata-select', require('./components/SubDataSelect.vue'));
Vue.component('edit-images', require('./components/EditImages.vue'));
Vue.component('search-brand-model', require('./components/SearchBrandModel.vue'));

const app = new Vue({
	el: '#app',

	data: {
		// HOME PAGE SEARCH
		searchKeyword: '',
		searchTyping: false,
		loadingPage: false,
		searchResult: ['init'],

		// CREATE POST
		brand: '',
		models: '',
		loadingModel: false
	},

	methods: {

		loadModelsByBrand(selectedBrand){
			//console.log(selectedBrand);
			loadingModel = true;

			axios.get('/readSubData/'+'model'+'/'+ selectedBrand )
              .then(response => {
                  this.loadingModel = false;
                  this.models = response.data.data;  //console.log(response.data.data);
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
		},

		loadModelsBySubID(subID){ //console.log('subID'+subID);
			loadingModel = true;

			axios.get('/readSubData/'+ subID )
              .then(response => {
                  this.loadingModel = false;
                  this.models = response.data.data;  //console.log(response.data.data);
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
		},

		searchRequest(){
			axios.get('/search/general/'+ this.searchKeyword )
              .then(response => {
                  this.loadingPage = false;
                  this.searchTyping = false;
                  this.searchResult = response.data.data;  //console.log(response.data.data);
              })
              .catch(err => {
                  this.loadingPage = false;
                  this.searchTyping = false;
                  toastr.error(err.message, 'Error occured!');
              })
		},

		filterCars(brandId){
			if(this.searchResult[0] == 'init')
				this.searchResult = [];

			if(brandId > 0){
				this.loadingPage = true;
	         this.searchTyping = true;

				axios.get('/search/filter/brand/'+brandId)
					.then(response => {
						this.loadingPage = false;
         			this.searchTyping = false;

	         		if(response.data.data.length > 0){
	         			response.data.data.filter(car => {
		         			this.searchResult.push(car);
		         		});
	         		}
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
					})
			}
		},

		removeCars(brandTitle){
			this.searchResult = this.searchResult.filter(car => { console.log(car.brand != brandTitle);
				if(car.brand != brandTitle){ console.log(car.brand);
					return {title: 'koko'};
				}
			});
			if(this.searchResult.length == 0)
					this.searchResult[0] = 'init';
		},

		searchKeyEnter(){
			
			if(this.searchKeyword != ''){
				this.loadingPage = true;
				this.searchRequest();
			}
		}
	},

	mounted(){
		
	},

	watch:{
		searchKeyword(val){
			if(val==''){
				this.searchTyping = false;
			}
			else{
				this.searchTyping = true;
			}
		},
	}
});
