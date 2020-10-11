import Vue from 'vue'
import VueRouter from 'vue-router';
import ExampleComponent from './component/ExampleComponent';

Vue.use(VueRouter);
const routes = [
  { path: '/',
  component: ExampleComponent },

]
const router = new VueRouter({
  routes
});

export default router;
