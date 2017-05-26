
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
                  //toastr.success(response.data.message);
                  this.loadingModel = false;
						//console.log(response.data.data);
                  this.models = response.data.data;
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
