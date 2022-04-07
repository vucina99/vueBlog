/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VModal from 'vue-js-modal'
import Vue from 'vue';

window.Vue = require('vue').default;
Vue.use(VModal, { dialog: true })


// main.js
import VueSimpleAlert from "vue-simple-alert";
 
Vue.use(VueSimpleAlert, { reverseButtons: true });
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component(
    'post',
    () => import(/* webpackChunkName: "js/chunks/service-activities" */'./components/Posts.vue')
);
Vue.component(
    'edit-post',
    () => import(/* webpackChunkName: "js/chunks/service-activities" */'./components/EditPost.vue')
);
Vue.component(
    'upload-post',
    () => import(/* webpackChunkName: "js/chunks/service-activities" */'./components/UploadPost.vue')
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    data(){
        return {
            auth_check : window.auth_check,
            auth_user : window.auth_user
        }
    }
})
const app = new Vue({
    el: '#app',
});
