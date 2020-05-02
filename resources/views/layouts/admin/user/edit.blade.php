@extends('layouts.master-a') 
@section('title')
<title>Edit User - Admin</title>
@endsection
@section('content')
				<section class="content-header">
					<h1>
 				        Edit User
 				      </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#">	<i class="fa fa-table"></i>User</a>
						</li>
						<li class="active">Edit User</li>
					</ol>
				</section>
				<section class="content">
				<div class="col-md-12" style="padding-top: 10px">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Form Edit User</h3>
						</div>
						<div class="box-body">
							<form  class="form-horizontal" method="post" action="{{ route('admins.users.update', $user->id_user) }}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="form-group">
									<label for="text" class="col-sm-2">Nama User</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="name" placeholder="Nama User" value="{{ $user->name }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Password</label>
									<div class="col-sm-10">
										<input type="password" name="password" placeholder="Password" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">No Telp</label>
									<div class="col-sm-10">
										<input type="text" name="phone" placeholder="No Telp" class="form-control" value="{{ $user->phone }}">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class="col-sm-2">Photo</label>
									<div class="col-sm-4">
										<input class="form-control" type="file" name="photo" >	
									</div>
								</div>

								<div class="form-group">
									<label for="text" class="col-sm-2"></label>
									<div class="col-sm-4">
										@if(!empty($user->photo))
										<hr>
										<img src="{{ asset('uploads/user/' . $user->photo) }}" width="150px" height="150px">
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
				</section>
			
@endsection