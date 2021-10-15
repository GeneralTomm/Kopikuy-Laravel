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

        @media(max-width:776px){
            .responsive-form{
                background-color:#978477!important;
                color:white!important;
            }
            .responsive-form  button{
                border-color:white !important;
                color:white!important;
                transition:all 1s;
                background:transparent!important;
            }
            .responsive-form button:hover{
                background:white !important;
                color:black !important;
            }
            .responsive-height{
                height:0px;
            }
            .responsive-body{
                background-color:#978477!important;
            }
        }
    </style>
</head>
<body class="text-nunito responsive-body">
    <div class="container-fluid">
        <div class="row" style="height:629px;">
            <div class="col responsive-height" style="background:url('/img/about.jpg');background-repeat:no-repeat;background-size:cover;"></div>
            <div class="col-md-4 responsive-form" style="">
                <center>
                    <br>
                    <br><br>
                    <br>
                    <h3>Register</h3>
                    <br>
                    <br>
                </center>
                <div class="container">
                    <form action="/user/register" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input value="{{ old('first_name') }}" type="text" id="first_name" name="first_name" placeholder="Nama Depan :" class="form-control  form-control-sm col @error('first_name') is-invalid @enderror">
                                @error('first_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <input value="{{ old('last_name') }}" type="text" id="last_name" name="last_name" placeholder="Nama Belakang :" class="form-control form-control-sm col @error('last_name') is-invalid @enderror">
                                @error('last_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <input value="{{ old('username') }}" type="text" class="form-control-sm form-control col @error('username') is-invalid @enderror" placeholder="Username :" name="username" id="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control form-control-sm col @error('email') is-invalid @enderror" placeholder="E-mail :">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <select value="{{ old('gender') }}" name="gender" id="gender" class="form-control form-control-sm @error('gender') is-invalid @enderror">
                                <option value="" disabled selected hidden>Gender :</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <input value="{{ old('tgl_lahir') }}" type="text" onfocus="this.type='date'" id="tgl_lahir" name="tgl_lahir" class="form-control form-control-sm mb-3 @error('tgl_lahir') is-invalid @enderror" placeholder="Tanggal Lahir :">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <input  type="password" id="password" name="password" placeholder="Password :" class="form-control form-control-sm mb-3 @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <br>
                            <center>
                                <a href="/login">Already have Account</a>
                            </center>
                        <br>
                        <div class="col">
                            <button class="col btn btn-cokelat btn-sm mb-4 responsive-form" style="width:100%">Submit</button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>