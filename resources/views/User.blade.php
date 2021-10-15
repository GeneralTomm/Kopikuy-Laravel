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
        .responsive-input{
            width:600px;
            margin-left:9rem;
            border-radius:20px;
        }
        .body-search{
            display:none;
        }
        .responsive-pills{
            display:block;
        }
        @media(max-width:989px){
            .responsive-input{
                display:none;
            }
            .body-search{
                display:block;
            }
            .responsive-pills{
                display:none;
            }
            .responsive-text{
              text-align:center;
            }
        }
   
    </style>
</head>
<body class="bg-light-cream text-nunito">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-brown text-nunito">
        <div class="container">
            <a class="navbar-brand" href="/client/home">Kopikuy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <center>
    
                    <form class="d-flex" method="POST" action="/client/search" class="responsive-input justify-content-center">
                        @csrf
                        <input class="form-control form-control-sm me-2 col responsive-input" type="text" name="keyword" placeholder="Search...."  id="input-search"/>
                        <button type="submit" style="display:none;" id="btn-search"></button>
                    </form>
    
                </center>
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    @guest
                      <li class="nav-item">
                        <a class="nav-link" href="/login">Sign In</a>
                      </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle align-items-center hidden-arrow text-light nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <img class="rounded-circle" style="object-fit:cover;" src="@if(Auth::user()->image == 'user.png') /img/user.png @else /storage/{{ Auth::user()->image }} @endif " width="25"  height="25" alt="" loading="lazy"/>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @auth
                            <li>
                                <a class="dropdown-item" href="/client/profile">My profile</a>
                              </li>
                            @endauth
                            <li>
                              <a class="dropdown-item" href="/client/cart/" aria-expanded="false">
                                My Cart
                              </a>
                            </li>
                            <li>
                              @if(Auth::user()->role == 'admin')
                              <a class="dropdown-item" href="/admin/dashboard" aria-expanded="false">
                                Admin Panel
                              </a>
                            @elseif(Auth::user()->role == 'worker' || Auth::user()->role == 'admin')
                              <a class="dropdown-item" href="/worker/dashboard" aria-expanded="false">
                                Worker Panel
                              </a>
                            @endif
                            </li>
    
                            @auth
                            <li class="nav-item">
                                <a class="dropdown-item" href="/logout">Log Out</a>
                            </li>
                            @endauth
                          </ul>
                    </li>
                    @endauth
                </ul>
    
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>