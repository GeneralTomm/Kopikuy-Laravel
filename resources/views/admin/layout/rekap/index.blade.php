@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <div class="container">
        <br>
            <h3>Rekap Transaksi</h3>
        <form  action="/admin/backend/rekap/search" method="post">
            @csrf
            <div class="input-group mb-4">
                <select name="date" id="date" aria-describedby="date" class="form-control">
                    <option value="" selected hidden disabled>Pilih Tanggal yang ingin di Rekap :</option>
                    @foreach ($data as $item)
                        <option value="{{$item->date}}">{{$item->date}}</option>
                    @endforeach
                </select>
                <button class="btn btn-cokelat-muda" type="submit" id="date">Cari Data</button>
            </div>
        </form>
    </div>
    <div class="container">
       <div class="row">
          <div class="col-md-3 mb-3">
              <a href="/admin/rekap/data" class="btn btn-sm btn-cokelat-muda col w-100">Hasil Rekap Transaksi</a>
          </div>
         @if (session()->has('transaksi'))
             @php
                 $json = session('transaksi');
                 $data = $json[0]->date;
             @endphp
            <div class="col-md-3 mb-3">
                <form action="/admin/backend/rekap/rekap/{{$data}}" method="POST">
                    @csrf 
                    @method('PUT')
                    <button class="btn btn-sm btn-cokelat-muda col w-100">Rekap Tanggal Pilihan</button>
                </form>
            </div>
         @endif
       </div>
        <br>
       <div class="">
        <div class="row">
            @if (session()->has('transaksi'))
            @php
                $transaksi = session('transaksi')
            @endphp
            @foreach ($transaksi as $data)
                <div class="col-md-4 mb-3">
                  <div class="card shadow">
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">
                          <table>
                              <tr>
                                  <td>Kode Transaksi</td>
                                  <td>:</td>
                                  <td>
                                      <strong>
                                         {{$data->kodetransaksi}}
                                      </strong>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Sub Total</td>
                                  <td>:</td>
                                  <td>Rp.{{$data->grandtotal}}</td>
                              </tr>
                              <tr>
                                  <td>Date</td>
                                  <td>:</td>
                                  <td>{{$data->date}}</td>
                              </tr>
                              <tr>
                              <tr>
                                  <td>Status</td>
                                  <td>:</td>
                                  <td>
                                     @if ($data->status != 'no')
                                        <strong class="text-success">Sudah diterima</strong>
                                    @else
                                        <strong class="text-danger">Belum Diterima</strong>
                                    @endif 
                                  </td>
                              </tr>
                              </tr>
                          </table>
                        </p>
                      </div>
                    </div>
                  <br>   
                  <br>
                  <br>
              </div>      
            @endforeach
            @else
                <h4 class="text-center">Belum ada Data dari waktu transaksi yang di pilih </h4>
            @endif
        </div>
       </div>
    </div>
    <br><br>
</div>
@stop