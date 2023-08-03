<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="{{ \URL::to('/') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript"
        src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=z8F21xyjCVnc-o8P_Dcl__EAciQKYCLYt2n2Tv1yIlRz4WtoKp7PZh2V_Gea-ekCHZxWCrOPboYsHlRDIGIVHp3zfeGVTRYQBKlk-OTp3rk"
        charset="UTF-8"></script>
</head>
<style>
    .btn-custom {
        background-color: #6777ef;
        /* Remplacez par votre couleur personnalisée */
        color: #ffffff;
        /* Couleur du texte */
        /* Ajoutez d'autres styles personnalisés si nécessaire */
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{ route('home') }}" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="{{ route('home') }}">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar  elevation-4" style="background: #ffffff">
            <!-- Brand Logo -->
            {{-- <a href="{{ route('home') }}" class="brand-link">
                <img src="logo.png" alt="Yancom creation" class="brand-image img-circle elevation-3"
                    style="opacity: .8;background:white">
                <span class="brand-text font-weight-light">Store</span>
            </a> --}}
            <style>
                .dashboard-title {
                    font-size: 32px;
                    font-weight: bold;
                    color: #003b7a;
                    font-family: 'Roboto', sans-serif;

                }
            </style>
            <div class="sidebar-brand">
                <a href="{{ route('home') }}"> <img alt="image" src="logo.png" class="header-logo"> <span
                        class="logo-name dashboard-title">STORE</span>
                </a>
            </div>
            <style>
                .sidebar li.menu-header {
                    padding: 3px 15px;
                    color: #868e96;
                    font-size: 15px;
                    text-transform: uppercase;
                    letter-spacing: 1.3px;
                    font-weight: 600;
                }

                .main-sidebar .sidebar-brand a .logo-name {
                    vertical-align: middle;
                    font-size: 20px;
                }

                .main-sidebar .sidebar-brand a .header-logo {
                    height: 30px;
                }

                .main-sidebar .sidebar-brand {
                    display: inline-block;
                    width: 100%;
                    text-align: center;
                    height: 70px;
                    line-height: 70px;
                }
            </style>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                {{-- <li class="menu-header row align-items-center">

                    <div class="col">
                        Admin
                    </div>
                </li> --}}

                {{-- <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                                    <rect x="2" y="3" width="20" height="14"
                                        rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                                <p class="ml-2">
                                    Accueil
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des Catégories</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('produits.create') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Produits
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('produits.create') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des Produits</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('factures.create') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Factures
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('factures.create') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des factures</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('commandes.create') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Commandes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('commandes.create') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des commandes</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('clients') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Clients
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('clients') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des clients</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6">
                                    </line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Ressources humaines
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.roles.permissions') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gérer les employés</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modifier un role</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6">
                                    </line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('roles.store') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gestion des roles</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modifier un role</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('permissions.manage') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p class="ml-2">
                                    Permissions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('permissions.store') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Gestion des permissions</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="ml-2">Modifier une permission</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>




                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    gestion des roles

                                </p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i class="fas fa-sign-out-alt"></i></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Analytics business</a></li>
                                <li class="breadcrumb-item active">Events</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid --> --}}
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023<a href="https://www.yancom-creation.com/">YancomCreation</a>.</strong> All
            rights
            reserved.
        </footer>
    </div>

    @yield('scripts')


    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('existingSubcategoryBtn{{ $category->id }}').addEventListener('click',
                function() {
                    document.getElementById('existingSubcategoryGroup{{ $category->id }}').style.display =
                        'block';
                    document.getElementById('newSubcategoryGroup{{ $category->id }}').style.display = 'none';
                });

            document.getElementById('newSubcategoryBtn{{ $category->id }}').addEventListener('click', function() {
                document.getElementById('existingSubcategoryGroup{{ $category->id }}').style.display =
                    'none';
                document.getElementById('newSubcategoryGroup{{ $category->id }}').style.display = 'block';
            });
        });
    </script> 
    processuss de page commande --}}

    {{-- recuperer l id de la commande  --}}


    <script>
        $(document).ready(function() {
            $('.open-detail-modal').click(function(e) {
                e.preventDefault();
                $('#detailModal').modal('show');
            });
        });
    </script>
    {{-- recuperer les commandes produits --}}
    <script>
        $(document).ready(function() {
            $('.open-detail-modal').click(function(e) {
                e.preventDefault();
                var details = $(this).data('details');
                var productDetailsBody = $('#productDetailsBody');

                // Effacez le contenu précédent du modal
                productDetailsBody.empty();

                // Variables pour le total et le sous-total
                var total = 0;
                var subtotal;

                // Parcourez les détails des produits et ajoutez-les à la table
                $.each(details, function(index, produit) {
                    var imagePath = 'http://127.0.0.1:8000/storage/' + produit.Image;
                    subtotal = produit.Prix * produit.pivot.quantite;
                    total += subtotal;

                    var row = '<tr>' +
                        '<td>' + produit.nomproduit + '</td>' +
                        '<td><img src="' + imagePath + '" alt="' + produit.nomproduit +
                        '" width="100"></td>' +
                        '<td>' + produit.Prix + '</td>' +
                        '<td>' + produit.pivot.quantite + '</td>' +
                        '<td>' + subtotal + '</td>' +
                        '</tr>';

                    productDetailsBody.append(row);
                });

                // Ajoutez la ligne du total
                var totalRow = '<tr>' +
                    '<td colspan="4" align="right">Total</td>' +
                    '<td>' + total + '</td>' +
                    '</tr>';

                productDetailsBody.append(totalRow);

                // Affichez le modal
                $('#detailModal').modal('show');
            });
        });
    </script>
    {{-- changer l etat de la commande --}}

    <script>
        $(document).ready(function() {
            // Écoutez les changements de sélection de la catégorie
            // Écoutez les changements de sélection de la catégorie
            $('#listCat').change(function() {
                var categorieId = $(this).val();

                // Réinitialiser les champs de sous-catégorie et de produit
                $('#listSubCat').empty().prop('disabled', true).append(
                    '<option value="">Choisissez</option>');
                $('#listProduct').empty().prop('disabled', true).append(
                    '<option value="">Choisissez</option>');
                $('#quantityRow').hide();

                // Effectuer une requête AJAX pour récupérer les sous-catégories associées à la catégorie sélectionnée
                $.ajax({
                    url: '/getSubCategories/' + categorieId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Remplir le dropdown des sous-catégories avec les résultats
                        if (response.length > 0) {
                            $.each(response, function(index, subCat) {
                                $('#listSubCat').append('<option value="' + subCat.id +
                                    '">' + subCat.nom_souscategorie + '</option>');
                            });
                            // Activer le champ de sous-catégorie
                            $('#listSubCat').prop('disabled', false);
                        }
                    }
                });
            });

            // Écoutez les changements de sélection de la sous-catégorie

            $('#listSubCat').change(function() {
                var subCategorieId = $(this).val();

                // Réinitialiser le champ de produit
                $('#listProduct').empty().prop('disabled', true).append(
                    '<option value="">Choisissez</option>');
                $('#quantityRow').hide();

                // Effectuer une requête AJAX pour récupérer les produits associés à la sous-catégorie sélectionnée
                $.ajax({
                    url: '/getProducts/' + subCategorieId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Remplir le dropdown des produits avec les résultats
                        if (response.length > 0) {
                            $.each(response, function(index, product) {
                                $('#listProduct').append('<option value="' + product
                                    .id + '">' + product.nomproduit + '</option>');
                            });
                            // Activer le champ de produit
                            $('#listProduct').prop('disabled', false);
                        }
                    }
                });
            });

            // Écoutez les changements de sélection du produit
            $('#listProduct').change(function() {
                // Réinitialiser les champs de quantité
                $('#quantityRow').empty();

                // Récupérer les produits sélectionnés
                var selectedProducts = $(this).val();

                // Générer les champs de quantité pour chaque produit sélectionné
                $.each(selectedProducts, function(index, produitId) {
                    // Effectuer une requête AJAX pour récupérer la quantité disponible du produit sélectionné
                    $.ajax({
                        url: '/getProductQuantity/' + produitId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.quantity > 0) {
                                // Générer le champ de quantité pour le produit
                                var quantityField =
                                    '<div class="form-group col-md-6">' +
                                    '<label>Quantité pour ' + response.product +
                                    '</label>' +
                                    '<input type="number" class="form-control" name="quantite[]" min="1" aria-invalid="false">' +
                                    '</div>';

                                // Ajouter le champ de quantité à la ligne des quantités
                                $('#quantityRow').append(quantityField);
                            } else {
                                alert('Le produit ' + response.product +
                                    ' est en rupture de stock.');
                            }
                        }
                    });
                });

                // Afficher la ligne des quantités
                $('#quantityRow').show();
            });
        });
    </script>

    <script>
        function toggleFormFieldsCommande(type) {
            if (type === 'existant') {
                document.getElementById('champs_client_existant').style.display = 'block';
                document.getElementById('champs_nouveau_client').style.display = 'none';
            } else if (type === 'nouveau') {
                document.getElementById('champs_client_existant').style.display = 'none';
                document.getElementById('champs_nouveau_client').style.display = 'block';
            } else {
                document.getElementById('champs_client_existant').style.display = 'none';
                document.getElementById('champs_nouveau_client').style.display = 'none';
            }
        }
    </script>
    {{-- recuperer le detail de la commande --}}



    {{-- end --}}
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif

        // Autres options de configuration Toastr
        toastr.options = {
            "positionClass": "toast-top-right", // Position du toast
            // Autres options de personnalisation
        };
    </script>

    <script>
        $(document).ready(function() {
            $('#typeFacture').change(function() {
                var selectedType = $(this).val();

                if (selectedType === 'nouveau_produit') {
                    $('#nouveauProduitFields').show();
                    $('#produitExistantFields').hide();
                } else if (selectedType === 'produit_existant') {
                    $('#nouveauProduitFields').hide();
                    $('#produitExistantFields').show();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: true,
                closeOnSelect: false,
                templateSelection: function(data, container) {
                    if ($(data.element).is('option') && data.text !== '') {
                        $(data.element).attr('selected', 'selected');
                        $(data.element).addClass('selected');
                    }
                    return data.text;
                },
                templateResult: function(data) {
                    if ($(data.element).is('option') && data.text !== '') {
                        return $('<div class="selected">' + data.text + '</div>');
                    }
                    return data.text;
                }
            });
        });
    </script>
    <script>
        function toggleFormFields(type) {
            var champsProduitExistant = document.getElementById('champs_produit_existant');
            var champsNouveauProduit = document.getElementById('champs_nouveau_produit');

            if (type === 'existant') {
                champsProduitExistant.style.display = 'block';
                champsNouveauProduit.style.display = 'none';
            } else if (type === 'nouveau') {
                champsProduitExistant.style.display = 'none';
                champsNouveauProduit.style.display = 'block';
            } else {
                champsProduitExistant.style.display = 'none';
                champsNouveauProduit.style.display = 'none';
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var successAlert = $('.alert-success');
            if (successAlert.length) {
                setTimeout(function() {
                    successAlert.remove();
                }, 5000);
            }
        });
    </script>


    <!-- Code injected by live-server -->
    <script>
        // Récupérer tous les liens du menu
        const menuLinks = document.querySelectorAll('.nav-link');

        // Ajouter un gestionnaire d'événement pour chaque lien
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Supprimer la classe "active" de tous les liens
                menuLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Ajouter la classe "active" uniquement au lien cliqué
                this.classList.add('active');
            });
        });
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
    @stack('scripts')
</body>

</html>
