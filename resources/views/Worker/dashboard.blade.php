@extends('Worker.index')

@section('content')
<br><br>
<center>
  <h2 class="text-dark-brown">Selamat datang kembali</h2>
</center>
<br><br>
<div class="row">
    <div class="col-md-3">
      <a  class="btn btn-cokelat col w-100 mb-3" href="/worker/order">Pesanan</a>
    </div>
    <div class="col-md-3">
      <a  class="btn btn-cokelat col w-100 mb-3" href="/worker/konfirmasi">Konfirmasi Pembayaran</a>
    </div>
    <br>
    <br>
    <div class="container">
      @yield('pesanan')
    </div>
  </div>
@stop