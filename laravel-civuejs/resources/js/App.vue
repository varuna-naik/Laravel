<template>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="/img/civue.png" width="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <router-link :to="{ name: 'home' }" class="nav-item nav-link">Home</router-link>
            <router-link :to="{ name: 'login' }" class="nav-item nav-link" v-if="!isLoggedIn">Login</router-link>
            <router-link :to="{ name: 'add' }" class="nav-item nav-link" v-if="!isLoggedIn">Register</router-link>
            <li class="nav-link" v-if="isLoggedIn"> Hi, {{name}}</li>
            <router-link :to="{ name: 'dashboard' }" class="nav-link" v-if="isLoggedIn">Dashboard</router-link>
            <a class="nav-item nav-link" v-if="isLoggedIn" href="#" @click="logout()">Logout</a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <router-view></router-view>
    </div>
    </div>
</template>
 
<script>
    export default {
          data(){
            return {
                isLoggedIn:false,
                name : null
            }
        },
        methods: {
            logout(){
                axios.get('api/logout').then(response=>{
                  localStorage.removeItem("token");
                  console.log(response);
                  this.isLoggedIn=false;
                  this.$router.push({name:"home"});
                });
            }
        },
        mounted(){
            
        },
        created(){
          //Check if the user is Authenticated
            this.isLoggedIn = !!localStorage.getItem("token");
            // this.isLoggedIn ? this.name = window.Laravel.user['name'] : this.name = null
        }
    }
</script>