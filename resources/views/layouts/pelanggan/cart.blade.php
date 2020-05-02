@extends('layouts.master')
@section('content')

@if(session('cart'))
<div class="container cart-header" style="margin-top: 100px;">
    <div class="row mt-5 text-center">
      <div class="col">
        <h3>Your Cart</h3>
        <p>Pastikan belanjaan kamu lengkap</p>
      </div>
    </div>
  </div>

  <!-- Breadcrumbs -->
  <div class="container">
    <nav>
      <ol class="breadcrumb bg-transparent pl-0 cart-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cart Checkout</li>
      </ol>
    </nav>
  </div>


  <!-- Checkout -->

  <section class="checkout">
    <div class="container">
      <div class="row justify-content-between" style="margin-bottom: 100px;">
        <div class="col-lg-6">
          <h4 class="mb-4">Your Items</h4>


		      @foreach(session('cart') as $id_product => $data)

          <div class="row mb-4 this">
            <div class="col-2">
              <img src="{{ asset('uploads/product/' . $data['photo']) }}" width="50px" height="50px">
            </div>
            <div class="col-4">
              <h5 class="m-0">{{ $data['name'] }}</h5>
              <p class="m-0" style="color:#B7B7B7;">{{ $data['amount'] }}</p>
            </div>
            <div class="col-4">
              <input type="number" name="quantity" id="quantity" value="{{ $data['quantity'] }}" class="form-control quantity" style="border: none;">
            </div>
            <div class=" text-right" style="margin-left: inherit;">
           		<button type="button" class="btn btn-sm btn-primary update" data-id="{{ $id_product }}" id="edit" style="color: white;"><i
                class="fas fa-redo-alt"></i></button>
                <form method="post" action="{{ route('cart.remove', $id_product) }}" style="display: contents;">
                  @csrf
                  @method('DELETE')
                    <button type="sumit" class="btn btn-sm btn-danger delete" style="color: white;"><i
                    class="fas fa-times-circle"></i></button>
                </form>
            </div>
          </div>

          @endforeach

          <div class="card rounded-0 checkout-detail mt-5">
            <div class="card-body">
              <h5 class="card-title">Informasi Biaya</h5>

              <?php  $total=0; ?>
              @foreach(session('cart') as $id_product => $data)
			        <?php $total += $data['price'] * $data['quantity'];?>

              <div class="row mb-3">
                <div class="col">
                  <h6 class="m-0">{{ $data['name'] }}</h6>
                  <small style="color: #B7B7B7;">{{ $data['quantity'] }} x {{ $data['amount'] }}</small>
                </div>
                <div class="col d-flex justify-content-end">
                  <h6 class="m-0 align-self-center text-success">RP. {{ $data['price'] * $data['quantity'] }}</h6>
                </div>
              </div>
              @endforeach

              <hr>

              <div class="row mb-2 mt-5">
                <div class="col">
                  <h6 class="m-0">Total Harga</h6>
                </div>
                <div class="col d-flex justify-content-end">
                  <h6 class="m-0 align-self-center text-primary">Rp. {{ $total }}</h6>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-lg-5">

          <h4 class="mb-3 mt-3">Your Address</h4>

          <form role="form" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="form-group">
              <label for="city">Kota</label>
              <select class="custom-select" name="city">
                <option selected>Pilih Kota</option>
                <option value="1">Parung Panjang</option>
              </select>
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" class="form-control address" name="address" id="address" placeholder="Masukan alamat lengkap">
            </div>
            <div class="form-group">
                <label for="address">Gunakan alamat yang disimpan?</label>
                <input type="checkbox" name="def" id="def"> atau
                <a href="#" id="setadd" class="btn btn-outline-success">Simpan sebagai alamat sekarang?</a>
            </div>
            <hr>
            <div class="form-group mt-4">
              <label for="note">Note (Catatan untuk pesanan)</label>
              <textarea class="form-control" id="note" name="description" rows="3"></textarea>
            </div>
            <p>* Cash on Delivery (Bayar ditempat)</p>
            <div class="row mt-3">
            <div class="col">
              <a href="index.html" type="button" class="btn btn-block"
                style="background-color: #EAEAEF; color: #ADADAD;">Cancel</a>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-success btn-block text-white modal-b" data-toggle="modal"
              data-target="#checkoutModal">Checkout</button>
            </div>
          </div>
      </form>

        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Checkout -->

  <!-- Modal -->
  <div class="modal fade checkout-modal-success" id="checkoutModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img src="{{ asset('img/sukses_checkout.png') }}" class="mb-5">
          <h3>Checkout Berhasil</h3>
          <p>Terimakasih telah berbelanja di Sayurmart, <br> Tunggu pesanan di rumah ya</p>
          <img src="{{ asset('img/happy.png') }}" width="50px">
        </div>
      </div>
    </div>
  </div>
  @else
  <br><br><br><br><br><br><br><br><br><br>
  <center><h3>Tidak ada produk di keranjang.</h3><a href="{{ route('home') }}" >Lanjut Belanja</a></center><br><br><br><br><br><br><br><br>
  <!-- susah css ny cuk :v -->
  @endif


@endsection

@push('script')
<script type="text/javascript">

$(".update").click(function (e) {
    e.preventDefault();
    var ele = $(this);
    $.ajax({
        url: '{{ route('cart.update') }}',
        method: "patch",
        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents(".this").find(".quantity").val()},
        success: function (response) {
            window.location.reload();
        }
    });
});

$("#def").click(function() {
    if(this.checked) {
        $.ajax({
        url: '{{ route('getdefadd') }}',
        method: "get",
        success: function (response) {
        $('.address').val(response);
        }
    });
    } else {
        $('.address').val('');
    }
});

$("#setadd").click(function(e) {
    e.preventDefault();

    console.log('what');
    var address = $('.address');

    $.ajax({
        url: '{{ route('setdefadd') }}',
        method: "patch",
        data: {_token: '{{ csrf_token() }}', address: address.val()},
        success: function (response) {
        alert('Default Address Set!');
    }
    });
});

</script>
@endpush
