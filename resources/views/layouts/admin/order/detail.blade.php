@extends('layouts.master-a')
@section('title')
<title>Orderan - Admin</title>
@endsection
@section('content')

<section class="content-header">
  <h1>
    Detail Order
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
    <li class="active">Detail Order</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detail Order No. {{ $nomor }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table ">
            <thead>
              <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php  $total=0; ?>
              @forelse($order as $o)
              <tr>
                <td>{{ $o->product->nama_product }}</td>
                <td>{{ $o->quantity }}</td>
                <td>Rp. {{ $o->total_price }}</td>
                <?php $total += $o->total_price ?>
                @empty
                <td colspan="11" style="text-align: center;">Tidak ada Data</td>
              </tr>
              @endforelse

            </tbody>
            <tfoot>
                <tr>
                <th></th>
                <th>TOTAL </th>
                <th>RP. {{ $total}}</th>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

</section>

@endsection
