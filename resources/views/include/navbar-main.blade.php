<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('img/BabaSayur.png') }}" alt="Baba Sayur" style="width: 80%;">
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-uppercase mx-auto">
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cat.index') }}">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('riwayat.index') }}">Profile</a>
          </li>
        </ul>
        <!-- User -->
        <div class="dropdown ml-3">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('uploads/user/' . Auth::user()->photo) }}" alt="User" width="50px" height="50px" class="">
          </a>
          <span class="text-white">| </span>
          <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
            @if(Auth::user()->role == 1)
            <a class="dropdown-item" href="{{ route('admins.index') }}"><i class="fas fa-user"></i> Dashboard</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt"></i>{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
            @csrf
            </form>
          </div>
        </div>
        <!-- End User -->
      </div>
      <a href="{{ route('cart.index') }}" class="nav-link text-white"><i class="fas fa-shopping-cart"></i>
        <span id="cartlive" class="text-white">0</span></a> </a>
    </div>
  </nav>

  @push('script')
  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('cart.live') }}",
            success: function(response) {
                  $("#cartlive").text(response);
            }
        });
    }, 1000);
  });

  </script>
  @endpush
