@extends('layouts.master')
@section('content')
<!-- Carousel -->

  @if($message = session('alert'))
  <script type="text/javascript">
    alert('Forbidden Access. Only Admins Are Allowed !');
  </script>
  @endif


  <div id="carouselExampleIndicators" class="carousel slide mt-4 mb-4" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> --}}
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row pt-5 justify-content-center">
            <img class="d-block w-75 pt-4" src="img/banner.png" alt="First slide" style="height: 380px">
        </div>
      </div>
      {{-- <div class="carousel-item">
        <img class="d-block w-100" src=".../800x400?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src=".../800x400?auto=yes&bg=555&fg=333&text=Third slide" alt="Third slide">
      </div> --}}
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- Brands -->
  <section class="brands">
    <div class="container">
      <div class="row p-3 justify-content-center text-center">
        @foreach($cat->slice(0, 3) as $c)
        <div class="col-6 col-sm-5 col-md-4 col-lg-2 s-card">
          <a href="{{ route('product.pilihan', $c->id_category) }}">
            <img src="{{ asset('uploads/cat/' . $c->photo_category) }}" class="img-fluid p-1" width="60px" height="60px"> <span>{{ $c->nama_category }}</span>
          </a>
        </div>
        @endforeach
        <div class="col-6 col-sm-5 col-md-4 col-lg-2 s-card">
          <a href="{{ route('cat.index') }}">
            <img src="img/menu.png" class="img-fluid p-2" width="60px" height="60px"> <span>Kategori</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Brands -->

  <!-- Features -->
  <section class="features bg-light p-5">
    <div class="container">
      <div class="row mb-3 justify-content-between">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
          <h3>Sayuran</h3>
          <p>Semua sayuran segar ada.</p>
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-6 text-right mt-4">
          <p><a href="{{ route('product.pilihan', $c->id_category) }}" style="text-decoration: none;"> Lihat Semua <i class="fas fa-arrow-right"></i> </a></p>
        </div>
      </div>
      <div class="row">
        <?php  $i = 1; ?>
        @foreach($prods as $s)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <figure class="figure">
            <div class="figure-img">
              <img src="{{ asset('uploads/product/' . $s->photo_product) }}" class="figure-img img-fluid">
              <a href="#gambars{{$i}}"></a>
            </div>
            <div class="overlay-figure text-center" id="gambars{{$i}}">
              <img src="{{ asset('uploads/product/' . $s->photo_product) }}" width="350px">
              <a href="#" class="text-uppercase close-txt btn btn-dark">x Close</a>
            </div>
            <figcaption class="figure-caption">
              <h5>{{ $s->nama_product }}</h5>
              <h6>Rp. {{ $s->price }}</h6>
              <p>/ {{ $s->amount }}</p>
            </figcaption>

            <button class="btn btn-success btn-1 btn-block" data-id="{{ $s->id_product }}">Beli</button>

          </figure>
        </div>
        <?php $i++ ?>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Akhir Features -->

  <!-- Features 2 -->
  <section class="features bg-light p-5">
    <div class="container">
      <div class="row mb-3 justify-content-between">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
          <h3>Semua Dagangan</h3>
          <p>Lihat barang dagangan disini.</p>
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-6 text-right mt-4">
          <p><a href="{{ route('product.index') }}" style="text-decoration: none;"> Lihat Semua <i class="fas fa-arrow-right"></i> </a></p>
        </div>
      </div>
      <div class="row">
        <?php  $o = 1; ?>
        @foreach($prod as $p)
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
        <?php $o++ ?>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Akhir Features -->
  @endsection

@push('script')
<script type="text/javascript">
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}

$(document).ready(function(){
    $('.btn-success').click(function(e) {
      e.preventDefault()

      var ele = $(this);

      $.ajax({
          method : 'post',
          url : '{{ route('cart.add') }}',
          data : {_token: '{{ csrf_token() }}', id:ele.attr('data-id') },
          success : function(response){

          }
      });
    });
  });

</script>
@endpush
