@extends('layouts.master-a')
@section('title')
<title>Orderan - Admin</title>
@endsection
@section('content')

<section class="content-header">
  <h1>
    Data Order
  </h1>
  <br>
  @if (session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('success') }}
  </div>
  @endif
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li class="active">Data Produk</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orderan Pending</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                <th>Order No</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Tambahan</th>
                <th>Jumlah Barang</th>
                <th>Total Tagihan</th>
                <th>Barang</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $os)
              <tr>
                <td>{{ $os->order_number }}</td>
                <td>{{ $os->users->name }}</td>
                @if($os->status == 1)
                <td><span class="label label-success">Done</span></td>
                @else
                <td><span class="label label-warning">Pending</span></td>
                @endif
                <td>{{ $os->address }}</td>
                <td>{{ $os->city }}</td>
                <td>{{ $os->description }}</td>
                <td>{{ $os->total_quantity }}</td>
                <td>{{ $os->total_price }}</td>
                <td><a href="{{ route('admins.order.detail', $os->id_order) }}">Detail</a></td>
                <td>
                  <form action="{{ route('admins.order.complete', $os->id_order) }}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-primary btn-sm" type="submit">Complete</button>
                  </form>
                </td>
                <td>
                  <form action="{{ route('admins.order.destroy', $os->id_order) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td>
                @empty
                <td colspan="11" style="text-align: center;">Tidak ada Data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orderan Selesai</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                <th>Order No</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Tambahan</th>
                <th>Jumlah Barang</th>
                <th>Total Tagihan</th>
                <th>Barang</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($order as $o)
              <tr>
                <td>{{ $o->order_number }}</td>
                <td>{{ $o->users->name }}</td>
                @if($o->status == 1)
                <td><span class="label label-success">Done</span></td>
                @else
                <td><span class="label label-warning">Pending</span></td>
                @endif
                <td>{{ $o->address }}</td>
                <td>{{ $o->city }}</td>
                <td>{{ $o->description }}</td>
                <td>{{ $o->total_quantity }}</td>
                <td>{{ $o->total_price }}</td>
                <td><a href="{{ route('admins.order.detail', $o->id_order) }}">Detail</a></td>
                <td>
                  <form action="{{ route('admins.order.complete', $o->id_order) }}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-primary btn-sm" type="submit">Complete</button>
                  </form>
                </td>
                <td>
                  <form action="{{ route('admins.order.destroy', $o->id_order) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td>
                @empty
                <td colspan="11" style="text-align: center;">Tidak ada Data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

@endsection
