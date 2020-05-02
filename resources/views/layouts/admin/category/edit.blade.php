@extends('layouts.master-a')
@section('title')
<title>Edit Kategori - Admin</title>
@endsection
@section('content')
				<section class="content-header">
					<h1>
 				        Edit Kategori
 				      </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#">	<i class="fa fa-table"></i>Kategori</a>
						</li>
						<li class="active">Edit Kategori</li>
					</ol>
				</section>
				<section class="content">
			<div class="row mb-2" style="padding-top: 50px">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Form Edit Kategori</h3>
						</div>
						<div class="box-body">
							<form  class="form-horizontal" method="post" action="{{ route('admins.category.update', $cat->id_category) }}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="form-group">
									<label for="text" class="col-sm-2">Nama Kategori</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="nama_category" placeholder="Nama Kategori" value="{{ $cat->nama_category }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Photo</label>
									<div class="col-sm-4">
										<input class="form-control" type="file" name="photo_category" >
									</div>
								</div>

								<div class="form-group">
									<label for="text" class="col-sm-2"></label>
									<div class="col-sm-4">
										@if(!empty($cat->photo_category))
										<hr>
										<img src="{{ asset('uploads/cat/' . $cat->photo_category) }}" width="150px" height="150px">
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
