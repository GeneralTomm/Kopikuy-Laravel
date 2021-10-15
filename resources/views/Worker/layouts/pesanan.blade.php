@extends('Worker.dashboard')
@section('pesanan')
@if (session()->has('success'))
<div class="alert alert-success d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        {{ session('success') }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
 <div class="row">
  @foreach ($data as $item)      
    <div class="col-md-4 mb-4">
        <div class="card shadow" style="">
            <div class="card-body">
              <h5 class="card-title">{{ $item->username }}</h5>
              <p class="card-text">
                <label class="text-capitalize text-success fw-bold">Status Pesanan : {{ $item->status }}</label><br>
                <label>Sub Total : Rp.{{ $item->subtotal }}</label>
              </p>
              <div class="row">
                <div class="col">
                  @if ($item->status == 'pending')
                    <a href="/order/accept/{{$item->id}}" class="btn btn-primary col w-100 btn-sm" >Terima Pesanan</a>
                  @elseif ($item->status == 'working')
                    <a href="/order/ready/{{$item->id}}" class="btn btn-success col w-100 btn-sm" >Pesanan Siap</a>
                   @endif
                </div>
                  <div class="col">
                    <a href="/order/show/{{$item->id}}" class="btn btn-primary col w-100 btn-sm">Lihat Pesanan</a>
                  </div>
              </div>
            </div>
          </div>
    </div>
  @endforeach

</div>      
@stop