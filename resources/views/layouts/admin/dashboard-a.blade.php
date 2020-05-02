@extends('layouts.master-a')
@section('content')

<?php
  $pelanggan = App\User::where('role', 2)->count();
  $produk = App\Product::get('id_product')->count();
  $order = App\Order::where('status', 1)->count();
  $orderan = App\Order::where('status', 2)->count();
?>

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
  <br>
  @if (session('alert'))
  <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('alert') }}
  </div>
  @endif
</section>
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $pelanggan }}</h3>

          <p>Pelanggan</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $produk }}</h3>

          <p>Produk</p>
        </div>
        <div class="icon">
          <i class="fa fa-dropbox"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $order }}</h3>

          <p>Orderan Selesai</p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $orderan }}</h3>

          <p>Orderan Pending</p>
        </div>
        <div class="icon">
          <i class="fa fa-tasks"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row --> 
</section>

@endsection