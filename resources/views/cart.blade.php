@extends('User')
@section('content')
<div class="container">
    <br>
        <div class="container">
            <div class="row">
                <a href="/client/menu" class="btn btn-cokelat col-md-2 mt-2 mb-2" >Back</a>
            </div>
        </div>
    <br>
        <div class="container">
            <div class="row bg-light shadow" style="border-radius:7px;">
                <div class="col mt-3 ">
                   <div class="container text-dark-brown mb-3">
                    <table>
                        <tr>
                            <td>Total Item </td>
                            <td>:</td>
                            <td>{{$items}} items</td>
                        </tr>
                        <tr>
                            <td>Sub Total </td>
                            <td>:</td>
                            <td>Rp. <span>{{$subtotal}}</span></td>
                        </tr>
                    </table>
                   </div>
                </div>
                <div class="col-md-2 mt-4">
                    <div class="container">
                        <a href="/client/checkout" class="btn-cokelat btn btm-sm mb-3 w-100">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    <br>
    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</div>
<div class="container">
    <div class="row">
        @foreach ($data as $produk)
        <div class="col-md-3 mb-4">
            <div class="card justify-content-center shadow" style="border-radius:10px;">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
              <center>
                <br>  
                <img
                src="/storage/{{$produk->image}}"
                class="img-fluid" style="max-height:200px;max-width:200px;"
              />
              </center>
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
            <br>
            <div class="card-body justify-content-center">
              <h5 class="card-title">Rp.{{$produk->price}}</h5>
              <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{$produk->product}}
              </p>
              <form action="/cart/edit/{{$produk->id}}" id="edit_order" method="POST">
                @csrf
                @method('PUT')
                <table class="mb-2">
                    <tr>
                        <td>Jumlah Pesanan</td>
                        <td>
                            <div class="input-group input-group-sm mb-3 mt-2 ms-2">
                                <input type="number" aria-describedby="button-addon2" class="form-control-sm form-control col-1" id="quantity" name="newQuantity" value="{{$produk->quantity}}" oninput="hitung(this.value ,{{$produk->price}},this)">
                                <button class="btn btn-cokelat" type="submit" id="button-addon2">Save</button>
                            </div>
                           
                        </td>
                    </tr>
                </table>
              </form>
              <div class="row">
                  <div class="col">
                    <form action="/cart/delete/{{$produk->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm w-100 btn-outline-danger">Hapus Order</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>
          </div>
        @endforeach
    </div>
</div>
@stop