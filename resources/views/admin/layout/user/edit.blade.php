@extends('admin.layout.user.index')
@section('form')
<div class="col mb-3">
    <br>
    <center>
        <h5 class="fw-bold text-brown">Edit User</h5>
    </center>
    <br>
    <form action="/admin/backend/user/update/{{$edit->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="row mb-3">
          <div class="col">
              <input value="{{ $edit->first_name }}" type="text" id="first_name" name="first_name" placeholder="Nama Depan :" class="form-control  form-control-sm col @error('first_name') is-invalid @enderror">
              @error('first_name')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
          </div>
          <div class="col">
              <input value="{{ $edit->last_name }}" type="text" id="last_name" name="last_name" placeholder="Nama Belakang :" class="form-control form-control-sm col @error('last_name') is-invalid @enderror">
              @error('last_name')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
          </div>
      </div>
      <div class="col mb-3">
          <input value="{{ $edit->username }}" type="text" class="form-control-sm form-control col @error('username') is-invalid @enderror" placeholder="Username :" name="username" id="username">
          @error('username')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
      </div>
      <div class="col mb-3">
          <input type="text" name="profile" placeholder="Foto profile :" onfocus="this.type='file'" class="form-control col form-control-sm" >
      </div>
      <div class="col mb-3">
          <input value="{{ $edit->email }}" type="email" name="email" id="email" class="form-control form-control-sm col @error('email') is-invalid @enderror" placeholder="E-mail :">
          @error('email')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
      </div>
      <div class="col mb-3">
          <select value="{{ $edit->gender }}" name="gender" id="gender" class="form-control form-control-sm @error('gender') is-invalid @enderror">
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
          <select value="{{ $edit->role }}" name="role" id="role" class="form-control form-control-sm @error('role') is-invalid @enderror">
              <option value="" disabled selected hidden>Role :</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>
              <option value="worker">Worker</option>
          </select>
          @error('role')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
      </div>
      <div class="col mb-3">
          <input value="{{ $edit->tgl_lahir }}" type="text" onfocus="this.type='date'" id="tgl_lahir" name="tgl_lahir" class="form-control form-control-sm mb-3 @error('tgl_lahir') is-invalid @enderror" placeholder="Tanggal Lahir :">
          @error('tgl_lahir')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
      </div>
      
      <button type="submit" class="w-100 col btn-cokelat btn-sm btn">Submit</button>
    </form>
</div>
@stop