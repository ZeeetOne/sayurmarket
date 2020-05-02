@extends('layouts.master')
@section('content')

<section class="features bg-light p-5" style="margin-top: 74px;">
    <div class="container">
      <div class="row mb-3 justify-content-between">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
          <h3>Semua Dagangan</h3>
          <p>Semua sayuran segar ada disini.</p>
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-6 text-right mt-4">
        </div>
      </div>
      <div class="row">
        <?php  $o = 1; ?>
        @foreach($product as $p)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <figure class="figure">
            <div class="figure-img">
              <img src="{{ asset('uploads/product/' . $p->photo_product) }}" class="figure-img img-fluid">
              <a href="#gambar{{$o}}"></a>
            </div>
            <div class="overlay-figure text-center" id="gambar{{$o}}">
              <img src="{{ asset('uploads/product/' . $p->photo_product) }}">
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

