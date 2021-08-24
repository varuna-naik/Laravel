<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Admin Dashboard</div>
        </div>
        <div class="card card-default">
            <div class="card-header">List of users</div>
            <div class="card-body">
                <userList></userList>
            </div>
        </div>
    </div>
</template>
<script>
  import userList from '../Users.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>