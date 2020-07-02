import Vue from 'vue';
import Router from 'vue-router'
import testapp from './components/testapp.vue'
import secondtest from './components/secondtest.vue'
Vue.use(Router);

const routes=[
    {
        path:'/test',
        component:testapp
    },
    {
        path:'/secondtest',
        component:secondtest
    },

]
export default new Router({
    mode:'history',
    routes
})
