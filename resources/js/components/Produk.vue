<template>
  <div class="container">
    <!-- view table -->
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Produk Sukses Aquarium</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input
                type="text"
                name="table_search"
                class="form-control float-right"
                placeholder="Search"
              >
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
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
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Diperbarui</th>
                <th>Modify</th>
              </tr>

              <tr v-for="Produk in produk" :key="Produk.id">
                <td>{{Produk.id}}</td>
                <td>{{Produk.nama_produk}}</td>
                <td>{{Produk.jenisBarang}}</td>
                <td>{{Produk.harga_produk}}</td>

                <td>{{Produk.created_at}}</td>

                <td>
                  <button
                    href="#"
                    @click="editProduk(Produk)"
                    type="button"
                    class="btn btn-success btn-sm"
                  >
                    <i class="fa fa-edit"></i>
                  </button>
                  <button
                    href="#"
                    @click="deleteProduk(Produk.id)"
                    type="button"
                    class="btn btn-danger btn-sm"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- /.card-body -->
          <!-- /.card -->
        </div>
        <!-- Modal new -->
      </div>
    </div>
    <!-- Button trigger modal -->
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
            <h5 class="modal-title" v-show="!editmode" id="addNew">Data Produk Baru</h5>
            <h5 class="modal-title" v-show="editmode" id="addNew">Ubah Data Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateProduk() : createProduk()">
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Produk</label>
                <input
                  v-model="form.nama_produk"
                  type="text"
                  name="nama_produk"
                  placeholder="Masukan Nama Produk"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('nama_produk') }"
                >
                <has-error :form="form" field="nama_produk"></has-error>
              </div>

              <div class="form-group">
                <label>Kategori</label>
                <select
                  v-model="form.id_jenisBarang"
                  type="id_jenisBarang"
                  name="id_jenisBarang"
                  placeholder="Pilih Jenis barang"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('id_jenisBarang') }"
                >
                  <option value disabled selected>Pilih jenis barang</option>
                  <option
                    :value="jenis.id"
                    v-for="jenis in jenisBarang"
                    :key="jenis.id"
                  >{{jenis.jenisBarang}}</option>
                  <has-error :form="form" field="id_jenisBarang"></has-error>
                </select>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input
                  v-model="form.harga_produk"
                  type="harga_produk"
                  name="harga_produk"
                  placeholder="Masukan Harga Produk"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('harga_produk') }"
                >
                <has-error :form="form" field="harga_produk"></has-error>
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
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      produk: {},
      jenisBarang: {},
      form: new Form({
        id: "",
        nama_produk: "",
        id_jenisBarang: "",
        harga_produk: ""
      })
    };
  },
  methods: {
    loadProduk() {
      axios
        .get("api/produk")
        .then(({ data }) => (this.produk = data.nama_produk));
    },
    loadJenisBarang() {
      axios
        .get("api/jenis_barang")
        .then(({ data }) => (this.jenisBarang = data.jenis_barang));
    },
    createProduk() {
      this.$Progress.start();
      this.form
        .post("api/produk")
        .then(() => {
          $("#newModal").modal("hide");
          toast.fire({
            type: "success",
            title: "Data Berhasil Disimpan"
          });

          this.$Progress.finish();
          Fire.$emit("AferCreate");
        })
        .catch(() => {});
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#newModal").modal("show");
    },
    updateProduk() {
      this.$Progress.start();
      //console.log("edit data");
      this.form
        .put("api/produk/" + this.form.id)
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
    editProduk(Produk) {
      this.editmode = true;
      this.form.reset();
      $("#newModal").modal("show");
      this.form.fill(Produk);
    },
    deleteProduk(id) {
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
              .delete("api/produk/" + id)
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
    this.loadProduk();
    this.loadJenisBarang();
    //setInterval(() => this.loadOutlet(), 3000);
    Fire.$on("AfterCreate", () => {
      this.loadProduk();
      this.loadJenisBarang();
    });
  }
};
</script>
