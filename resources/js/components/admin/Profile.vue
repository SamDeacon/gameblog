<style>
.widget-user .widget-user-header{
  background-position: center 90%;
  background-size: cover;
  height: 200px;
}
.widget-user .card-footer {

padding: 10px;
}
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image: url(/img/admin/profile-bg.jpg);">
                <h3 class="widget-user-username">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- Activity Tab -->
                  <div class="tab-pane" id="activity">
                      <h3 class="text-center">Display User Activity</h3>
                  </div>
                  <!-- Settings Tab -->
                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name')}">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                          <div class="col-sm-12">
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email')}">
                            <has-error :form="form" field="email"></has-error>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 control-label">Bio</label>

                          <div class="col-sm-12">
                          <textarea  class="form-control" v-model="form.bio" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio')}"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                          <p class="control-label">
                            current photo name is:<br>

                            {{ form.photo }}
                          </p>

                          <div class="col-sm-12">
                              <input @change="updateProfile" type="file" name="photo" class="form-input" >
                          </div>

                      </div>

                        <div class="form-group">
                            <label for="password"  class="col-sm-12 control-label">Password (leave empty if not changing)</label>

                            <div class="col-sm-12">
                              <input type="password"
                              v-model="form.password"
                              class="form-control"
                              id="password"
                              :class="{ 'is-invalid': form.errors.has('password')}">
                              <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12">
                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          </div>
    </div>
</template>

<script>
    export default {
      data(){
        return {
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
        mounted() {

        },

        methods:{
          getProfilePhoto(){
            let photo = (this.form.photo.length > 75) ? this.form.photo : "/img/profile/"+this.form.photo ;

            return photo;
          },
          updateInfo(){
            this.$Progress.start();
            this.form.put('api/profile/')
            .then(() =>{
              this.$Progress.finish();
              Fire.$emit('AfterChange');
            })
            .catch(() =>{
              this.$Progress.fail();
            })
          },
          updateProfile(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 2111775){
              console.log (reader.result);
              reader.onloadend = (file) => {
                this.form.photo = reader.result;
              }
              reader.readAsDataURL(file);
            } else {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'The file selected is over 2mb, please select another or resize the image',
              })
            }
          }
        },
        created() {

          axios.get("api/profile")
          .then(({ data }) => (this.form.fill(data)));

          Fire.$on('AfterChange', () => {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
          });

        }
    }
</script>
