import VueRouter from 'vue-router'
import Users from './components/Users.vue';
import StoreUser from './components/StoreUser.vue';
import UpdateUser from './components/UpdateUser.vue';
import Home from './components/Home.vue';

export const routes = [{
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'add',
        path: '/add',
        component: StoreUser
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: UpdateUser
    },
    {
        name: 'home',
        path: '/',
        component: Home
    },
    
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
  })
  export default router

