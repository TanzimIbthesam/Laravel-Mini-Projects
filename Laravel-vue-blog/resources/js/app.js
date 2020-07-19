require('./bootstrap');

window.Vue=require("vue");
import router from './router'
import store from './store'
import ViewUI from 'view-design';
import ViewRouter from 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);
Vue.use(ViewRouter);
import common from './common.js'
Vue.mixin(common)
Vue.component('mainapp',require('./components/mainapp.vue').default)
const app=new Vue({
    el:'#app',
    router,
    store
})
