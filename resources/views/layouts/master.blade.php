<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SuksesAquarium | Starter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="sidebar-mini" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar  navbar-expand  border-bottom navbar-cyan navbar-dark  ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 1230.3px;">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="./img/logo.png" alt="SITUA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Sukses Aquarium</span>
            </a>
            <!-- /.Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{Auth::user()->name}}
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        @can('isAdmin')

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>
                                    Kelola Toko
                                    <i class=" right fas fa-wrench"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/outlet" class="nav-link ">
                                        <i class="fas fa-store nav-icon"></i>
                                        <p>Outlet</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/produk" class="nav-link ">
                                        <i class="fas fa-fish nav-icon"></i>
                                        <p>Produk</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/user" class="nav-link ">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Pengunna</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <router-link to="/penjualan" class="nav-link ">
                                <i class="nav-icon fas fa-cash-register "></i>
                                <p>Transaksi</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/profile" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Profil</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/developer" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>developer</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    {{ __('Logout') }}
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->

    </footer>
    </div>
    <!-- ./wrapper -->
    <script src="/js/app.js"></script>
</body>

</html>