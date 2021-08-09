<template>
<div class="container">
        <h3>Update User</h3>
        <div slot="body" class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" class="form-control" name="firstname" v-model="user.firstname">
            </div>
            <div class="form-group"> 
                <label>Lastname</label>
                <input type="text" class="form-control" name="lastname" v-model="user.lastname">
                
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
                
            </div>
            <div class="form-group">
            <label>Contact</label>
                <input type="text" class="form-control" name="contact" v-model="user.contact">
                
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
            <button class="btn btn-dark" @click="updateUser()">Update</button>
        </div>
        </div>
</template>
 
<script>
export default {
  data() {
    return {
      user: {},
    };
  },
  created() {
      axios.post(`get-user-by-id`,{id:this.$route.params.id})
      .then((res) => {
        // console.log(res);
        this.user = res.data;
      });
  },
  methods: {
    updateUser() {
      axios.post(`update-user`,this.user)
        .then((res) => {
            // console.log(res.data);
          this.$router.push({ name: "users"});
        });
    },
    pickGender(gender){
        this.user.gender=gender;
    }
  },
};
</script>
           