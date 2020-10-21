require('./bootstrap');

import VueRouter from 'vue-router';
import router from './route';
import index from './index.vue';

import moment from "moment";




window.Vue = require('vue');
Vue.use(VueRouter);
Vue.filter("fromNow",value=>moment(value).fromNow());

const app = new Vue({
    el: '#app',
    router,
    components:{
      index:index
    }
});

