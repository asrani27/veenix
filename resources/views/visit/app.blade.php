<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @stack('meta')

  <link rel="icon" type="image/x-icon" href="/icon/favicon.ico">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/muvnix/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/muvnix/dist/css/adminlte.min.css">

  @stack('css')
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-NTWF2VL2ED"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NTWF2VL2ED');
  </script>

</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed" style="margin-left:0px;">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark"
      style="box-shadow: 0px 0.5px 5px; margin-left:0px; ">
      <div class="container" style="max-width:95%;">
        <a href="/" class="navbar-brand">
          <img src="{{logo()}}" width="80%" class="brand-image" style="margin-top:6px;margin-bottom:6px">

        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="/" class="nav-link" style="font-family: 'Times New Roman'; font-size:18px; color:whiet">HOME</a>
            </li>

            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle"
                style="font-family: 'Times New Roman'; font-size:18px; color:whiet">GENRE</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                @foreach (genre() as $item)
                <li><a href="/genre/{{$item->nama}}" class="dropdown-item">{{$item->nama}} </a></li>
                @endforeach

              </ul>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle"
                style="font-family: 'Times New Roman'; font-size:18px; color:whiet">COUNTRY</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                @foreach (country() as $item)
                <li><a href="/country/{{$item->nama}}" class="dropdown-item">{{$item->nama}} </a></li>
                @endforeach
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle"
                style="font-family: 'Times New Roman'; font-size:18px; color:whiet">YEAR</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                @foreach (year() as $item)
                <li><a href="/year/{{$item->tahun}}" class="dropdown-item">{{$item->tahun}} </a></li>
                @endforeach
              </ul>
            </li>
            <li class="nav-item">
              <a href="/tv" class="nav-link" style="font-family: 'Times New Roman'; font-size:18px; color:whiet">TV
                SERIES</a>
            </li>
            <li class="nav-item">
              <a href="/request" class="nav-link"
                style="font-family: 'Times New Roman'; font-size:18px; color:whiet">REQUEST</a>
            </li>
          </ul>

          <!-- SEARCH FORM -->
          <form class="form-inline ml-2 ml-md-3" method="get" action="/search">
            <div class="input-group input-group-sm">
              @csrf
              <input class="form-control form-control-" type="text" size="50" name="search" value="{{old('search')}}"
                placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <a class="btn btn-primary" href="/login">
              LOGIN
            </a>

          </li>

        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <br />
      <!-- Main content -->
      <div class="content">
        @yield('content')
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer bg-secondary text-center">
      {!!Histats()!!}
      <strong>Copyright &copy; 2024 </strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="/muvnix/plugins/jquery/jquery.min.js"></script>
  <script src="/muvnix/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="/muvnix/dist/js/adminlte.min.js"></script> --}}
  @stack('js')
  {{-- <div id="histats_counter"></div> --}}
</body>

</html>