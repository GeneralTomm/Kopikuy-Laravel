@extends('admin.dashboard')
@section('content')
<br>
<center>
    <h3>Produk</h3>
</center>
<br>
<div class="row">
    <div class="col">
        <a href="/admin/product/add"  class="btn btn-cokelat">Tambah Produk</a>
    </div>
</div>
<br>
<div class="row">
  @foreach($data as $produk)
    <div class="col-md-3 mb-4">
        <div class="card justify-content-center shadow" style="border-radius:10px;max-height:440px">
          <center>
            <div class="" style="">
            <br>
            <img src="/storage/{{$produk->image}}" class="img-fluid"  style="max-height:200px;max-width:200px;"/>
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body justify-content-center">
          <h5 class="card-title text-roboto">Rp.{{$produk->price}}</h5>
          <p class="card-text text-nunito" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{$produk->product}}
          </p>
          <label for="" >Status : <span class="text-@if($produk->status =='open')success @else text-danger @endif">{{$produk->status}}</span></label>
          <br><br>
          <div class="row mb-2">
              <div class="col mb-2">
                <a href="/admin/product/edit/{{$produk->id}}" style="width:100%;" class="btn btn-sm btn-cokelat col text-nunito">Edit</a>
              </div>
              <div class="col mb-2">
                <form action="/admin/backend/product/delete/{{$produk->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="width:100%;" onclick="return confirm('Apa anda ingin menghapus data ini ?')" class="btn btn-sm btn-outline-danger col text-nunito">hapus</button>
                </form>
              </div>
          </div>
        </div>  
          </center>  
        </div>
      </div>
      @endforeach
</div>
@stop