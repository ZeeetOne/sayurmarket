  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('uploads/user/' . Auth::user()->photo) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" >
        <li><a href="{{ route('admins.index') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="{{ route('home') }}"><i class="fa fa-gift"></i><span>Market</span></a></li>
        <li>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
        document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i><span>{{ __('Logout') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
        @csrf
        </form>
        </li>
        
        <li class="header">MANAGEMEN DATA</li>

        <li><a href="{{ route('admins.users.index') }}"><i class="fa fa-user"></i><span>Users</span></a></li>
        <li><a href="{{ route('admins.category.index')}}"><i class="fa fa-users"></i><span>Kategori</span></a></li>
        <li><a href="{{ route('admins.product.index')}}"><i class="fa fa-flag"></i><span>Produk</span></a></li>
        <li><a href="{{ route('admins.order.index') }}"><i class="fa fa-dollar"></i><span>Orderan</span></a></li>   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
