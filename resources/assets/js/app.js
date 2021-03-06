
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*var VueTouch = require('vue-touch')
Vue.use(VueTouch, {name: 'v-touch'})*/
import * as localforage from 'localforage';

localforage.config({
    driver: localforage.INDEXEDDB,
    name: 'farm_attacks'
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('farmer', require('./components/Farmer'));
Vue.component('notification', require('./components/Notification'));

const app = new Vue({
    el: '#app'
});
