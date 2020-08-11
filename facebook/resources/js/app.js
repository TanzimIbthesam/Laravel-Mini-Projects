import Vue from 'vue';
import router from './router';
 import App from './components/App.vue';

require('./bootstrap');

window.Vue = require('vue');



// Vue.component('App', require('./components/App.vue').default);


const app = new Vue({
    el: '#app',
   components:{
       App
   },
    router
});

