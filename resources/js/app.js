/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//import search_input from './components/SearchInputComponent.vue'

Vue.component(
    'search-input-component',
    require('./components/SearchInputComponent.vue').default);

Vue.component(
    'sponsor-component',
    require('./components/SponsorComponent.vue').default);

Vue.component(

    'payment-component',
    require('./components/PaymentComp.vue').default);

Vue.component(
    'promotion-component',
    require('./components/PromotionComponent.vue').default);

Vue.component(
    'preview-comp',
    require('./components/ImgPreview.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
