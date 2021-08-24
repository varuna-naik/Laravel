require('./bootstrap');

import Vue from 'vue'

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router'
import axios from 'axios';
import router from './routes'
import VueSimpleAlert from "vue-simple-alert";
import {BootstrapVue} from 'bootstrap-vue';
import Login from './components/Login.vue';
// import VueAuth from '@websanova/vue-auth'

// Set Vue router
Vue.router = router
Vue.use(VueRouter)


Vue.use(VueSimpleAlert);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
// axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`   

Vue.use(BootstrapVue);
// Vue.use(VueAuth,auth);

Vue.component('app', App.default)


const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});

// Vue.component('login', Login.default);