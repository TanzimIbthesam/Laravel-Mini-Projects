import Vue from 'vue';
import Router from 'vue-router';
import NewsFeed from './views/NewsFeed.vue';

Vue.use(Router);

const app = new Vue({
    el: '#app'
})

const routes = [{
    path: '/',
    component:NewsFeed
}]

export default new Router({
    mode: 'history',
    routes
})
