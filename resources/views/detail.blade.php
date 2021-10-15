@extends('User')
@section('content')

<br>
@if (session()->has('success'))
<div class="alert alert-success d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        {{ session('success') }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<br>        
@endif
@if (session()->has('error'))
    
<div class="alert alert-success d-flex align-items-center w-100 alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        {{ session('error') }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<br>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="/storage/{{ $data->image }}" data-aos="flip-left" alt="" class="img-fluid img-thumbnail shadow" style="border-radius:10px;">
        </div>
        <div class="col-md-5">
            <br>
            <h3>{{$data->product}}</h3>
            <p>{{$data->description}}</p>
            <br>
            <h4>Rp. <span id="price">{{$data->price}}</span></h4>
            <div class="row">
                <h4>Total : Rp <span id="hargaTotal">0</span></h4>
            </div>
            <br>
            <div class="col-md-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text btn-cokelat-muda" id="addon-wrapping" onclick="kurang()">-</span>
                    <input type="number" readonly class="form-control-sm form-control" value="0" style="width:30px;" placeholder="number" aria-label="Username" aria-describedby="addon-wrapping" id="jumlah">
                    <button class="input-group-text btn-cokelat-muda" id="addon-wrapping" onclick="jumlah()">+</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <form action="/cart/add" method="POST">
                        @csrf
                        <input type="hidden" name="productId" id="productId" value="{{$data->id}}">
                        <input type="hidden" name="quantity" id="quantity">
                        <input type="hidden" name="subtotal" id="subtotal">
                        <button class="btn btn-sm btn-cokelat-muda col" style="width:100%;">
                            <span>
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span>
                                Add To Cart
                            </span>
                        </button>
                    </form>
                </div>
            
                <div class="col-2">
                    <button class="btn btn-sm btn-cokelat-muda col" style="width:100%;">
                        <span><i class="fas fa-heart"></i></span>
                    </button>
                </div>
            </div>
            <br>
            
        </div>
    </div>
</div>
<br>
<div class="container">
    <br>
    <h5 class="text-dark-brown">Recomendations :</h5>
    <br>
    <div class="row">
      @foreach ( $recommendation as $barang )
      <div class="col-md-3 mb-4">
          <div class="card justify-content-center shadow" style="border-radius:10px; max-height:430px">
            <center>
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <br>
              <img
              src="/storage/{{$barang->image}}"
              class="img-fluid" style="max-width:200px;max-height:200px;"
            />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </a>
          </div>
          <div class="card-body justify-content-center">
            <h5 class="card-title text-roboto">Rp.{{$barang->price}}</h5>
            <p class="card-text text-nunito" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
              {{$barang->product}}
            </p>
            <a href="/product/detail/{{$barang->id}}" class="btn btn-sm btn-cokelat col-md-5 text-nunito">See Product</a>
          </div>  
            </center>  
          </div>
      </div>
      @endforeach
        
    </div>
    <br>
    <div class="col">
        <center>
            <a href="/client/menu" class="btn btn-cokelat col-md-4 btn-sm">Show More</a>
        </center>
    </div>
</div>
<br>
<script>
    AOS.init();
</script>
<script>
    var btnSearch= document.getElementById('btn-search');
    var inputSearch = document.getElementById('input-search');
    inputSearch.addEventListener('keyup',function(event){
        if(event.key =='Enter'){
            btnSearch.click();
        }
    });
    function jumlah(){
       document.getElementById('jumlah').value = parseInt(document.getElementById('jumlah').value)+1;
       total(parseInt(document.getElementById('price').innerHTML),parseInt(document.getElementById('jumlah').value));
       
    }
    function kurang(){
        if(parseInt(document.getElementById('jumlah').value) >1){
            document.getElementById('jumlah').value = parseInt(document.getElementById('jumlah').value)-1;
            total(parseInt(document.getElementById('price').innerHTML),parseInt(document.getElementById('jumlah').value));
        }
    }
    function total(price,quantity){
        var total = price * quantity;
        console.log(quantity);
        console.log(price);
        document.getElementById('quantity').value = quantity;
        document.getElementById('subtotal').value = total;
        document.getElementById('hargaTotal').innerHTML = total;
    }
</script>
@stop