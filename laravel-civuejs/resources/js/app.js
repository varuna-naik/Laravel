require('./bootstrap');

import Vue from 'vue'

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router'
import axios from 'axios';
import router from './routes'
import VueSimpleAlert from "vue-simple-alert";
import {BootstrapVue} from 'bootstrap-vue';

// Set Vue router
Vue.router = router
Vue.use(VueRouter)


Vue.use(VueSimpleAlert);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);

Vue.component('app', App)

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
