<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sakoola | @yield('title')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('/admin/dist/img/AdminLTELogo.png') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-layout-sidebar"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="bi bi-arrows-angle-expand"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('sys.dashboard') }}" class="brand-link">
      <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sakoola</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('sys.dashboard') }}" class="nav-link {{ request()->routeIs('sys.dashboard') ? 'active' : '' }}">
              <i class="bi bi-house"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">HALAMAN DEPAN</li>
          <li class="nav-item {{ request()->routeIs(['sys.kategori', 'sys.tag']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs(['sys.kategori', 'sys.tag']) ? 'active' : '' }}">
              <i class="left bi bi-newspaper"></i>
              <p>
                Postingan
                <i class="right bi bi-caret-left-square"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sys.kategori') }}" class="nav-link {{ request()->routeIs('sys.kategori') ? 'active' : '' }}">
                  <i class="bi bi-arrow-return-right"></i>
                  <p>Kategori</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('sys.tag') }}" class="nav-link {{ request()->routeIs('sys.tag') ? 'active' : '' }}">
                  <i class="bi bi-arrow-return-right"></i>
                  <p>Tag</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="bi bi-arrow-return-right"></i>
                  <p>Artikel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">HALAMAN DEPAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="logout-btn">
              <i class="bi bi-box-arrow-in-right"></i>
              <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      @yield('content')
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

<script>
  document.getElementById('logout-btn').addEventListener('click', function(event) {
    event.preventDefault();

    Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Kamu akan keluar dari sesi ini.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, logout!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  });

  @if (session('success'))
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 2000,
    scrollbarPadding: false,
    heightAuto: false
  });
  @endif
</script>

</body>
</html>
