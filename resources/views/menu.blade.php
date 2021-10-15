@extends('User')
@section('content')
 
    <br>
    <div class="container">
        <form class="d-flex" method="POST" action="/client/search" class="responsive-input justify-content-center body-search">
            @csrf
            <input class="form-control form-control-sm me-2 col body-search" name="keyword" type="text" placeholder="Search...."  id="inputBody"/>
            <input type="submit" id="submit-body-search" style="display:none">
        </form>
        <br>
        <h6 class="text-dark-brown text-roboto">Tops and discount Sales :</h6>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/img/about.jpg" class="d-block w-100" style="height:300px; object-fit:cover;" alt="...">
              </div>
              <div class="carousel-item">
                <img src="/img/about.jpg" class="d-block w-100" style="height:300px; object-fit:cover;" alt="...">
              </div>
              <div class="carousel-item">
                <img src="/img/about.jpg" class="d-block w-100" style="height:300px; object-fit:cover;" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <br>
          <div class="row">
       
            <div class="responsive-pills">
                <span class="mb-2 fw-bold text-darker-brown text-nunito">Category : </span>
                <span class="ms-2">
                    <a class="btn btn-cokelat-muda  btn-sm col-1"  href="/client/category/Tea" style="border-radius:15px;">Tea</a>
                </span>
                <span class="ms-2">
                    <a class="btn btn-cokelat-muda  btn-sm col-1"  href="/client/category/Susu" style="border-radius:15px;">Milk</a>
                </span>
                <span class="ms-2">
                    <a class="btn btn-cokelat-muda  btn-sm col-1"  href="/client/category/Coffee" style="border-radius:15px;">Coffee</a>
                </span>
               
            </div>
          </div>
          <br>

          <div class="row">
            @php
            $i = 0;
            @endphp
            @if ($type == 'default')

                @if (!empty($data) && $data->count())
                         @foreach ($data as $key=>$value )
                         @php
                         $i++
                        @endphp
                         <div class="col-md-3 mb-4">
                          <div class="card justify-content-center shadow" style="border-radius:10px; max-height:430px" data-aos="fade-up-right" data-aos-duration = "{{ 100 * $i }}">
                            <center>
                                 <div class="bg-image hover-overlay ripple" data-bs-ripple-color="light">
                                 <img
                                 src="/storage/{{$value->image}}"
                                 class="img-fluid mt-4" style="max-height:200px;max-width:200px;"
                                 loading="lazy"
                               />
                               <a href="#!">
                                 <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                               </a>
                             </div>
                             <div class="card-body justify-content-center">
                               <h5 class="card-title text-roboto">Rp.{{$value->price}}</h5>
                               <p class="card-text text-nunito" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                 {{$value->product}}
                               </p>
                               <a href="/product/detail/{{$value->id}}" class="btn btn-sm btn-cokelat col-md-5 text-nunito">See Product</a>
                             </div>
                               </center>
                             </div>
                           </div>
                         @endforeach
                @else
                <center>
                    <br><br>
                    <h2 class="text-dark-brown">Maaf, Tidak ada menu Untuk hari ini :(</h2>
                    <br><br>
                </center>
            @endif
            @else
                @if (!empty($data) && $data->count())
                     @foreach ($data as $key=>$value )
                     @php
                         $i++
                     @endphp
                     <div class="col-md-3 mb-4">
                         <div class="card justify-content-center shadow" style="border-radius:10px; max-height:430px" data-aos="fade-up-right" data-aos-duration = "{{ 100 * $i }}">
                           <center>
                             <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                             <img
                             src="/storage/{{$value->image}}"
                             loading="lazy"
                             class="img-fluid mt-4" style="max-height:200px;max-width:200px;"
                           />
                           <a href="#!">
                             <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                           </a>
                         </div>
                         <div class="card-body justify-content-center">
                           <h5 class="card-title text-roboto">Rp.{{$value->price}}</h5>
                           <p class="card-text text-nunito" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                             {{$value->product}}
                           </p>
                           <a href="/product/detail/{{$value->id}}" class="btn btn-sm btn-cokelat col-md-5 text-nunito">See Product</a>
                         </div>
                           </center>
                         </div>
                       </div>
                     @endforeach
                @else
                    <center>
                        <br><br>
                        <h2 class="text-dark-brown">Maaf, Menu tidak ditemukan :(</h2>
                        <br><br>
                    </center>
                @endif
            @endif
        </div>
        <br>
        <center>
            @if ($type == 'default')
                {!! $data->links() !!}
            @endif
        </center>
        <br>
    </div>
</div>
<script>
  AOS.init();
    function load(){
        var obj = JSON.parse('{"current_page":1,"data":[{"id":2,"product":"Strawberry ice Coffee","image":"product\/63QyevuCQPDSBf1KhBayMj7DEw5fCOK20h1br34z.png","price":"20000","status":"open","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi iste illum ex suscipit rem, sequi reprehenderit in ducimus mollitia culpa deserunt cumque eligendi a dolor veniam voluptas temporibus consequuntur? Unde.","created_at":"2021-09-30T14:04:12.000000Z","updated_at":"2021-09-30T14:04:12.000000Z"},{"id":3,"product":"Strawberry Juice flavour with cream","image":"product\/x5tEomEW6h0lnDeaN9Fgtc7Lab98yZUIwfclBKHr.png","price":"30000","status":"open","description":"Ini adalah produk terbaru kami yang kami racik sendiri dengan gabungan eskrim dan juga jus buah stroberry dengan kualitas terbaik","created_at":"2021-10-01T00:09:42.000000Z","updated_at":"2021-10-01T06:55:17.000000Z"},{"id":4,"product":"Almon Coffeee Cream","image":"product\/NjGTKlSDqW6LGJrQw6JwDIzYDvsfMkjWGev2tVoJ.png","price":"50000","status":"open","description":"Ini adalah produk terbaru kami dari Kopikuy","created_at":"2021-10-01T00:13:54.000000Z","updated_at":"2021-10-01T00:13:54.000000Z"},{"id":5,"product":"Green Matcha Tea With Ice Cream","image":"product\/U6JXmqFy55LrqGR9SdAdxx9m1HDJnJ9dvlqVQrNh.png","price":"100000","status":"open","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet temporibus cum consectetur maxime minima corporis quae ea distinctio possimus molestiae recusandae, placeat quaerat veritatis? Modi voluptatem quia ullam tenetur id.","created_at":"2021-10-01T03:09:47.000000Z","updated_at":"2021-10-01T03:09:47.000000Z"},{"id":6,"product":"Green Tea with Matcha ice cream","image":"product\/g3GGcPt6lhMES9lpoYpoBEIGzsDmPEGmEhFlgvvf.png","price":"40000","status":"open","description":"ini adalah menu kami dimana kami memadukan teh matcha hijau dengan eskrim vanilla yang dicampur dengan matcha hijau , sensai dingin yang sangat cocok jika di konsumsi saat cuaca sedasng panas","created_at":"2021-10-01T09:49:16.000000Z","updated_at":"2021-10-01T09:49:16.000000Z"},{"id":7,"product":"Sweet Caramel Ice cream with Coffee","image":"product\/8ItdThAYOCCcLooLinQEcEXumNjWzEYs2YIG8Qqv.png","price":"50000","status":"open","description":"Ini adalah menu yang terbaik dari restoran kami dimana kami menyediakan sebuah produk kopi dengan topingan karamel dan juga es krim vanilla","created_at":"2021-10-01T09:50:54.000000Z","updated_at":"2021-10-01T09:50:54.000000Z"},{"id":8,"product":"Green Matcha Milk","image":"product\/uZNLrP0XphaSOFJIgORoZf2rWAE2lCkuiRlv4Dgd.png","price":"30000","status":"open","description":"Ini adlah susu dengan campuran matcha green tea yang di berikan toping dari susu kental dari matcha","created_at":"2021-10-01T09:52:48.000000Z","updated_at":"2021-10-01T09:52:48.000000Z"},{"id":9,"product":"chocholate Milk Shake with ice cream","image":"product\/BpNs7clt71NDawwk4MMRi3bX3Bqy4AJtI4a1L3mk.png","price":"60000","status":"open","description":"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione, ut possimus sapiente illo, exercitationem omnis, aperiam nemo maxime quod inventore corrupti ab unde rem laboriosam. Dolorum, optio? Similique, voluptatibus ab?","created_at":"2021-10-01T10:27:55.000000Z","updated_at":"2021-10-01T10:27:55.000000Z"}],"first_page_url":"http:\/\/localhost:8000\/client\/menu?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/localhost:8000\/client\/menu?page=1","links":[{"url":null,"label":"« Previous","active":false},{"url":"http:\/\/localhost:8000\/client\/menu?page=1","label":"1","active":true},{"url":null,"label":"Next »","active":false}],"next_page_url":null,"path":"http:\/\/localhost:8000\/client\/menu","per_page":8,"prev_page_url":null,"to":8,"total":8}');
        console.log(obj);
    }
    var navInput = document.getElementById('inputNav');
    var bodyInput = document.getElementById('inputBody');
    var btnInputnav = document.getElementById('submit-nav-search');
    var btnInputBody = document.getElementById('submit-body-search');
    navInput.addEventListener('keyup',function(event){
        if(event.key == 'Enter'){
            btnInputnav.click();
        }
    });
    bodyInput.addEventListener('keyup',function(event){
        if(event.key == "Enter"){
            btnInputBody.click();
        }
    });
</script>
@stop