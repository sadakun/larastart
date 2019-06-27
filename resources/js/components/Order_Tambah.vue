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
        <!-- upper table -->
        <div class="row mt-3">
          <!-- table1 -->
          <div class="col-md-4">
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input
                      type="date"
                      class="form-control"
                      id="exampleInputEmail1"
                      placeholder="Enter email"
                    >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kasir</label>
                    <input type="text" v-model="userauth.name" class="form-control" disabled>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
          <!-- table2-->
          <div class="col-md-4">
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="search">Cari Produk</label>
                    <div class="input-group">
                      <input v-model="cart.id" type="text" class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat" @click="newModal2">Go!</button>
                      </span>
                    </div>
                    <!-- /input-group -->

                    <!-- /.card-body -->
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input
                      v-model="cart.qty"
                      type="number"
                      class="form-control"
                      id="exampleInputPassword1"
                      placeholder="Jumlah"
                    >
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary" @click="addtocart">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- table3-->
          <div class="col-md-4">
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
              </form>
            </div>
          </div>
          <!-- end table -->
        </div>
        <!-- midle table -->
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                      </tr>

                      <tr v-for="Order in shoppingCart" :key="Order.id">
                        <td>{{Order.nama_produk}}</td>
                        <td>{{Order.qty}}</td>
                        <td>{{Order.harga_produk}}</td>
                        <td>{{Order.qty*Order.harga_produk}}</td>
                        <td>
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
              </div>
            </div>
          </div>
        </div>
        <!-- end midle table -->

        <!-- bottom table -->
        <div class="row mt-3">
          <!-- table1 -->
          <div class="col-md-3">
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Diskon</label>
                    <input
                      type="email"
                      class="form-control"
                      id="exampleInputEmail1"
                      placeholder="Enter email"
                    >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Total Harga</label>
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword1"
                      placeholder="Password"
                      disabled
                    >
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
          <!-- table2-->
          <div class="col-md-3">
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bayar</label>
                    <input
                      type="email"
                      class="form-control"
                      id="exampleInputEmail1"
                      placeholder="Enter email"
                    >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kembalian</label>
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword1"
                      placeholder="Password"
                    >
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
          <!-- table3-->

          <!-- table4-->
          <div class="col-md-3">
            <div class="card">
              <button type="button" class="btn btn-primary">Batal</button>
            </div>
            <div class="card">
              <button type="button" class="btn btn-primary">Proses</button>
            </div>
          </div>
        </div>
        <!-- end bottom table -->

        <!-- modal cari produk -->
        <div
          class="modal fade"
          id="newModal2"
          tabindex="-1"
          role="dialog"
          aria-labelledby="addNew"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="newModal2">Pilih</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Modify</th>
                    </tr>

                    <tr v-for="Produk in produk" :key="Produk.id">
                      <td>{{Produk.id}}</td>
                      <td>{{Produk.nama_produk}}</td>
                      <td>{{Produk.jenisBarang}}</td>
                      <td>{{Produk.harga_produk}}</td>
                      <td>
                        <button
                          href="#"
                          @click="selectProduk(Produk)"
                          type="button"
                          class="btn btn-success btn-sm"
                        >select</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- /.card-body -->
                <!-- /.card -->
              </div>
              <!-- modal cari produk -->
            </div>
          </div>
        </div>
        <!-- /modal proses transaksi -->
        <!-- button modal -->
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
      userauth: new Form({
        id: "",
        name: ""
      }),
      barang: new Form({
        id: "",
        nama_produk: "",
        id_jenisBarang: "",
        nama_produk: "",
        harga_produk: ""
      }),
      // menambahkan cart
      cart: new Form({
        id: "",
        qty: ""
      }),
      // untuk menampung list cart
      shoppingCart: [],
      submitCart: false,

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
    addtocart() {
      this.submitCart = true;
      //send data ke server
      axios
        .post("api/cart", this.cart)
        .then(response => {
          setTimeout(() => {
            // apabila berhasil, data disimpan ke dalam var shopping cart
            this.shoppingCart = response.data;

            //mengosongkan var
            this.cart.id = "";
            this.cart.qty = 1;
            this.barang = {
              id: "",
              nama_produk: "",
              id_jenisBarang: "",
              nama_produk: "",
              harga_produk: ""
            };
            $("#id").val("");
            this.submitCart = false;
          }, 2000).then;
        })
        .catch(error => {});
    },

    // mengambil list cart di cookie
    getCart() {
      // fetch data ke server
      axios.get("api/cart").then(response => {
        // data yang diterima disimpan ke dalam  var shopping cart
        this.shoppingCart = response.data;
      });
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
    loaduserauth() {
      axios.get("api/profile").then(({ data }) => this.userauth.fill(data));
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
    newModal2() {
      this.editmode = false;
      this.form.reset();
      $("#newModal2").modal("show");
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
    selectProduk(Produk) {
      this.editmode = true;
      $("#newModal2").modal("hide");
      this.cart.fill(Produk);
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
    this.loadProduk();
    this.getCart();
    this.loaduserauth();
    //setInterval(() => this.loadOutlet(), 3000);
    Fire.$on("AfterCreate", () => {
      this.loadProduk();
      this.getCart();
      this.userauth();
    });
  }
};
</script>
