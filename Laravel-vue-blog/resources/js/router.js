import Vue from 'vue';
import Router from 'vue-router'
import testapp from './components/testapp.vue'
import secondtest from './components/secondtest.vue'
import hooks from './components/basics/hooks.vue'
import basicmethods from './components/basics/basicmethods.vue'
import home from './components/webpage/home.vue'
import tags from './components/webpage/tags.vue'

Vue.use(Router);

const routes=[
    //routes of project
       {
           path: '/',
           component: home,
           name: 'home'

       },
            {
                path: '/tags',
                component:tags,
                name: 'tags'

            },
    {
        path:'/test',
        component:testapp
    },
    {
        path:'/secondtest',
        component:secondtest
    },
    {
        path:'/hooks',
        component:hooks
    },
      {
          path: '/basicmethods',
          component:basicmethods
      }



]
export default new Router({
    mode:'history',
    routes
})
