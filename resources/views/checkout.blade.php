<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/vue.js"></script>
    <script type="text/javascript" src="/js/aos.js"></script>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/aos.css">
    <title>Kopikuy - {{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      @media(max-width:991px){
        .img-responsive{
            display:none;   
        }
        .responsive-header-order{
            text-align:center;
        }
      }
    </style>
</head>
<body class="text-nunito bg-light-cream">
  <div id="app">
    <nav class="navbar navbar-light bg-darker-brown mb-5">
        <div class="container">
          <a class="navbar-brand text-light text-roboto" href="/client/cart">
            Back
         </a>
        </div>
    </nav>
    <div class="container">
        <div class="row">            
            <div class="col mb-3" style="max-height:420px;">
                <div class="container bg-light shadow" style="border-radius:5px; max-height:420px;overflow:auto">
                    <br>
                    <h6 class="mt-1 mb-3 responsive-header-order fw-bold">Daftar Pesanan :</h6>
                    @foreach ($data as $produk)
                    <div class="row">
                            <div class="col">
                                <div class="card mb-3 border-0 shadow" style="">
                                  <div class="row g-0">
                                    <div class="col-md-2 img-responsive">
                                     <div class="container">
                                        <center>
                                            <img
                                            src="/storage/{{$produk->image}}"
                                            alt="..."
                                            style=""
                                            class="img-fluid img-thumbnail border-0 ms-2 mt-3"
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
                
                </div>
                

            </div>
            <div class="col-md-5 mb-3">
               <div class="container bg-light shadow" style="border-radius:5px;">
                <br>
                <h6 class=" text-roboto fw-bold ">Payment Info</h6>
                    <table class="mt-2">
                        <tr>
                            <td>Total Produk</td>
                            <td>:</td>
                            <td>{{$items}}</td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>:</td>
                            <td>Rp.{{$subtotal}}</td>
                        </tr>
                    </table>
                    <hr>
                    <form action="/client/transaction" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subtotal" id="subtotal">
                        <label class="fw-bold mb-2">Check out :</label>
                        @if(session()->has('error'))
                        <div class="alert alert-danger d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    
                    @endif
                        <div class="col">
                          <input type="text" name="penerima" id="penerima" placeholder="Nama Penerima :" class="col form-control-sm form-control mb-3">
                        </div>
                        <div class="col">
                          <select name="metodePembayaran" id="metodePembayaran" class="form-control form-control-sm col mb-3" v-model="metodePembayaran">
                              <option disabled hidden selected value="null">Pilih Metode Pembayaran</option>
                              <option value="cash">Cash / Bayar ditempat</option>
                              <option value="virtual">Virtual Account</option>
                          </select>
                        </div>
                        <div class="col">
                          <select name="pengambilan" id="pengambilan" class="form-control form-control-sm col mb-3">
                              <option disabled hidden selected>Pilih Metode Pengambilan</option>
                              <option value="kasir">On Site(melalui Kasir)</option>
                              <option value="drive">Drive Throught</option>
                          </select>
                        </div>
                        <div class="col" v-if="metodePembayaran =='virtual'">
                            <input type="text" name="bukti" id="bukti" class="form-control form-control-sm col mb-3" onfocus="this.type='file'" placeholder="Bukti Transaksi (Rek: 12335444 ; Atas Nama : John Doe) :">
                        </div>
                        <div class="col">
                            <button type="submit" class="col btn btn-sm btn-cokelat w-100">Proceed Check Out </button>
                        </div>
                        <br>
                    </form>
               </div>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
<script>
    var Vue = new Vue({
        el:"#app",
        data:{
            metodePembayaran:"null"
        }
    });
</script>
