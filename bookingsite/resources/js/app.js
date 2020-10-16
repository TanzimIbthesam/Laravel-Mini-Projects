require('./bootstrap');

import VueRouter from 'vue-router';
import router from './route';
import index from './index.vue'


window.Vue = require('vue');
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components:{
      index:index
    }
});

