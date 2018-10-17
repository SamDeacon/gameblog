<template>
<div class="justify-content-center">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Consoles</h3>

        <div class="card-tools">
          <button class="btn btn-success" @click="newModal">Add New <i class="fa fa-plus-circle fa-fw" ></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>Name</th>
            <th>Manufacturer</th>
            <th>Release<br/>
            (PAL)</th>
            <th>Release<br/>
            (NA)</th>
            <th>Modify</th>
          </tr>
            <tr v-for="console in consoles.data" :key="console.id">
            <td>{{console.id}}</td>
            <td>{{console.name}}</td>
            <td>{{console.manufacturer | capitalize }}</td>
            <td>{{console.pal_release_date | releaseDate}}</td>
            <td>{{console.pal_release_date | releaseDate}}</td>
            <td>
              <a href="#" >
                <i class="fa fa-wrench" @click="editModal(console)"></i>
              </a> /
              <a href="#" @click="deleteConsole(console.id)">
                <i class="fa fa-trash text-red"></i>
              </a>
            </td>
          </tr>
        </tbody></table>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add Console</h5>
                <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update Console details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateConsole() : createConsole()">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" id="name" placeholder="Console Title"
                        class="form-control" :class="{'is-invalid': form.errors.has('name')}" >
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.slug" type="text" name="slug" id="slug" placeholder="slug"
                        class="form-control" :class="{'is-invalid': form.errors.has('slug')}" disabled>
                        <has-error :form="form" field="slug"></has-error>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.description" name="description" id="description" placeholder="Enter short description (Optional)"
                        class="form-control" :class="{'is-invalid': form.errors.has('description')}" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="form-group">
                        <select v-model="form.manufacturer" name="manufacturer" id="manufacturer"
                        class="form-control" :class="{'is-invalid': form.errors.has('manufacturer')}">
                            <option value="">Select Manufacturer</option>
                            <option value="SEGA">SEGA</option>
                            <option value="Nintendo">Nintendo</option>
                            <option value="Sony">Sony</option>
                            <option value="Microsoft">Microsoft</option>
                            <option value="Atari">Atari</option>
                            <option value="NA">N/A</option>
                        </select>
                        <has-error :form="form" field="manufacturer"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.thumbnail" type="text" name="thumbnail" id="thumbnail" placeholder="thumbnail"
                        class="form-control" :class="{'is-invalid': form.errors.has('thumbnail')}">
                        <has-error :form="form" field="thumbnail"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="pal_release_date">Release Date (PAL)</label>
                        <input id="pal_release_date" width="270" v-model="form.pal_release_date" type="date" name="pal_release_date"  placeholder="pal_release_date"
                        class="form-control" :class="{'is-invalid': form.errors.has('pal_release_date')}">
                        <has-error :form="form" field="pal_release_date"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="na_release_date">Release Date (NA)</label>
                        <input id="na_release_date" width="270" v-model="form.na_release_date" type="date" name="na_release_date"  placeholder="na_release_date"
                        class="form-control" :class="{'is-invalid': form.errors.has('na_release_date')}">
                        <has-error :form="form" field="na_release_date"></has-error>
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
    <!-- /.card -->
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                storedslug: '',
                consoles : {},
                form: new Form({
                    id: '',
                    name:  '',
                    slug:  '',
                    description:  '',
                    manufacturer:  '',
                    thumbnail:  '',
                    pal_release_date:  '',
                    na_release_date:  '',
                })
            }
        },
        methods: {
            updateConsole(id){
                this.$Progress.start();
                this.form.put('/admin/api/console/'+this.form.id)
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
            editModal(console){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(console);
            },
            deleteConsole(id){
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
                    this.form.delete('/admin/api/console/'+id).then(() => {
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
            fetchConsoles(){
                axios.get("/admin/api/console").then(({ data }) => (this.consoles = data))
            },
            createConsole(){
                this.$Progress.start();
                this.form.post('/admin/api/console')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast({
                    type: 'success',
                    title: 'Console Successfully Added'
                    });
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                })
            },
        },
        created() {
            this.fetchConsoles();
            Fire.$on('AfterCreate', () => {
                this.fetchConsoles();
            });
        }
    }
</script>