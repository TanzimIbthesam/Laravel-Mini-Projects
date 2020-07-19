import Vue from 'vue';
import Router from 'vue-router'
import testapp from './components/testapp.vue'
import secondtest from './components/secondtest.vue'
import hooks from './components/basics/hooks.vue'
import basicmethods from './components/basics/basicmethods.vue'
//Admin pages
import home from './admin/webpage/home.vue'
import tags from './admin/webpage/tags.vue'
import category from './admin/webpage/category.vue'
import allcom from './Vuex/allcom'

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
      },
    {
        path: '/category',
        component:category
      },
// other routes for practice
{
    path:'/allvuex',
    component:allcom
}


]
export default new Router({
    mode:'history',
    routes
})
