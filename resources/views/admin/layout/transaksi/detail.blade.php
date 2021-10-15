@extends('admin.dashboard')
@section('content')
<div class="container bg-light shadow">
  <br>
  <a href="/admin/transaksi/index" class="btn btn-sm btn-cokelat-muda col-md-3">Back</a>
    <div class="row">
      @if ($data->bukti != '-')
      <div class="col-md-3">
        <br>
        <img src="/img/contoh-bukti-transaksi.png" alt="" class="d-block w-100 img-fluid">
      </div>
      @endif
      <div class="col">
        <br>
       <div class="row">
         <div class="col-md-5">
          <table>
            <tr>
              <td>Kode Transaksi</td>
              <td>:</td>
              <td><strong>{{$data->kodetransaksi}}</strong></td>
            </tr>
            <tr>
              <td>Nama Lengkap </td>
              <td>:</td>
              <td>{{$data->first_name . ' '.$data->last_name}}</td>
            </tr>
            <tr>
              <td>Username</td>
              <td>:</td>
              <td>{{$data->username}}</td>
            </tr>
            <tr>
              <td>Total Pembelian</td>
              <td>:</td>
              <td>  {{$totalPembelian}}</td>
            </tr>
            <tr>
              <td>Tempat Pengambilan</td>
              <td>:</td>
              <td>{{$data->pengambilan}}</td>
            </tr>
          </table>
         </div>
         <div class="col">
          <table>
            <tr>
              <td>Status Transaksi</td>
              <td>:</td>
              <td>
                @if ($data->statusTransaksi == 'ok')
                <strong class="text-success">Transaksi Diterima</strong>
                @else
                  <strong class="text-danger">Transaksi Tidak Diterima</strong>
                @endif
              </td>
            </tr>
            <tr>
              <td>Penerima </td>
              <td>:</td>
              <td>{{$data->penerima}}</td>
            </tr>
            <tr>
              <td>Tanggal Transaksi</td>
              <td>:</td>
              <td>{{$data->date}}</td>
            </tr>
            <tr>
              <td>Metode Pembayaran</td>
              <td>:</td>
              <td class="text-capitalize">
                @if($data->metodePembayaran == 'virtual')
                  {{$data->metodePembayaran.' account'}}
                @else
                  {{$data->metodePembayaran}}
                @endif
              </td>
            </tr>
            <tr>
              <td>Sub Total</td>
              <td>:</td>
              <td>Rp.{{$data->subtotal}}</td>
            </tr>
          </table>
         </div>
       </div>
       <br>
       <h6>Produk yang di beli :</h6>
       <div class="containe-fluidr">
        <div class="row" style="max-height:270px;overflow:auto;">
          @foreach ($product as $items)    
          <div class="col-md-4 mb-3">
           <div class="card" >
            <center>
              <img src="/storage/{{$items->image}}" class="img-fluid mt-2" style="max-width:100px;max-height:150px;" alt="...">
            </center>
            <div class="card-body">
               <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <strong>
                  {{$items->product}}
                </strong>
                <br>
                Quantity : <strong>{{$items->quantity}}</strong>
              </p>
             </div>
           </div>
          </div>
          @endforeach


        </div>
       </div>
      </div>
    </div>
    <br>
</div>
<br>
@stop
