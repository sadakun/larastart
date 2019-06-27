<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 200px !important;
}
.widget-user .card-footer {
  padding: 0;
}
</style>


<template>
  <div class="content-wrapper" style="min-height: 1115.31px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- col -->
          <div class="col-md-3">
            <!-- profile pic -->
            <div class="car card-primary card-outline">
              <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div
                  class="widget-user-header text-white"
                  style="background-image:url('./img/user-cover.png')"
                >
                  <h3 class="widget-user-username">{{this.form.name}}</h3>
                  <h5 class="widget-user-desc">{{this.form.role}}</h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                </div>
              </div>
            </div>
            <!-- about -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong>
                  <i class="fas fa-book mr-1"></i> Education
                </strong>
                <p
                  class="text-muted"
                >B.S. in Computer Science from the University of Tennessee at Knoxville</p>
                <hr>
                <strong>
                  <i class="fas fa-map-marker-alt mr-1"></i> Location
                </strong>
                <p class="text-muted">Malibu, California</p>
                <hr>
                <strong>
                  <i class="fas fa-pencil-alt mr-1"></i> Skills
                </strong>
                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
                <strong>
                  <i class="far fa-file-alt mr-1"></i> Notes
                </strong>
                <p
                  class="text-muted"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          <!-- col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- Activity Tab -->
                  <div class="tab-pane" id="activity">
                    <h3 class="text-center">Display User Activity</h3>
                  </div>
                  <!-- Setting Tab -->
                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>

                        <div class="col-sm-12">
                          <input
                            type
                            v-model="form.name"
                            class="form-control"
                            id="inputName"
                            placeholder="Nama Lengkap"
                            :class="{ 'is-invalid': form.errors.has('name') }"
                          >
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-12">
                          <input
                            type="email"
                            v-model="form.email"
                            class="form-control"
                            id="inputEmail"
                            placeholder="Email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                          >
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="Alamat" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-12">
                          <textarea
                            v-model="form.alamat"
                            class="form-control"
                            id="inputAlamat"
                            :class="{ 'is-invalid': form.errors.has('alamat') }"
                          ></textarea>
                          <has-error :form="form" field="alamat"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputNoTelp" class="col-sm-2 control-label">Nomor Telepon</label>

                        <div class="col-sm-12">
                          <input
                            v-model="form.no_telp"
                            class="form-control"
                            id="inputNoTelp"
                            :class="{ 'is-invalid': form.errors.has('no_telp') }"
                          >
                          <has-error :form="form" field="no_telp"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                          <input
                            type="file"
                            @change="updateProfile"
                            name="photo"
                            class="form-input"
                          >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="col-sm-12 control-label">Password</label>

                        <div class="col-sm-12">
                          <input
                            type="password"
                            v-model="form.password"
                            class="form-control"
                            id="password"
                            placeholder="Password"
                            :class="{ 'is-invalid': form.errors.has('password') }"
                          >
                          <has-error :form="form" field="password"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                          <button
                            @click.prevent="updateInfo"
                            type="submit"
                            class="btn btn-success"
                          >Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
      </div>
    </section>
  </div>
</template>



<script>
export default {
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        role: "",
        alamat: "",
        no_telp: "",
        photo: ""
      })
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    getProfilePhoto() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "img/profile/" + this.form.photo;
      return photo;
    },
    updateInfo() {
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .put("api/profile")
        .then(() => {
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateProfile(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      let limit = 1024 * 1024 * 2;
      if (file["size"] > limit) {
        swal({
          type: "error",
          title: "Oops...",
          text: "You are uploading a large file"
        });
        return false;
      }
      reader.onloadend = file => {
        this.form.photo = reader.result;
      };
      reader.readAsDataURL(file);
    }
  },
  created() {
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
  }
};
</script>