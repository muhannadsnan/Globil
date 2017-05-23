
require('./bootstrap');

window.Vue = require('vue');


Vue.component('example', require('./components/Example.vue'));
Vue.component('ajax', require('./components/Ajax.vue'));
Vue.component('wishlistbutton', require('./components/WishListButton.vue'));

const app = new Vue({
	el: '#app',
	methods: {


	}
});
