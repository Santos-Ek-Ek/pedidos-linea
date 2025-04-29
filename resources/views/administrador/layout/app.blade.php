<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href=" {{ asset('dist/css/fuente.css') }} ">

  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src=" {{ asset('img/laterraza.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-link active" style="border: none; background: none; cursor: pointer;">
        <i class="fas fa-sign-out-alt mr-2"></i>
    </button>
</form>
    </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
    <img src="{{ asset('img/laterraza.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
   
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
              <p>
                Administrar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            </ul>
          </li>-->
          <li class="nav-item">
                <a href="usuarios" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="vendedores" class="nav-link">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>Vendedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="empresas" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                  <p>Empresas</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="producto" class="nav-link">
                  <i class="nav-icon fab fa-product-hunt"></i>
                  <p>Productos</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="categorias" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>Categorías</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pedidos" class="nav-link">
            <i class='nav-icon fas fa-shopping-bag'></i>
              <p>Pedidos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="reportes" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
              <p>Reportes</p>
            </a>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('titulo')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administrador</a></li>
              <li class="breadcrumb-item active">@yield('titulo')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!-- <footer class="main-footer">
    <div class="container-fluid px-4">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; Realizado por <a href="../contacto">Zamna Express </a> <?php echo date("Y")?></div>
      </div>
    </div>
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>


<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            // Evita la acción predeterminada del enlace
            event.preventDefault();

            // Elimina la clase 'nav-link-active' de todos los enlaces
            navLinks.forEach(function (navLink) {
                navLink.classList.remove("nav-link-active");
            });

            // Agrega la clase 'nav-link-active' al enlace que se ha clicado
            this.classList.add("nav-link-active");

            // Obtén la URL de destino del enlace
            const targetURL = this.getAttribute("data-link");

            // Puedes usar 'targetURL' para redirigir a la página deseada
            // window.location.href = targetURL;
        });
    });
});
</script> -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

</script>

</body>
</html>
