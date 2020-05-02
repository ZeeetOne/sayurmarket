@extends('layouts.master')
@section('content')
<section class="brands mt-5">
    <div class="container">
      <div class="row p-5 text-center justify-content-center">
        @foreach($cat as $c)
        <div class="col-5 col-sm-5 col-md-4 col-lg-4 s-card">
          <a href="{{ route('product.pilihan', $c->id_category) }}">
            <img src="{{ asset('uploads/cat/' . $c->photo_category) }}" class="img-fluid mr-4" width="50px" height="50px"><span>{{ $c->nama_category }}</span>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
