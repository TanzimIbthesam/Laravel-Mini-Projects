require('./bootstrap');

window.Vue=require("vue");
import router from './router'
import ViewUI from 'view-design';
import ViewRouter from 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);
Vue.use(ViewRouter);
Vue.component('mainapp',require('./components/mainapp.vue').default)
const app=new Vue({
    el:'#app',
    router
})
