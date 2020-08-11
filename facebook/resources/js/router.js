import Vue from 'vue';
import Router from 'vue-router';
import Start from './components/Start.vue';

Vue.use(Router);

const app = new Vue({
    el: '#app'
})

const routes = [{
    path: '/',
    component: Start
}]

export default new Router({
    mode: 'history',
    routes
})
