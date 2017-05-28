
require('./bootstrap');

window.Vue = require('vue');


Vue.component('example', require('./components/Example.vue'));
Vue.component('ajax', require('./components/Ajax.vue'));
Vue.component('wishlistbutton', require('./components/WishListButton.vue'));
Vue.component('subdata-select', require('./components/SubDataSelect.vue'));

const app = new Vue({
	el: '#app',

	data: {
		// create post
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
                  this.models = response.data.data;  console.log(response.data.data);
              })
              .catch(err => {
                  toastr.error('Error was occured!', err.message);
              })
		},

		loadModelsBySubID(subID){ console.log('subID'+subID);
			loadingModel = true;

			axios.get('/readSubData/'+ subID )
              .then(response => {
                  this.loadingModel = false;
                  this.models = response.data;  console.log(response.data);
              })
              .catch(err => {
                  toastr.error('Error was occured!', err.message);
              })
		}
	},

	mounted(){
		// this.$on('brandChanged')
	}
});
