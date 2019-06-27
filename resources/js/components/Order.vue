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
        <!-- view table cari produk -->
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <!-- /.card-header -->
            <div class="card-header bg-dark">
              <h3 class="card-title">Daftar Transaksi</h3>
              <div class="card-tools">
                <div
                  class="input-group input-group-sm"
                  @keyup.enter="searchDetail()"
                  style="width: 150px;"
                >
                  <input
                    v-model="search"
                    type="search"
                    name="search"
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
                    <th>ID Transaksi</th>
                    <th>ID Karyawan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Cabang</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="Order in penjualan" :key="Order.id">
                    <td>{{Order.id}}</td>
                    <td>{{Order.id_user}}</td>
                    <td>{{Order.tgl_penjualan}}</td>
                    <td>{{Order.nama_outlet}}</td>
                    <td>{{Order.total}}</td>
                    <td>{{Order.bayar}}</td>
                    <td>{{Order.kembalian}}</td>
                    <td>
                      <a href="#">Detail</a>
                      <a href="#" @click="deleteOrder(Order.id)">
                        <i class="fa fa-trash"></i>
                      </a>
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

        <!-- button modal -->
        <router-link to="/order_tambah" class="nav-link float-right">
          <button type="button" class="btn btn-primary" @click="tambahTransaksi()">Tambah Data</button>
        </router-link>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nama_outlet: {},
      penjualan: {},
      search: "",
      form: new Form({
        id: "",
        id_user: "",
        id_outlet: "",
        tgl_penjualan: "",
        total: "",
        bayar: "",
        kembalian: ""
      })
    };
  },
  methods: {
    loadOrder() {
      axios
        .get("api/tampil_detail_penjualan ")
        .then(({ data }) => (this.penjualan = data.detail_penjualan));
    },

    searchDetail() {
      let query = this.search;
      axios
        .get("api/cariProduk?q=" + query)
        .then(data => {
          this.penjualan = data.data;
        })
        .catch(() => {});
    },
    loadProduk() {
      axios
        .get("api/outlet")
        .then(({ data }) => (this.nama_outlet = data.outlet));
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
              .delete("api/penjualan/" + id)
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
