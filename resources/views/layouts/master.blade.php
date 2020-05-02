<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/all.css') }}">

  <!-- My CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <link rel="icon" href="{{ asset('img/icon.png') }}">

  <title>Sayur Market</title>
</head>

<body>

  <!-- Navbar -->
  @include('include.navbar-main')
  <!-- Akhir Navbar -->

  <!-- Content -->
  @yield('content')
  <!-- AKhir Content -->

  <!-- Footer -->
  @include('include.footer-main')
  <!-- Akhir Footer -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="{{ asset('js/all.js') }}"></script>
  @stack('script')
</body>

</html>
