<template>
  <div class="content-wrapper" style="min-height: 1115.31px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Daftar Pengguna</h3>

                <div class="card-tools">
                  <button class="btn btn-success navbar-teal" @click="newModal">
                    Add
                    <i class="fas fa-user-plus fa-fw"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Tanggal Terdaftar</th>
                      <th>Modify</th>
                    </tr>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.role | upText}}</td>
                      <td>{{user.created_at | myDate}}</td>

                      <td>
                        <a href="#" @click="editModal(user)">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div
          class="modal fade"
          id="addNew"
          tabindex="-1"
          role="dialog"
          aria-labelledby="addNewLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Pengguna Baru</h5>
                <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      placeholder="Nama lengkap"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      placeholder="user@mail.com"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                    >
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea
                      v-model="form.alamat"
                      name="alamat"
                      id="alamat"
                      placeholder="Alamat domisili"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('alamat') }"
                    ></textarea>
                    <has-error :form="form" field="alamat"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Pengguna</label>
                    <select
                      name="role"
                      v-model="form.role"
                      id="role"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('role') }"
                    >
                      <option value>Select User Role</option>
                      <option value="admin">Admin</option>
                      <option value="karyawan">Karyawan</option>
                    </select>
                    <has-error :form="form" field="type"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Sandi</label>
                    <input
                      v-model="form.password"
                      type="password"
                      name="password"
                      id="password"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('password') }"
                    >
                    <has-error :form="form" field="password"></has-error>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                  <button v-show="editmode" type="submit" class="btn btn-success">Perbarui</button>
                  <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        alamat: "",
        password: "",
        role: "",
        photo: ""
      })
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get("api/user?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          // success
          $("#addNew").modal("hide");
          swal("Updated!", "Information has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    deleteUser(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          // Send request to the server
          if (result.value) {
            this.form
              .delete("api/user/" + id)
              .then(() => {
                swal.fire("Deleted!", "Your file has been deleted.", "success");
                Fire.$emit("AfterCreate");
              })
              .catch(() => {
                swal.fire("Failed!", "There was something wronge.", "warning");
              });
          }
        });
    },
    loadUsers() {
      axios.get("api/user").then(({ data }) => (this.users = data));
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "User Created in successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {});
    }
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.$parent.search;
      axios
        .get("api/findUser?q=" + query)
        .then(data => {
          this.users = data.data;
        })
        .catch(() => {});
    });
    this.loadUsers();
    Fire.$on("AfterCreate", () => {
      this.loadUsers();
    });
    //    setInterval(() => this.loadUsers(), 3000);
  }
};
</script>