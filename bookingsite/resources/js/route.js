// import Vue from 'vue'
import VueRouter from 'vue-router';
import ExampleComponent from './component/ExampleComponent';
import Contact from './component/Contact.vue';
import Bookable from './Bookable/bookable.vue';


const routes = [
  { path: '/',
  component: Bookable,
name:'home'
},
  { path: '/contact',
  component:Contact,
name:'contact'
},
//   { path: '/contact',
//   component:Contact,
// name:'contact'
// },

]
const router = new VueRouter({
    routes,
  mode: "history"

});
export default router;
