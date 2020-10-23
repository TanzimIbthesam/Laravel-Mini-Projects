require('./bootstrap');

import VueRouter from 'vue-router';
import router from './route';
import index from './index.vue';

import moment from "moment";
import starRating from './shared/components/starRating.vue';



window.Vue = require('vue');
Vue.use(VueRouter);
Vue.filter("fromNow",value=>moment(value).fromNow());
Vue.component("star-rating",starRating);
const app = new Vue({
    el: '#app',
    router,
    components:{
      index:index
    }
});

