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
        <!-- view table -->
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-dark">
              <h3 class="card-title">Daftar Outlet</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                  >
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default navbar-teal">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Diperbarui</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="Outlet in outlet" :key="Outlet.id">
                    <td>{{Outlet.id}}</td>
                    <td>{{Outlet.nama_outlet}}</td>
                    <td>{{Outlet.alamat_outlet}}</td>
                    <td>{{Outlet.telp_outlet}}</td>
                    <td>{{Outlet.created_at}}</td>
                    <td>
                      <button
                        href="#"
                        @click="editOutlet(Outlet)"
                        type="button"
                        class="btn btn-success btn-sm"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                      <button
                        href="#"
                        @click="deleteOutlet(Outlet.id)"
                        type="button"
                        class="btn btn-danger btn-sm"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- Modal new -->

        <button type="button" class="btn btn-primary" @click="newModal()">Tambah Data</button>

        <!-- Modal -->
        <div
          class="modal fade"
          id="newModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="addNew"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="addNew">Data Outlet Baru</h5>
                <h5 class="modal-title" v-show="editmode" id="addNew">Ubah Data Outlet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateOutlet() : createOutlet()">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input
                      v-model="form.nama_outlet"
                      type="text"
                      name="nama_outlet"
                      placeholder="Masukan Nama Outlet"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('nama_outlet') }"
                    >
                    <has-error :form="form" field="nama_outlet"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea
                      v-model="form.alamat_outlet"
                      type="text"
                      name="alamat_outlet"
                      placeholder="Masukan Alamat"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('alamat_outlet') }"
                    ></textarea>
                    <has-error :form="form" field="alamat_outlet"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input
                      v-model="form.telp_outlet"
                      type="text"
                      name="telp_outlet"
                      placeholder="Masukan Nomor Telepon"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('telp_outlet') }"
                    >
                    <has-error :form="form" field="telp_outlet"></has-error>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                  <button v-show="editmode" type="submit" class="btn btn-success">Perbaru</button>
                  <button v-show="!editmode" type="submit" class="btn btn-success">Simpan</button>
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
      outlet: {},
      form: new Form({
        id: "",
        nama_outlet: "",
        alamat_outlet: "",
        telp_outlet: ""
      })
    };
  },
  methods: {
    loadOutlet() {
      axios.get("api/outlet").then(({ data }) => (this.outlet = data));
    },
    createOutlet() {
      this.$Progress.start();
      this.form
        .post("api/outlet")
        .then(() => {
          Fire.$emit("AferCreate");
          $("#newModal").modal("hide");
          toast.fire({
            type: "success",
            title: "Data Berhasil Disimpan"
          });
          this.$Progress.finish();
        })
        .catch(() => {});
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#newModal").modal("show");
    },
    updateOutlet() {
      this.$Progress.start();
      //console.log("edit data");
      this.form
        .put("api/outlet/" + this.form.id)
        .then(() => {
          // success
          Fire.$emit("AfterCreate");
          $("#newModal").modal("hide");
          swal.fire("Updated!", "Info telah terupdate.", "success");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editOutlet(Outlet) {
      this.editmode = true;
      this.form.reset();
      $("#newModal").modal("show");
      this.form.fill(Outlet);
    },
    deleteOutlet(id) {
      swal
        .fire({
          title: "Anda yakin?",
          text: "anda tidak akan dapat mengulangnya lagi",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "ya hapus"
        })
        .then(result => {
          // send request to the server
          if (result.value) {
            this.form
              .delete("api/outlet/" + id)
              .then(() => {
                swal.fire("deleted", "data anda terhapus", "success");
                Fire.$emit("AfterCreate");
              })
              .catch(() => {
                swal.fire("Failed", "ada yang salah", "warning");
              });
          }
        });
    }
  },
  created() {
    this.loadOutlet();
    //setInterval(() => this.loadOutlet(), 3000);
    Fire.$on("AfterCreate", () => {
      this.loadOutlet();
    });
  }
};
</script>
