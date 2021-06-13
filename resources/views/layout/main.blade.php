<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        
                      
                        <li class="nav-item dropdown">
                          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" class="nav-link dropdown-toggle">Data Management</a>
                          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item">
                                 <a href="{{ route('master.users') }}" class="nav-link">Management Users</a>
                              </li>
                              <li class="dropdown-item">
                                <a href="{{ route('master.prodi') }}" class="nav-link">Management Prodi</a>
                              </li>
                              <li class="dropdown-item">
                                <a href="{{ route('master.lab') }}" class="nav-link">Management Lab</a>
                              </li>
                            
                              <!-- End Level two -->
                          </ul>
                      </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Module</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                @foreach (App\Helpers\Menu::menus() as $key => $item)
                                    @if (count($item->labs) > 0)
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a class="dropdown-item dropdown-toggle">{{ $item->name }}</a>
                                            <ul class="dropdown-menu border-0 shadow">
                                                @for ($i = 0; $i < count($item->labs); $i++)
                                                    <li><a href="{{route('master.module.show',$item->labs[$i]->id)}}" class="dropdown-item">{{ $item->labs[$i]->name }}</a>
                                                    </li>

                                                @endfor
                                                
                                            </ul>

                                        </li>
                                    @else
                                        <li class="dropdown-item">{{ $item->name }}</li>
                                    @endif

                                @endforeach
                                <!-- End Level two -->
                            </ul>
                        </li>

                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script>
        setTimeout(function() {
            console.log("starting");
            var x = document.getElementsByClassName("alert-flash")[0].className = 'd-none';

        }, 3000);

    </script>
</body>

</html>
