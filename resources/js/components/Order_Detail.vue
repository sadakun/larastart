<template>
  <div class="content-wrapper" style="min-height: 1115.31px;">
    <section class="content">
      <div class="container-fluid">
        <!-- view table cari produk -->
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Penjualan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Nama Produk</th>
                    <th style="width:100px">Jumlah Produk</th>
                    <th>Harga Satuan</th>
                    <th>Sub Total</th>
                  </tr>

                  <tr v-for="Order in detail_penjualan" :key="Order.id">
                    <td>{{Order.nama_produk}}</td>
                    <td>
                      <div class="form-group">
                        <input
                          v-model="form.jumlah_barang "
                          type="number"
                          min="1"
                          placeholder="1"
                          name="jumlah_barang"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('jumlah_barang') }"
                        >
                        <has-error :form="form" field="jumlah_barang"></has-error>
                      </div>
                    </td>
                    <td>{{Order.harga_produk}}</td>
                    <td>{{form.jumlah_barang*Order.harga_produk}}</td>
                    <td>{{Order.kembalian}}</td>
                    <td>
                      <button
                        href="#"
                        @click="editOrder(Order)"
                        type="button"
                        class="btn btn-success btn-sm"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                      <button
                        href="#"
                        @click="deleteOrder(Order.id)"
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

        <!-- modal tambah data -->
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
              <form @submit.prevent="editmode ? updateOrder() : createOrder()">
                <div class="modal-body">
                  <div class="form-group">
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

        <!-- button modal -->
        <button type="button" class="btn btn-primary" @click="newModal()">Tambah Data</button>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      produk: {},
      jenisBarang: {},
      detail_penjualan: {},
      search: "",
      form: new Form({
        id: "",
        nama_produk: "",
        id_jenisBarang: "",
        jumlah_barang: "",
        harga_produk: "",
        sub_total: "",
        kembalian: ""
      })
    };
  },
  methods: {
    loadOrder() {
      axios
        .get("api/detail_penjualan")
        .then(({ data }) => (this.detail_penjualan = data.sub_total));
    },
    searchDetail() {
      let query = this.search;
      axios
        .get("api/cariProduk?q=" + query)
        .then(data => {
          this.produk = data.data;
        })
        .catch(() => {});
    },
    loadProduk() {
      axios
        .get("api/produk")
        .then(({ data }) => (this.produk = data.nama_produk));
    },
    createOrder() {
      this.$Progress.start();
      this.form
        .post("api/detail_penjualan")
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
    createDetailOrder() {
      this.$Progress.start();
      this.produk
        .post("api/detail_penjualan")
        .then(() => {
          Fire.$emit("AferCreate");
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
    updateOrder() {
      this.$Progress.start();
      //console.log("edit data");
      this.form
        .put("api/detail_penjualan/" + this.form.id)
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
    editOrder(Order) {
      this.editmode = true;
      this.form.reset();
      $("#newModal").modal("show");
      this.form.fill(Order);
    },
    deleteOrder(id) {
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
              .delete("api/detail_penjualan/" + id)
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
    Fire.$on("searching", () => {});
    this.loadOrder();
    this.loadProduk();
    //setInterval(() => this.loadOutlet(), 3000);
    Fire.$on("AfterCreate", () => {
      this.loadOrder();
      this.loadProduk();
    });
  }
};
</script>
