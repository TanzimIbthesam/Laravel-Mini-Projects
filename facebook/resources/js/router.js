import Vue from 'vue';
import Router from 'vue-router';
import NewsFeed from './views/NewsFeed.vue';
import UserShow from './views/users/Show.vue';

Vue.use(Router);

const app = new Vue({
    el: '#app'
})

const routes = [
    {
           path: '/', name: 'home', component: NewsFeed,
           meta:{title:'News Feed'}
    },

  {
      path: '/users/:userId',
      name: 'users.show',
      component: UserShow,
      meta: {
          title: 'Profile'
      }
  }

]

export default new Router({
    mode: 'history',
    routes
})
