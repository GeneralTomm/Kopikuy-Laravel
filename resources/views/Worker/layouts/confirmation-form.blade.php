@extends('Worker.layouts.payment')
@section('form')
   @if (isset($error))
    @if ( $error == '404')
        <center>
            <br><br>
                <h4 class="fw-bold text-dark-brown">Maaf, Data transaksi tidak dapat di temukan</h4>
            <br><br>
        </center>
    @endif
   @else
   <div class="row">
    @if ($data->bukti != '-')
    <div class="col-md-2">
        <img src="/storage/{{$data->bukti}}" alt="" class="img-fluid mb-4">
    </div>
    @endif
    <div class="col">
        <table class="mb-3">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{$data->first_name .' '.$data->last_name}}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{$data->username}}</td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td>:</td>
                <td>{{$data->penerima}}</td>
            </tr>
            <tr>
                <td>Status Pesanan</td>
                <td>:</td>
                <td>
                    @if ($data->statusOrder == 'working')
                        <label class="fw-bold text-warning">{{$data->statusOrder}}</label>
                    @elseif($data->statusOrder == 'ready')
                    <label class="fw-bold text-success">{{$data->statusOrder}}</label>
                    @else
                    <label class="fw-bold text-red">{{$data->statusOrder}}</label>

                    @endif
                </td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td>:</td>
                <td>Rp. {{$data->subtotal}}</td>
            </tr>
            <tr>
                <td>Total Pesanan</td>
                <td> :</td>
                <td>{{$pesanan}}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>:</td>
                <td>{{$data->metodePembayaran}}</td>
            </tr>
            <tr>
                <td>Tempat Pengambilan</td>
                <td>:</td>
                <td>{{$data->pengambilan}}</td>
            </tr>
        </table>
        @php
        @endphp
        <div class="row">
            @if ($statusTransaksi->status != 'ok')
                <div class="col">
                    <a href="/confirm/accept/{{$data->id}}" class="btn btn-success col btn-sm w-100">Terima</a>
                </div>
            @endif

            <div class="col">
                <a class="btn btn-danger col btn-sm w-100" href="/confirm/decline/{{$data->id}}">Tolak</a>
            </div>
        </div>
    </div>
</div>
   @endif 
@stop