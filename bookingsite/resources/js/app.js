require('./bootstrap');
import router from './route';
window.Vue = require('vue');
Vue.component('example-component', require('./component/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
    router
});

