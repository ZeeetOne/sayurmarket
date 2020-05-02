@extends('layouts.master')
@section('content')

<section class="brands mt-5">
    <div class="container">
        <div class="row p-5 text-center justify-content-center">
        <div class="col-6 col-sm-5 col-md-4 col-lg-4 s-card">
            <img src="{{ asset('uploads/cat/' . $photo) }}" class="img-fluid mr-4" width="50px" height="50px"> <span> {{ $category }}</span>
        </div>
        </div>
    </div>
</section>

<section class="container">
    <form method="GET" action="{{ route('product.search', $id ) }}">
        <div class="input-group mb-3 d-flex">
            <input type="text" name="search" class="form-control" placeholder="Cari {{ $category }} disini" aria-label="Cari {{ $category }} disini" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit" id="button-addon2"><i class="fas fa-search ml-2 mr-2"></i> Cari</button>
            </div>
        </div>
    </form>
</section>

<section class="features bg-light p-5">
    <div class="container">
      <div class="row mb-3 justify-content-between">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
          <h3>{{ $category }}</h3>
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-6 text-right mt-4">
        </div>
      </div>
      <div class="row">
        <?php $o = 1;?>
        @foreach($product as $p)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <figure class="figure">
            <div class="figure-img">
              <img src="{{ asset('uploads/product/' . $p->photo_product) }}" class="figure-img img-fluid">
              <a href="#gambar{{$o}}"></a>
            </div>
            <div class="overlay-figure text-center" id="gambar{{$o}}">
              <img src="{{ asset('uploads/product/' . $p->photo_product) }}" width="350px">
              <a href="#" class="text-uppercase close-txt btn btn-dark">x Close</a>
            </div>
            <figcaption class="figure-caption">
              <h5>{{ $p->nama_product }}</h5>
              <h6>Rp. {{ $p->price }}</h6>
              <p>/ {{ $p->amount }}</p>
            </figcaption>
            <button class="btn btn-success btn-block" data-id="{{ $p->id_product }}">Beli</button>
          </figure>
        </div>
        <?php $o++?>
        @endforeach
      </div>
    </div>
  </section>

@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
    $('.btn-success').click(function(e) {
        e.preventDefault()

        var ele = $(this);

        $.ajax({
            method : 'post',
            url : '{{ route('cart.add') }}',
            data : {_token: '{{ csrf_token() }}', id: ele.attr('data-id') },
            success : function(response){

            }
        });
    });
    });
</script>
@endpush
