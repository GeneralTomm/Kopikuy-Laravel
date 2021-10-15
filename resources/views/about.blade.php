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
        .responsive-text{
            margin-top:5rem;
        }
        @media(max-width:676px){
            .responsive-text{
                margin-top:0;
                text-align:center;
            }
            .rw-img{
                display:none;
            }
        }
    </style>
</head>
<body>
<div class="bg-cream-tua">
    <div class="container">
        <nav class="navbar navbar-light bg-transparent mb-5">
            <div class="container-fluid">
              <a class="navbar-brand text-dark-brown text-roboto" href="/client/home">
                Back
             </a>
            </div>
        </nav>
        <div class="row">
            <div class=" responsive-text col-md-7 text-light">
                <h4 class="text-roboto">Selamat Datang di <span class="text-darker-brown">Kopikuy</span></h4>
                <p class="text-nunito">
                    Salam Sejahtera, kami adalah tim pengembang dari perusahaan Kopikuy yang bergerak dibidang Kuliner. terima kasih telah memilih Kopikuy sebagai tempat untuk berkumpul anda , dan juga kami bersyukur karena Kopiku sudah berjalan selama 3 tahun lamanya dan kami juga berharap perusahaan ini masih dapat melayani anda kapan pun. Di masa pandemi ini kami juga mau meminta maaf atas ketidak nyamanan anda untuk tidak boleh berkumpul di kafe kami dengan alasan protokol kesehatan, maka dari itu kami memutuskan untuk menerapkan sistem Drive Throught dan Take away sebagai upaya pencegahan penyebaran covid-19
                </p>
            <br>
            </div>
            <div class="col">
                <img src="/img/Index-page-icon.png" alt="" class="img-fluid rw-img" data-aos="fade-left">
            </div>
        </div>
    </div>
</div>

<div class="bg-black-brown text-nunito">
    <div class="container">
        <center>
            <br>
                <h4 class="text-light">Give us your Testimonial</h4>
            <br>
        </center>
        <form method="POST" action="/client/testimonial/store">
            <div class="container">
               @csrf
                <div class="col">
                    <textarea name="testimonial" id="testimonial" placeholder="Testimonial :" class="form-control col mb-4" cols="20" rows="5"></textarea>
                </div>
                <div class="col">
                    <button class="col btn-outline-light btn" style="width:100%;">Submit</button>
                </div>
                <br>
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    @endif
                  @if (!empty($message))                 
                    @if($message->type =='error')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message->content }}  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @else
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message->content }}  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                  @endif
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
</body>
</html>
<script>
    AOS.init();
</script>