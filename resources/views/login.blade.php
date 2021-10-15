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

</head>
<body class="text-nunito" style="background:url('/img/about-blade.jpg');background-repeat:no-repeat;background-size:cover; background-position:center;">
    <div class="container-fluid">
        <div class="row">
            <center>
                <br><br><br><br><br>
                <div class="col-md-4 bg-light-cream" style="border-radius:10px;">
                    <br><br>
                    <center>
                        <h3 class="fw-bold text-dark-brown text-nunito">Login</h3>
                    </center>
                    <br>
                    @if (session()->has('success'))
                    <div class="container">
                        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
                          </div>
                    </div>
                    @endif
                    @if (session()->has('loginError'))
                    <div class="container">
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                {{ session('loginError') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
                          </div>
                    </div>
                    @endif
                    <br>
                    
                    <form action="/user/login" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col">
                                    <input value="{{ old('username') }}" type="text" class="form-control  @error('username') is-invalid @enderror form-control-sm col" placeholder="Username :" id="username" name="username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input value="{{ old('email') }}" type="text" class="form-control  @error('email') is-invalid @enderror form-control-sm col" placeholder="E-mail :" id="email" name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <input  type="password" class="form-control  @error('password') is-invalid @enderror form-control-sm col" placeholder="Password :" id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <br>
                                <div class="row">
                                    <div class="col">
                                        <a href="/register">Don't Have Account ?</a>
                                    </div>
                                </div>
                            <br>
                            <div class="col">
                                <button class="col btn-cokelat btn" style="width:100%;">Submit</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    
                </div>
            </center>
        </div>
        <br><br><br><br>
    </div>
</body>
</html>