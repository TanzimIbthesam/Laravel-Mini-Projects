require('./bootstrap');

import VueRouter from 'vue-router';
import router from './route';
import index from './index.vue';

import moment from "moment";
import starRating from './shared/components/starRating.vue';
import fatalError from './shared/components/fatalError.vue';
import validationError from './shared/components/validationError.vue';
import Success from './shared/components/Success.vue';



window.Vue = require('vue');
Vue.use(VueRouter);
Vue.filter("fromNow",value=>moment(value).fromNow());
Vue.component("star-rating",starRating);
Vue.component("fatal-error",fatalError);
Vue.component("v-errors",validationError);
Vue.component("success",Success);
const app = new Vue({
    el: '#app',
    router,
    components:{
      index:index
    }
});

