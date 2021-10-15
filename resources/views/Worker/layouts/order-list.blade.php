@extends('Worker.dashboard')
@section('pesanan')

@foreach ($data as $produk)
    <div class="row">
            <div class="col">
                <div class="card mb-3 border-0 shadow" style="">
                  <div class="row g-0">
                    <div class="col-md-1 img-responsive">
                     <div class="container">
                        <center>
                            <img
                            src="/storage/{{$produk->image}}"
                            alt="..."
                            style=""
                            class="img-fluid border-0 ms-2 mt-2 mb-2"
                            style="max-width:100px; max-height:100px;"
                          />
                          </center>
                     </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title text-roboto">{{$produk->product}}</h5>
                        <p class="card-text fw-light text-nunito">
                            <table>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>{{$produk->price}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah pesanan</td>
                                    <td>:</td>
                                    <td>{{$produk->quantity}}</td>
                                </tr>
                                <tr>
                                    <td>Total </td>
                                    <td>:</td>
                                    <td>{{$produk->subtotal}}</td>
                                </tr>
                            </table>
                        </p>
                        <p class="card-text">
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        @if ($status != 'ready')
        <a href="/order/finish/{{$id}}" class="btn btn-outline-success col-md-3 mb-4">Selesai</a>
        @endif
@stop