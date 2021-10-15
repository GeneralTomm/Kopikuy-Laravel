@extends('Worker.dashboard')
@section('pesanan')
    <div class="bg-light shadow" style="border-radius:5px;">
       <div class="container">
        <br>
        <form action="/confirm/search" method="POST">
            @csrf
            <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code')}}" id="code" name="code" placeholder="Kode Transaksi"   aria-describedby="konfirmasi">
                <button class="btn btn-cokelat" type="submit" id="konfirmasi">Cari Data</button>
            </div>
            @error('code')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            @if (session()->has('success'))
            <div class="alert alert-success d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </form>
        <br>
        @yield('form')
       </div>
       <br>
    </div>
    <br><br>
@stop