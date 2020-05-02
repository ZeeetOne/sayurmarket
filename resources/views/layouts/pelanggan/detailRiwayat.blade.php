@extends('layouts.master')
@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row mt-5">
      <div class="col-lg-3">
        <div class="card mt-3">
          <div class="card-header">
            User Profile
          </div>
          <div
            class="text-center justify-content-center"
            style="margin: 10px;"
          >
            @foreach ($user as $u)
            <img
              src="{{ asset('uploads/user/' . Auth::user()->photo) }}"
              class="rounded-circle"
              style="width: 40%;"
            />
          </div>
          <div style="margin: 10px 25px 10px 25px;" class="profile text-center justify-content-center">
            <h5> {{ $u->name }} </h5>
            <p> {{ $u->phone }} </p>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="card text-center mt-3">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Detail Order</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title c-title">Detail Order No. {{ $nomor }} <p style="float: right; font-size: 15px;"><a href="{{ route('riwayat.index') }}" style="text-decoration: none;"> Kembali <i class="fas fa-arrow-right"></i></a></p> </h5>
            <p>Tanggal {{ $tgl->format('d/m/Y') }}</p>
            <table class="table table-hover" id="table">
              <thead class="bg-success" style="color: #fff;">
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
        </div>
      </div>
    </div>
  </div>
@endsection
