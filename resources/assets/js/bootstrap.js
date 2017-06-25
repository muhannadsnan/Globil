
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
 
window.formData = require('form-data');
window.moment = require('moment');
window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.toastr = require('toastr');
toastr.options.closeButton = true;
toastr.options.closeDuration = 1000;
toastr.options.showMethod = 'slideDown';
toastr.options.hideMethod = 'slideUp';
toastr.options.closeMethod = 'slideUp';
toastr.options.timeOut = 2500;
toastr.options.progressBar = false;

// VUE COMPONENTS

window.Vue = require('vue');
Vue.component('example', require('./components/Example.vue'));
Vue.component('ajax', require('./components/Ajax.vue'));
Vue.component('modal', require('./components/modal.vue'));
Vue.component('wishlistbutton', require('./components/WishListButton.vue'));
Vue.component('subdata-select', require('./components/SubDataSelect.vue'));
Vue.component('edit-images', require('./components/EditImages.vue'));
Vue.component('search-filters', require('./components/SearchFilters.vue'));
Vue.component('search-brand-model', require('./components/SearchBrandModel.vue'));
Vue.component('search-price', require('./components/SearchPrice.vue'));
Vue.component('search-year', require('./components/SearchYear.vue'));
Vue.component('search-car-type', require('./components/SearchCarType.vue'));
Vue.component('search-wheel-drive', require('./components/SearchWheelDrive.vue'));
Vue.component('search-km', require('./components/SearchKm.vue'));
Vue.component('search-fuel-type', require('./components/SearchFuelType.vue'));
Vue.component('search-gear', require('./components/SearchGear.vue'));
Vue.component('search-areas', require('./components/SearchArea.vue'));
Vue.component('conversations', require('./components/Conversations.vue'));
Vue.component('messages', require('./components/Messages.vue'));
Vue.component('ads', require('./components/Ads.vue'));
Vue.component('manage-ads', require('./components/ManageAds.vue'));
Vue.component('ads', require('./components/Ads.vue'));
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
