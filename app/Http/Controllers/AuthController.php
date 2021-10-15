<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'first_name'=>'required|min:2|max:255',
            'last_name'=>'required|min:2|max:255',
            'username'=>'required|min:3|max:255|unique:users',
            'email'=>'required|min:3|max:255|unique:users',
            'gender'=>'required',
            'tgl_lahir'=>'required',
            'password'=>'required|min:8'
        ],[
            'first_name.required'=>'Nama depan harus di isi',
            'first_name.min'=>'Nama terlalu pendek',
            'first_name.max'=>'Nama terlalu panjang',
            'last_name.required'=>'Nama Belakang Harus Di isi',
            'last_name.min'=>'Nama Belakang terlalu Pendek',
            'last_name.max'=>'Nama Belakang terlalu Panjang',
            'username.required'=>'Username Wajib di isi',
            'username.min'=>'Username mu terlalu Pendek',
            'username.max'=>'Username mu terlalu Panjang',
            'username.unique'=>'Username mu sudah diambil Orang',
            'email.required'=>'E-mail Wajib di Isi',
            'email.min'=>'E-mail terlalu pendek',
            'email.max'=>'E-mail terlalu panjang',
            'email.unique'=>'E-mail ini sudah pernah terdaftar',
            'gender.required'=>'Gender harus di isi',
            'tgl_lahir.required'=>'Tanggal Lahir harus di isi',
            'password.min'=>'Password yang anda Gunakan terlalu pendek',
            'password.required'=>'Password Harus di isi '
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        if(User::create($validateData)){
            return redirect('/login')->with('success','Anda Berhasil Registrasi Silahkan Login sekarang untuk melanjutkan');
        }else{
            return "something wrong";
        }
    }
    public function login(Request $request){
        $data = $request->validate([
            'username'=>'required',
            'email'=>'required|email:dns',
            'password'=>'required'
        ]);
        if(Auth::attempt(['username'=>$data['username'],'password'=>$data['password'],'email'=>$data['email']])){
           if(Auth::user()->status != 'blacklist'){
               $request->session()->regenerate();
               return redirect()->intended('/client/home');
           }else{
               abort(404);
           }
        }
        return back()->with('loginError','Maaf Proses Login Gagal!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
