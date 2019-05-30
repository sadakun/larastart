import Outlet from './components/Outlet.vue'
import Produk from './components/Produk.vue'
import Order from './components/Order.vue'
import Profile from './components/Profile.vue'
import Users from './components/Users.vue'

export let routes = [{
    path: '/outlet',
    component: Outlet
}, {
    path: '/produk',
    component: Produk
}, {
    path: '/detail_penjualan',
    component: Order
}, {
    path: '/profile',
    component: Profile
}, {
    path: '/user',
    component: Users
}]
