@extends('User')
@section('content')
<br><br>
    <div class="container bg-light shadow">
      <div class="container">
        <br>
        <div class="row ">
         <div class="col-md-2">
            <center>
                <img src="@if (Auth::user()->image != 'user.png')
                /storage/{{auth()->user()->image}}
                @else
                  /img/user.png
                @endif" alt="" class=" img-thumbnail img-fluid d-block rounded-circle" style="width:150px;height:150px;object-fit:cover;">
            </center>
        </div>
         <div class="col responsive-text">
            <h5 class="fw-bold mt-5">{{auth()->user()->username}}</h5>
            <p class="fw-bold">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</p>    
        </div>
        <div class="col-md-2">
            <center>
                <button data-bs-toggle="modal" data-bs-target="#formProfile" class="mt-5 btn btn-warning">
                    <span>
                        <i class="fas fa-gear"></i>
                    </span>
                    Edit Profile
                </button>
            </center>
        </div>
        </div>
        <br>
      </div>
    </div>
    <br>
    <div class="container bg-light shadow">
      <div class="container">
        <br>
        <h4 class="mb-3 text-center">Riwayat Transaksi</h4>
        <h5 class="fw-bold mb-3">Belum TerKonfirmasi :</h5>
        <div class="row" style="max-height:250px;overflow:auto;">
          @if (!empty($belum) && $belum->count())
          @foreach ($belum as $transaksi)
          <div class="col-md-4 mb-3">
              <div class="card border-0 shadow">
                  <div class="card-body">
                    <h5 class="card-title">{{$transaksi->date}}</h5>
                    <p class="card-text">
                      <table>
                          <tr>
                              <td>Grand Total</td>
                              <td>:</td>
                              <td>{{$transaksi->grandtotal}}</td>
                          </tr>
                          <tr>
                              <td>Penerima</td>
                              <td>:</td>
                              <td>{{$transaksi->penerima}}</td>
                          </tr>
                          <tr>
                              <td>Metode Pembayaran</td>
                              <td>:</td>
                              <td>{{$transaksi->metodePembayaran}}</td>
                          </tr>
                          <tr>
                              <td>Lokasi Pengambilan</td>
                              <td>:</td>
                              <td>
                                @if ($transaksi->pengambilan == 'drive')
                                  Drive Through
                                @else
                                {{$transaksi->pengambilan}}
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td>
                                  @if ($transaksi->status == 'no')
                                      <strong class="text-danger">Transaksi Belum Diterima</strong>
                                  @else
                                  <strong class="text-success">Transaksi Sudah diterima</strong>
                                  @endif
                              </td>
                          </tr>
                      </table>
                    </p>
                   <div class="container">
                    <div class="row">
                      <div class="col">
                        <button type="button" class="btn btn-cokelat-muda btn-sm w-100"  data-bs-toggle="modal" data-bs-target="#authentication" onclick="document.getElementById('idTransaksi').value={{$transaksi->id}}">Lihat Kode Transaksi</button>
                      </div>
                     @if ($transaksi->status == 'no' && $transaksi->metodePembayaran !='cash')
                      <div class="col">
                        <button type="button" class="btn btn-info btn-sm">Kirim Ulang</button>
                      </div>
                     @endif
                    </div>
                   </div>
                  </div>
                </div>
          </div>
        @endforeach
          @else
            <center>
              <h5 class="text-secondary">Tidak ada Transaksi yang belum terkonfirmasi</h5>
            </center>
          @endif

        </div>
      </div>
      <br>
      <br>
      <h5 class="fw-bold">Sudah TerKonfirmasi :</h5>
      <div class="row" style="max-height:250px;overflow:auto;">
         @foreach ($sudah as $transaksi)
          <div class="col-md-4 mb-3">
              <div class="card border-0 shadow">
                  <div class="card-body">
                    <h5 class="card-title">{{$transaksi->date}}</h5>
                    <p class="card-text">
                      <table>
                          <tr>
                              <td>Grand Total</td>
                              <td>:</td>
                              <td>{{$transaksi->grandtotal}}</td>
                          </tr>
                          <tr>
                              <td>Penerima</td>
                              <td>:</td>
                              <td>{{$transaksi->penerima}}</td>
                          </tr>
                          <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td>{{$transaksi->metodePembayaran}}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Pengambilan</td>
                            <td>:</td>
                            <td>
                              @if ($transaksi->pengambilan == 'drive')
                                Drive Through
                              @else
                              {{$transaksi->pengambilan}}
                              @endif
                            </td>
                        </tr>
                          <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td>
                                  @if ($transaksi->status == 'no')
                                      <strong class="text-danger">Transaksi Belum Diterima</strong>
                                  @else
                                  <strong class="text-success">Transaksi Sudah diterima</strong>
                                  @endif
                              </td>
                          </tr>
                      </table>
                      <div class="row">
                        <div class="col">
                          <button type="button" class="btn btn-cokelat-muda btn-sm w-100"  data-bs-toggle="modal" data-bs-target="#authentication" onclick="document.getElementById('idTransaksi').value={{$transaksi->id}}">Lihat Kode Transaksi</button>
                        </div>
                      </div>
                    </p>
                  </div>

                </div>
          </div>
        @endforeach
      </div>
    </div>
    <br>
    <script type="text/javascript">
      $(window).on('load', function() {
          $('#modalKode').modal('show');
      });
    </script>
    @if (session()->has('error'))
      <script type="text/javascript">
       $(window).on('load', function() {
           $('#authentication').modal('show');
       });
     </script>
    @endif
    @if (session()->has('profile_error'))
      <script type="text/javascript">
       $(window).on('load', function() {
           $('#formProfile').modal('show');
       });
     </script>
    @endif
    @error('passwordVerify')
    <script type="text/javascript">
      $(window).on('load', function() {
          $('#formProfile').modal('show');
      });
    </script>
    @enderror
    
{{-- Bootstrap - Kode transaksi Modal --}}
 @if (session()->has('kode'))
 <div class="modal hide fade" tabindex="-1" id="modalKode">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="alert-warning alert">
          <strong>Peringatan : Kode transaksi bersifat Rahasia</strong>
        </div>
        <br>
        <h6>Kode transaksi anda adalah : <strong>{{session('kode')}}</strong> </h6>
        <br>
      </div>
    </div>
  </div>
</div>
@endif
{{-- end bootstrap kode transaksi modal --}}



{{-- bootstrap confirmation Password  modal --}}
<div class="modal fade" id="authentication"  tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Authentication </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/client/kodetransaksi" method="POST">
          @csrf
          <input type="hidden" id="idTransaksi" name="idtransaksi">
          <input type="hidden" id="username" name="username" value="{{Auth::user()->username}}">
          <input type="hidden" id="email" name="email" value="{{Auth::user()->email}}">
          @if (session()->has('error'))
          <div class="alert alert-danger mb-3">
            <strong>{{session('error')}}</strong>
          </div>
            
          @endif
          <input type="password" class="form-control col w-100 mb-3" required="true" id="password" name="password" placeholder="Password">
          <button class="btn btn-cokelat btn-sm">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- end bootstrap confirmation Password  modal --}}

{{-- bootstrap edit Profile --}}
<div class="modal fade" id="formProfile" tabindex="-1" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Profile </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/client/user/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <center>
            <img src="@if (Auth::user()->image != 'user.png')
            /storage/{{auth()->user()->image}}
            @else
              /img/user.png
            @endif" alt="" class=" img-thumbnail img-fluid d-block rounded-circle" style="width:150px;height:150px;object-fit:cover;"> 
          </center>
          <br>
            <center>
              <label for="" class="mb-3">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</label>
              <br>
              <a role="button" class="btn btn-info" onclick="document.getElementById('image').click()">Change profile </a>
              <input type="file" name="image" id="image" class="d-none">
            </center>
            <br>
         @if (session()->has('profile_error'))
            <div class="alert alert-danger">
              {{session('profile_error')}}
            </div>
         @endif
          <br>
          <div class="row">
            <div class="col mb-3">
              <input type="text" placeholder="Username :" name="username" id="username" class="form-control form-control-sm col w-100" value="{{Auth::user()->username}}">
            </div>
            <div class="col mb-3">
              <input type="text" placeholder="E-mail :" name="email" id="email" class="form-control form-control-sm col w-100" value="{{Auth::user()->email}}">
            </div>
          </div>
            <hr>
            <h6 class="mb-2"><strong>Authentication :</strong></h6>
            <div class="col">
              <input type="hidden" name="email_verify" value="{{auth()->user()->email}}">
              <input type="hidden" name="usernameVerify" value="{{auth()->user()->username}}">
              <input type="password" placeholder="Password :" id="password" name="passwordVerify" class="@error('passwordVerify') is-invalid @enderror form-control mb-3">
            </div>
          <br>
          <button class="btn btn-cokelat">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End bootstrap edit Profile --}}
@stop