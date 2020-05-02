@extends('layouts.master-a') 
@section('title')
<title>Edit Produk - Admin</title>
@endsection
@section('content')
				<section class="content-header">
					<h1>
 				        Edit Produk
 				      </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#">	<i class="fa fa-table"></i>Produk</a>
						</li>
						<li class="active">Edit Produk</li>
					</ol>
				</section>
				<section class="content">
			<div class="row mb-2" style="padding-top: 50px">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Form Edit Produk</h3>
						</div>
						<div class="box-body">
							<form  class="form-horizontal" method="post" action="{{ route('admins.product.update', $product->id_product) }}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="form-group">
									<label for="text" class="col-sm-2">Nama Produk</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="nama_product" placeholder="Nama Produk" value="{{ $product->nama_product }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Jenis Kategori</label>
									<div class="col-sm-10">
										<select name="category_id" class="form-control">
            							  <option>-- PILIH KATEGORI --</option>
            							  @foreach($cat as $c)
            							  <option value="{{ $c->id_category }}" {{ $product->category_id == $c->id_category ? 'selected' : '' }}>{{ $c->nama_category }}</option>
            							  @endforeach
            							</select>
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Jumlah</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="amount" placeholder="Jumlah" value="{{ $product->amount }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Harga</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="price" placeholder="Harga" value="{{ $product->price }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Stok</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="stock" placeholder="Stok" value="{{ $product->stock }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Photo</label>
									<div class="col-sm-4">
										<input class="form-control" type="file" name="photo_product" >	
									</div>
								</div>

								<div class="form-group">
									<label for="text" class="col-sm-2"></label>
									<div class="col-sm-4">
										@if(!empty($product->photo_product))
										<hr>
										<img src="{{ asset('uploads/product/' . $product->photo_product) }}" width="150px" height="150px">
										@endif
									</div>
								</div>
								<div class="box-footer">
									<button class="btn btn-primary pull-right" type="submit">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</section>
@endsection