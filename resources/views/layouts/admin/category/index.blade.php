@extends('layouts.master-a')
@section('title')
<title>Kategori - Admin</title>
@endsection
@section('content')

<section class="content-header">
  <h1>
    Data Kategori
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
    <li class="active">Data Kategori</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Input Data Kategori</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="{{ route('admins.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_category">
            </div>
            <div class="form-group">
              <label>Photo</label>
              <input type="file" class="form-control" name="photo_category">
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

    <div class="col-xs-6">
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
                <th>Photo</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($cat as $c)
              <tr>
                <td>{{ $c->nama_category }}</td>
                <td>
                  <img src="{{ asset('uploads/cat/' . $c->photo_category) }}" alt="Pic Not Found :(" width="50px" height="50px"> 
                </td>
                <td>
                  <a href="{{ route('admins.category.edit', $c->id_category) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                  <form action="{{ route('admins.category.destroy', $c->id_category) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td>
                @empty
                <td colspan="4" style="text-align: center;">Tidak ada Data</td>
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