<template>
  <div>
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-body">
        <table class="table bg-dark my-3">
               <tr>
                   <td><router-link to="/add" class="btn btn-dark btn-block">Add</router-link></td>
                   
                   <td style="padding-right:10px"><input placeholder="Search" type="search" class="form-control bg-white" v-model="searchText" @change="searchUsers(searchText)" name="search"></td>
               </tr>
        </table>
        
          <table class="table table-bordered">
            <thead class="text-white bg-dark">
              <tr>
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th colspan="2">Actions</th>
              </tr>
            </thead>
            <tbody>
                <h1 v-if="searchResponseType">No records found</h1>
                <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.firstname }}</td>
                <td>{{ user.lastname }}</td>
                <td>{{ user.gender }}</td>
                <td>{{ user.birthday }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.contact }}</td>
                <td>{{ user.address }}</td>
                <td>
                    <router-link
                      :to="{ name: 'edit', params: { id: user.id } }"
                      class="btn btn-info fa fa-edit">
                      
                      </router-link>
                </td>
                <td>
                    <button
                      class="btn btn-danger fa fa-trash"
                      @click="deleteUser(user.id)" >
                      </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="overflow-auto">
            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="total_pages"
              prev-text="Prev"
              next-text="Next"
              align="center"
              @input="getUsers(currentPage)"
              
            ></b-pagination>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      users: [],
      searchText:"",
      searchResponseType:false,
      total_pages:1,
      rows: 0,
      currentPage: 1
    };
  },
  created() {
    
  },
  mounted(){
    this.getUsers();
  },
  methods: {
    getUsers(page=1){
      axios.post(`get-users`,{page})
                  .then(response=>{
                    // console.log(response.data.last_page);
                    this.rows=response.data.last_page;
                    // console.log(this.rows=this.rows % 5);
                    this.users=response.data.data;
                  });
    },
    deleteUser(id) {
      this.$confirm("Are you sure?").then(() => {
        axios.post(`delete-user`,{id})
                    .then((response) => {
                        console.log(response);
                        let i = this.users.map((data) => data.id).indexOf(id);
                        this.users.splice(i, 1);
                      });
      });
    },
    searchUsers(){
      axios.post(`search-users`,{first_name:this.searchText}).then(response=>{
                    this.searchResponseType=response.data.type;
                    this.rows=response.data.data.length;
                    this.users=response.data.data;
                    if(this.searchResponseType)
                    {   
                        this.users=[];
                        this.rows=0;
                    }
                  });
    }
  },
};
</script>
                