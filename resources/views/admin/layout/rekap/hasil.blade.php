@extends('admin.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="col-md-3">
            <a href="/admin/rekap/index" class="btn btn-sm btn-cokelat-muda">Back</a>
        </div>
        <br>
        <div class="row">
            @foreach ($data as $item)
            <div class="col-md-4 mb-2">
                <div class="card shadow">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
                      <p class="card-text">
                        <table>
                            <tr>
                                <td>Waktu Rekap</td>
                                <td>:</td>
                                <td>{{$item->date}}</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td>{{$item->total}}</td>
                            </tr>
                        </table>
                      </p>
                      <a href="/admin/backend/rekap/produk/{{$item->date}}" class="btn btn-sm btn-cokelat-muda">
                          Produk yang di beli
                      </a>
                    </div>
                  </div>
            </div>      
            @endforeach
            <br>   
            <br>
            <br>
        </div>
    </div>
@stop