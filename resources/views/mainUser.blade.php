<!DOCTYPE html>
<html lang="en">
<link href="{{asset('style/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') CendolNada</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('/style/assets/img/logo-nobg.png') }}" type="image/png">
  <link href="{{asset('style/assets/img/apple-touch-icon.pn') }}g" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="{{asset('style/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('style/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('style/assets/img/logo.png')}}" alt="">
        <img src="{{asset('style/assets/img/CendolNada.png')}}" alt="">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('style/assets/img/logo.png')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2 text-success">{{ Auth::user()->name ?? 'Guest' }}</span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name ?? 'Guest' }}</h6>
              <span>{{ Auth::user()->role ?? 'Tidak Diketahui' }}</span>
            </li>

            <li><hr class="dropdown-divider"></li>

            <!-- Contoh tambahan: tombol logout -->
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('menuPenjualan') }}">
            <i class="bi bi-list-ul"></i>
            <span>List Menu</span>
            </a>
        </li>

        @if(auth()->user()->role === 'admin')

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/role*') ? '' : 'collapsed' }}" href="{{ route('manajemen.penjualan') }}">
            <i class="bi bi-cash-stack"></i>
            <span>Manajemen Penjualan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/role*') ? '' : 'collapsed' }}" href="{{ route('manajemen.role') }}">
                <i class="bi bi-person-gear"></i>
                <span>Manajemen Role</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/role*') ? '' : 'collapsed' }}" href="{{ route('manajemen.menu') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Manajemen Menu</span>
            </a>
        </li>

        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <li class="nav-item">
                <a class="nav-link collapsed" href="login">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
                </a>
            </li>
        </form>

        </ul>
    </aside>

 @yield('breadcrumbs')

 @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer mt-auto">
    <div class="copyright">
      &copy; Copyright <strong><span>CendolNada</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">Kelompok II</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <style>
    /* Ubah warna tulisan sidebar jadi hijau */
    .sidebar .nav-link span {
      color: #28a745; /* hijau bootstrap */
      font-weight: 500;
    }

    /* Kalau ingin ikon juga hijau */
    .sidebar .nav-link i {
      color: #28a745;
    }

    /* Efek hover biar sedikit lebih jelas */
    .sidebar .nav-link:hover span,
    .sidebar .nav-link:hover i {
      color: #28a745;
    }
  </style>

  <!-- Vendor JS Files -->
  <script src="{{asset('style/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{asset('style/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{asset('style/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{asset('style/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/php-email-form/validate.js') }}"></script>
  <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>

  <script src="{{asset('style/assets/js/main.js') }}"></script>

</body>

</html>
