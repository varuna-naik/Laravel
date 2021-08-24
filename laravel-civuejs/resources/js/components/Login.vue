<template>
    <div class="vue-tempalte">
        <form>
            <h3>Log In</h3>
            <p class="text-danger" v-for="message in errorMessages.credentials" :key=message.credentials>{{message}}</p>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control form-control-lg" v-model="user.email" />
                <p class="text-danger" v-for="message in errorMessages.email" :key=message.email>{{message}}</p>
            </div>
 
            <div class="form-group">
                <label>Password</label>
                <input type="password"  name="password" class="form-control form-control-lg" v-model="user.password" />
                <p class="text-danger" v-for="message in errorMessages.email" :key=message.password>{{message}}</p>
            </div>
 
            <button type="submit" class="btn btn-dark btn-lg btn-block" @click="login()">Log In</button>
 
            <!-- <p class="forgot-password text-right mt-2 mb-4">
                <router-link to="/forgot-password">Forgot password ?</router-link>
            </p>
 
            <div class="social-icons">
                <ul>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </ul>
            </div> -->
 
        </form>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                user:{
                    email:'',
                    password:'',
                    device_name: 'browser',
                },
                errorMessages:{},
                
            };
        },
        methods:{
            login(){
                axios.post('api/login',this.user)
                            .then(response=>{
                                console.log(response);
                                                                
                                if(response.data.success){
                                    const redirectTo=response.data.nextpage;
                                    this.$root.$emit("login", true);
                                    localStorage.setItem("token", response.data.token)
                                    
                                    this.$router.push({name: redirectTo});
                                }
                                console.log(response);
                                this.errorMessages=response.data.result;
                                // console.log(response.data);
                                
                            }).catch((errors) => {
                                this.errorMessages = errors.response.data.errors
                            });
                
            },
        },
        mounted(){
            // this.isLoggedin=!!localStorage.getItem("token");
            // let token = localStorage.getItem("token");

            // if (token) {
            //     BaseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;
            // }
        }
    }
</script>