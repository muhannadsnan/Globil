
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
		loadingModel: false,
	},

	methods: {

		loadModelsByBrand(selectedBrand){
			this.loadingModel = true;

			axios.get('/readSubData/'+'model'+'/'+ selectedBrand )
              .then(response => {
                  this.models = response.data.data;  //console.log(response.data.data);
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
        this.loadingModel = false;
		},

		loadModelsBySubID(subID){ 
			this.loadingModel = true;

			axios.get('/readSubData/'+ subID )
              .then(response => {
                  this.models = response.data.data;  
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
        	this.loadingModel = false;
		},

		searchRequest(){
			axios.get('/search/general/'+ this.searchKeyword )
              .then(response => {
                  this.searchResult = response.data.data;  
              })
              .catch(err => {
                  toastr.error(err.message, 'Error occured!');
              })
        	this.loadingPage = false;
         this.searchTyping = false;
		},

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
		},

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
