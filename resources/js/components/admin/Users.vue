<template>
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Table</h3>

        <div class="card-tools">
          <button class="btn btn-success" @click="newModal">Add New <i class="fa fa-user-plus fa-fw"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>Name <i @click="sortByName" class="fa fa-sort fa-fw cursor-pointer text-blue"></i>
            </th>
            <th>Email</th>
            <th>Type <i @click="sortByType" class="fa fa-sort fa-fw cursor-pointer text-blue"></i></th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>
          <tr v-for="user in users.data" :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.usertype | capitalize }}</td>
            <td>{{user.created_at | myDate}}</td>
            <td>
              <a href="#" @click="editModal(user)">
                <i class="fa fa-wrench"></i>
              </a> /
              <a href="#" @click="deleteUser(user.id)">
                <i class="fa fa-trash text-red"></i>
              </a>
            </td>
          </tr>
        </tbody></table>
      </div>

      <div class="card-footer">
        <pagination :data="users" 
        @pagination-change-page="getResults"></pagination>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
              <!-- User Name -->
              <div class="form-group">
                <input v-model="form.name" type="text" name="name" id="name" placeholder="User name"
                class="form-control" :class="{'is-invalid': form.errors.has('name')}" >
                <has-error :form="form" field="name"></has-error>
              </div>
              <!-- User Email -->
              <div class="form-group">
                <input v-model="form.email" type="email" name="email" id="email" placeholder="Enter email"
                class="form-control" :class="{'is-invalid': form.errors.has('email')}" >
                <has-error :form="form" field="email"></has-error>
              </div>
              <!-- User Bio -->
              <div class="form-group">
                <textarea v-model="form.bio" name="bio" id="bio" placeholder="Enter Short Bio (Optional)"
                class="form-control" :class="{'is-invalid': form.errors.has('bio')}" ></textarea>
                <has-error :form="form" field="bio"></has-error>
              </div>
              <!-- User Type -->
              <div class="form-group">
                <select v-model="form.usertype" name="usertype" id="usertype"
                class="form-control" :class="{'is-invalid': form.errors.has('usertype')}">
                <option value="">Select User Role</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="user">User</option>
                </select>
                <has-error :form="form" field="usertype"></has-error>
              </div>
              <!-- User Password -->
              <div class="form-group">
                <input v-model="form.password" type="password" name="password" id="password"
                class="form-control" :class="{'is-invalid': form.errors.has('password')}" >
                <has-error :form="form" field="password"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</template>

<script>
    export default {
      data() {
        return {
          editmode: false,
          sortby: 'default',
          users : {},
          form: new Form({
            id: '',
            name: '',
            email: '',
            password: '',
            usertype: '',
            bio: '',
            photo: ''
          })
        }
      },
      methods: {
        getResults(page = 1) {
          if(this.sortby == 'name'){
            axios.get('api/usersbyname?page=' + page)
            .then(response => {
              this.users = response.data;
            });
            } else if(this.sortby == 'type') { 
            axios.get('api/usersbytype?page=' + page)
            .then(response => {
              this.users = response.data;
            });
            } else { 
            axios.get('api/user?page=' + page)
            .then(response => {
              this.users = response.data;
            });
          }
        },
        updateUser(id){
          this.$Progress.start();
          this.form.put('api/user/'+this.form.id)
          .then(() => {
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide');
            swal(
              'Updated!',
              'Information has been updated',
              'success',
            );
            this.$Progress.finish();
          })
          .catch(() => {
            this.$Progress.fail();
            swal('Oops!','Something went wrong.','warning')
          });
        },
        newModal(){
          this.editmode = false;
          this.form.reset();
          $('#addNew').modal('show');
        },
        editModal(user){
          this.editmode = true;
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(user);
        },
        deleteUser(id){
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if(result.value) {
              this.form.delete('api/user/'+id).then(() => {
                  swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                Fire.$emit('AfterCreate');
              }).catch(()=>{
                swal('Oops!','Something went wrong.','warning')
              });
            }
            //Send request to server

          })
        },
        fetchUsers(){
          axios.get("api/user")
          .then(({ data }) => (this.users = data))
        },
        sortByName(){
          this.sortby = 'name';
          axios.get("api/usersbyname")
          .then(({ data }) => (this.users = data))
        },
        sortByType(){
          this.sortby = 'type';
          axios.get("api/usersbytype")
          .then(({ data }) => (this.users = data))
        },
        createUser(){
          this.$Progress.start();
          this.form.post('api/user')
          .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide');

            toast({
              type: 'success',
              title: 'User Created Successfully'
            });
            this.$Progress.finish();
          })
          .catch(()=>{
            this.$Progress.fail();
          })
        },
      },
      created() {
        this.fetchUsers();
        Fire.$on('AfterCreate', () => {
          this.fetchUsers();
        });
      }
    }
</script>
