
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.events = new Vue();

window.flash = function (message) {
    window.events.$emit('flash', message);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('study', require('./components/Study.vue'))
Vue.component('subject', require('./components/Subject.vue'))
Vue.component('update-study', require('./components/UpdateStudy.vue'))
Vue.component('update-subject', require('./components/UpdateSubject.vue'))
Vue.component('flash', require('./components/Flash.vue'));
Vue.component('auto-complete', require('./components/AutoComplete.vue'));


const app = new Vue({
    el: '#app'
});
