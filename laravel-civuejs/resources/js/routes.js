import VueRouter from 'vue-router'
import AdminDashboard from './components/admin/Dashboard.vue';
import Users from './components/Users.vue';
import StoreUser from './components/StoreUser.vue';
import UpdateUser from './components/UpdateUser.vue';
import Home from './components/Home.vue';
import Login from './components/Login.vue';
import Dashboard from './components/user/Dashboard.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'adminDashboard',
        path: '/adminDashboard',
        component: Users,
        meta: {
          auth: {role: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        }    },
    {
        name: 'add',
        path: '/add',
        component: StoreUser,
        // meta: { guestOnly: true },
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: UpdateUser
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: { guestOnly: true },
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: { authOnly: true },
        // beforeEnter: (to, form, next) =>{
        //   axios.post('/login').then(()=>{
        //       next()
        //   }).catch(()=>{
        //       return next({ name: 'login'})
        //   })
        //   next();
        // }
    },
   
        
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    base:process.env.BASE_URL,
    routes,
  })

function isLoggedIn() {
    return localStorage.getItem("token");
}
  
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
      
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
          next({
            path: "/login",
            query: { redirect: to.fullPath }
          });
        } else {
          next();
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
          next({
            path: "/dashboard",
            query: { redirect: to.fullPath }
          });
        } else {
          next();
        }
    }
     else {
      next(); // make sure to always call next()!
    }
  });

  export default router;

