@extends('admin.dashboard')
@section('content')
<div class="row">
  <center>
    <h3>Data-data Transaksi</h3>
  </center>
</div>
<br>
<div class="row">
  <form  action="/admin/backend/transaksi/search" method="post">
    @csrf
    <div class="input-group mb-4">
      <input name="search" type="text" class="form-control" placeholder="Search ..." aria-describedby="search">
      <button class="btn btn-cokelat-muda" type="submit" id="search">Search</button>
    </div>
  </form>
</div>
<div class="row">
  @if(!empty($data) && $data->count())
    @foreach ($data as $item)
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                  <h5 class="card-title">Kode Transaksi : <span>{{$item->kodetransaksi}}</span></h5>
                  @php
                    $firstName = $item->first_name;
                    $lastName = $item->last_name;
                    $fullName = $firstName.' '.$lastName;
                    @endphp
                    <p class="card-text">
                      <table>
                        <tr>
                            <td>Nama </td>
                            <td>:</td>
                            <td>{{$fullName}}</td>
                          </tr>
                          <tr>
                            <td>Username </td>
                            <td>:</td>
                            <td>{{$item->username}}</td>
                          </tr>
                          <tr>
                            <td>E-mail </td>
                            <td>:</td>
                            <td>{{$item->email}}</td>
                          </tr>
                        </table>
                      </p>
                      <a href="/admin/transaksi/detail/{{$item->idTransaksi}}" class="btn btn-cokelat btn-sm">See More</a>
                    </div>
                  </div>
                </div>
      @endforeach
  @else
  <center>
    <br><br>
      <h3>Tidak ada Data</h3>
  </center>
  @endif
</div>
@stop
