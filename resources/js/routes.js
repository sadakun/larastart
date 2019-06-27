import Outlet from './components/Outlet.vue'
import Produk from './components/Produk.vue'
import Order from './components/Order.vue'
import Order_Detail from './components/Order_Detail.vue'
import Order_Tambah from './components/Order_Tambah.vue'
import Profile from './components/Profile.vue'
import Users from './components/Users.vue'
import Developer from './components/Developer.vue'

export let routes = [{
    path: '/outlet',
    component: Outlet
}, {
    path: '/produk',
    component: Produk
}, {
    path: '/penjualan',
    component: Order
}, {
    path: '/order_detail',
    component: Order_Detail
}, {
    path: '/order_tambah',
    name: 'order_tambah',
    component: Order_Tambah
}, {
    path: '/profile',
    component: Profile
}, {
    path: '/user',
    component: Users
}, {
    path: '/developer',
    component: Developer

}]
