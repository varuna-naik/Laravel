<template>
<div class="container">
        <h3>Add User</h3>
        <div slot="body" class="row">
            <!-- @if {$errors->any()}
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
            @endif -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" class="form-control" name="firstname" v-model="user.firstname">
                 <span class="error-messages">
					<p class="alert alert-danger" v-for="message in errorMessages.firstname" :key=message.firstname>{{ message }}</p>
				</span>
            </div>
            <div class="form-group"> 
                <label>Lastname</label>
                <input type="text" class="form-control" name="lastname" v-model="user.lastname">
                 <span class="error-messages">
					<p class="alert alert-danger" v-for="message in errorMessages.lastname" :key=message.lastname>{{ message }}</p>
				</span>
            </div>
            <div class="form-group">
                <label for="">Gender</label><br>
                <div class="btn-group">
                    <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(user.gender == 'boy')}" @click.prevent="pickGender('boy')"> Male</button>
                    <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (user.gender == 'girl')}" @click.prevent="pickGender('girl')"> Female</button>
                </div>
                
            </div>
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" class="form-control"  name="birthday" v-model="user.birthday">
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label>Email</label>
                <input type="text" class="form-control"  name="email" v-model="user.email">
                 <span class="error-messages">
					<p class="alert alert-danger" v-for="message in errorMessages.email" :key=message.email>{{ message }}</p>
				</span>
            </div>
            <div class="form-group">
            <label>Contact</label>
                <input type="text" class="form-control" name="contact" v-model="user.contact">
                <span class="error-messages">
					<p class="alert alert-danger" v-for="message in errorMessages.contact" :key=message.contact>{{ message }}</p>
				</span>
                
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea cols="35" rows="5"  name="address" v-model="user.address" class="form-control"></textarea>
                
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="gambar" id="gambar">
            </div>
        </div>
    </div>
        <div slot="foot">
            <button class="btn btn-dark" @click="storeUser()">Add</button>
        </div>
        </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      errorMessages:{},
    };
  },
  methods: {
    storeUser() {
    axios.post(`add-user`, this.user)
        .then(response =>{
            //  this.$router.push({ name: "users" });
            console.log(response);
            this.errorMessages=response.data.result;
        })
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },
    pickGender(gender){
        this.user.gender=gender;
    }
  },
};
</script>