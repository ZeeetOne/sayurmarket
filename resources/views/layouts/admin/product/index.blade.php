@extends('layouts.master-a')
@section('title')
<title>Produk - Admin</title>
@endsection
@section('content')

<section class="content-header">
  <h1>
    Data Produk
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
          <h3 class="box-title">Input Data Produk</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="{{ route('admins.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama Produk" name="nama_product">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="category_id" class="form-control">
                <option>-- PILIH KATEGORI --</option>
                @foreach($cat as $c)
                <option value="{{ $c->id_category }}">{{ $c->nama_category }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah <sup>*Harap masukkan takaran (100 gram, 1 box, 1 pak dll)</sup></label>
              <input type="text" class="form-control" placeholder="Jumlah" name="amount">
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="text" class="form-control" placeholder="Harga Produk" name="price">
            </div>
            <div class="form-group">
              <label>Stok</label>
              <input type="text" class="form-control" placeholder="Stok" name="stock">
            </div>
            <div class="form-group">
              <label>Photo</label>
              <input type="file" class="form-control" name="photo_product">
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Kategori</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Photo</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($product as $p)
              <tr>
                <td>{{ $p->nama_product  }}</td>
                <td>{{ $p->categories->nama_category }}</td>
                <td>{{ $p->amount }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->stock }}</td>
                <td>
                  <img src="{{ asset('uploads/product/' . $p->photo_product) }}" alt="Pic Not Found :(" width="50px" height="50px"> 
                </td>
                <td>
                  <a href="{{ route('admins.product.edit', $p->id_product) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                  <form action="{{ route('admins.product.destroy', $p->id_product) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td>
                @empty
                <td colspan="7" style="text-align: center;">Tidak ada Data</td>
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