require('./bootstrap');

import VueRouter from 'vue-router';
import router from './route';
import index from './index.vue';

import moment from "moment";
import starRating from './shared/components/starRating.vue';
import fatalError from './shared/components/fatalError.vue';
import validationError from './shared/components/validationError.vue';
import Success from './shared/components/Success.vue';
// import Vue from 'vue';
import Vuex from 'vuex';
import storeDefinition from './store';





window.Vue = require('vue');
// Vue.use(Vuex);
Vue.use(VueRouter);
Vue.filter("fromNow",value=>moment(value).fromNow());
Vue.component("star-rating",starRating);
Vue.component("fatal-error",fatalError);
Vue.component("v-errors",validationError);
Vue.component("success",Success);


const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.use(
    response=>{
           return response;
    },
     error=>{
         if(401===error.response.status){
             store.dispatch("logout");
         }
         return Promise.reject(error);

     }
)
const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
      index:index
    },
   async beforeCreate(){
        this.$store.dispatch('localStorageState');
        this.$store.dispatch("loadUser");


    }
});

