@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
                <a class="nav-link active" href="#">Order</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title c-title">Riwayat Pembelian</h5>
            <table class="table table-hover table-responsive" id="table">
              <thead class="bg-success" style="color: #fff;">
                <tr>
                  <th>Tgl Pembelian</th>
                  <th>Alamat</th>
                  <th>Tambahan</th>
                  <th>Jumlah Barang</th>
                  <th>Total Tagihan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($order as $o)
                <tr>
                    <td>{{ $o->created_at->format('d/m/Y') }}</td>
                    <td>{{ $o->address }}</td>
                    <td>{{ $o->description }}</td>
                    <td>{{ $o->total_quantity }}</td>
                    <td>{{ $o->total_price }}</td>
                    @if($o->status == 1)
                    <td><span class="badge badge-success" style="color: #fff;">Done</span></td>
                    @else
                    <td><span class="badge badge-warning" style="color: #fff;">Pending</span></td>
                    @endif
                    <td><a href="{{ route('riwayat.detail', $o->id_order) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                    @empty
                    <td colspan="11" style="text-align: center;">Tidak ada Data</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table').DataTable();
  });
</script>
@endpush
