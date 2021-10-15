@extends('admin.dashboard')
@section('content')
<a href="/admin/user/add" class="btn btn-cokelat">+ Tambah User</a>
<br><br>
<div class="row bg-light">
   @yield('form')
<div class="col-lg-8" style="height:450px;overflow:auto">
    <br>
    @foreach ($data as $users)
        
    <div class="col border-0 shadow responsive-testimonial">
        <div class="card mb-3 border-0 shadow" >
          <div class="row g-0">
            <div class="col-md-3 mt-5">
              <img
                src="@if($users->image !='user.png') /storage/{{$users->image}}  @else /img/user.png @endif"
                alt="..."
                class="img-fluid rounded-circle ms-4"
                style="width:150px;height:150px;object-fit:cover;"
              />
            </div>
            <div class="col-md-8 mt-3">
              <div class="card-body">
                <h5 class="card-title text-roboto">{{$users->username}}</h5>
                <p class="card-text fw-light text-nunito">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{$users->first_name .' '.$users->last_name}}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{$users->role}}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>:</td>
                            <td>{{$users->email}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td>{{$users->gender}}</td>
                        </tr>
                    </table>
                </p>
                <p class="card-text">
                    
                    @if ($users->id != Auth::user()->id)
                    <div class="row">
                        <div class="col">
                          @if ($users->status =='normal')
                          <a href="/admin/backend/user/blacklist/{{$users->id}}" class="btn btn-dark btn-sm col w-100">Black List</a>
                          @else
                          <a href="/admin/backend/user/unblacklist/{{$users->id}}" class="btn btn-outline-dark btn-sm col w-100">UnBlackList</a>
                          @endif
                        </div>
                        <div class="col">
                            <a href="/admin/user/edit/{{$users->id}}" class="btn btn-warning btn-sm col w-100">Edit</a>
                        </div>
                        <div class="col">
                          <form method="POST" action="/admin/backend/user/delete/{{$users->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn-sm btn-danger col btn w-100 col">Delete</button>
                          </form>
                        </div>
                    </div>                        
                    @endif
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
</div>
</div>
@stop