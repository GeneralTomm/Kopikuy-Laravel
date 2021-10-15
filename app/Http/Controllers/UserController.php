<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function editProfile($id,Request $request){
        $data = User::find($id);
        $validate = $request->validate([
            'email_verify'=>'required|email',
            'usernameVerify'=>'required|string',
            'passwordVerify'=>'required|string'
        ]);
        if(Auth::attempt(['username'=>$validate['usernameVerify'],'password'=>$validate['passwordVerify'],'email'=>$validate['email_verify']])){
            $validate = $request->validate([
                'username'=>'required|max:255',
                'email'=>'required|max:255|email'
            ]);
            if($request->hasFile('image')){
                $validasi = $request->validate([
                    'image'=>'image|mimes:jpg,png,jpeg'
                ]);
                $fileName;
                if($data->image == 'user.png'){
                    $fileName = $validasi['image']->store('profile');
                    $data->image = $fileName;
                    $data->username= $validate['username'];
                    $data->email = $validate['email'];
                    $data->save();
                }else{
                    if(Storage::delete($data->image)){
                        $fileName = $validasi['image']->store('profile');
                        $data->image = $fileName;
                        $data->username= $validate['username'];
                        $data->email = $validate['email'];
                        $data->save();
                    }else{
                        if(Storage::disk('local')->find($data->image)){
                            if(Storage::delete($data->image)){
                                $fileName = $validasi['image']->store('profile');
                                $data->image = $fileName;
                                $data->username= $validate['username'];
                                $data->email = $validate['email'];
                                $data->save();
                            }
                        }else{
                            $fileName = $validasi['image']->store('profile');
                            $data->image = $fileName;
                            $data->username= $validate['username'];
                            $data->email = $validate['email'];
                            $data->save();
                        }
                    }
                }
            }else{
                $data->username= $validate['username'];
                $data->email = $validate['email'];
                $data->save();
            }
            return back();
        }else{
            return back()->with('profile_error','Autentikasi Gagal !');

        }
    }
    public function create(){
        return view('admin.layout.user.add',['page'=>'user','title'=>'Add User','data'=>User::all()]);
    }
    public function unblacklist($id){
        $data = User::find($id);
        $data->status = "normal";
        $data->save();
        return redirect('/admin/user/index')->with('success','User telah di hapus dari daftar Blacklist');
    }
    public function blacklist($id){
       $data = User::find($id);
       $data->status = "blacklist";
       $data->save();
       return redirect('/admin/user/index')->with('success','User telah di blacklist');
    }
    public function index(){
        $data = User::all();
        return view('admin.layout.user.index',['page'=>'user','data'=>$data,'title'=>'Users']);
    }
    public function edit($id){
        $data = User::all();
        $edit = User::find($id);
        return view('admin.layout.user.edit',['page'=>'user','edit'=>$edit,'data'=>$data,'title'=>'Users']);

    }
    public function update(Request $request, $id){
        $validate = $request->validate([
            'first_name'=>'required|min:2|max:255',
            'last_name'=>'required|min:2|max:255',
            'username'=>'required|min:3|max:255',
            'role'=>'required',
            'email'=>'required|min:3|max:255',
            'gender'=>'required',
            'tgl_lahir'=>'required',
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
            'email.required'=>'E-mail Wajib di Isi',
            'email.min'=>'E-mail terlalu pendek',
            'email.max'=>'E-mail terlalu panjang',
            'gender.required'=>'Gender harus di isi',
            'tgl_lahir.required'=>'Tanggal Lahir harus di isi',

        ]);
        $data = User::find($id);
       
        if($request->hasFile('profile')){
            $validasi = $request->validate([
                'image'=>'image|mimes:jpg,png,jpeg'
            ]);
            $fileName;
            if($data->image == 'user.png'){
                $fileName = $request->file('profile')->store('profile');
                $data->first_name = $validate['first_name'];
                $data->last_name= $validate['last_name'];
                $data->username = $validate['username'];
                $data->email = $validate['email'];
                $data->gender = $validate['gender'];
                $data->role = $validate['role'];
                $data->tgl_lahir = $validate['tgl_lahir'];
                $data->image = $fileName;
                $data->save();
            }else{
                if(Storage::delete($data->image)){
                    $fileName = $request->file('profile')->store('profile');
                    $data->first_name = $validate['first_name'];
                    $data->last_name= $validate['last_name'];
                    $data->username = $validate['username'];
                    $data->email = $validate['email'];
                    $data->gender = $validate['gender'];
                    $data->role = $validate['role'];
                    $data->tgl_lahir = $validate['tgl_lahir'];
                    $data->image = $fileName;
                    $data->save();
                }else{
                    if(Storage::disk('local')->find($data->image)){
                        if(Storage::delete($data->image)){
                            $fileName = $request->file('profile')->store('profile');
                            $data->first_name = $validate['first_name'];
                            $data->last_name= $validate['last_name'];
                            $data->username = $validate['username'];
                            $data->email = $validate['email'];
                            $data->gender = $validate['gender'];
                            $data->role = $validate['role'];
                            $data->tgl_lahir = $validate['tgl_lahir'];
                            $data->image = $fileName;
                            $data->save();
                        }
                    }else{
                        $fileName = $request->file('profile')->store('profile');
                        $data->first_name = $validate['first_name'];
                        $data->last_name= $validate['last_name'];
                        $data->username = $validate['username'];
                        $data->email = $validate['email'];
                        $data->gender = $validate['gender'];
                        $data->role = $validate['role'];
                        $data->tgl_lahir = $validate['tgl_lahir'];
                        $data->image = $fileName;
                        $data->save();
                    }
                }
            }
        }else{
            $data->first_name = $validate['first_name'];
            $data->last_name= $validate['last_name'];
            $data->username = $validate['username'];
            $data->email = $validate['email'];
            $data->gender = $validate['gender'];
            $data->role = $validate['role'];
            $data->tgl_lahir = $validate['tgl_lahir'];
            $data->image = $fileName;
            $data->save();
        }
        return redirect('/admin/user/index')->with('success','Data User berhasil diganti');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'first_name'=>'required|min:2|max:255',
            'last_name'=>'required|min:2|max:255',
            'username'=>'required|min:3|max:255|unique:users',
            'role'=>'required',
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
            return redirect('/admin/user/add')->with('success','User Berhasil di tambahkan!');
        }else{
            return "something wrong";
        }
    }
    public function destroy(Request $request,$id){
        $data = User::find($id);
        if($data->image != 'user.png'){
            if(!Storage::disk('local')->has($data->image)){
                $data->delete();
                return redirect('/admin/user/index')->with('success','User Berhasil di Hapus');
            }else{
                if(Storage::delete($data->image)){
                    $data->delete();
                    return redirect('/admin/user/index')->with('success','User Berhasil di Hapus');
                }
            }
        }else{
            $data->delete();
            return redirect('/admin/user/index')->with('success','User Berhasil di Hapus');
        }
    }
}
