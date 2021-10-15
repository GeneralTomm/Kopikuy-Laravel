<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $data = Product::where('product','like','%'.$request->keyword.'%')->get();
        return view('menu',['type'=>'search','data'=>$data,'title'=>'Menu']);
    }
    public function detail($id){
        return view('detail',['title'=>'Detail','data'=>Product::find($id),'recommendation'=>Product::inRandomOrder()->where('status','=','open')->limit(4)->get()]);
    }
    public function index()
    {
        $testimonial = Testimonial::inRandomOrder()->join('users','users.id','testimonials.userId')->select('users.image','users.first_name','users.last_name','testimonials.testimoni')->get();
        return view('index',['title'=>'Home','data'=>Product::inRandomOrder()->where('status','=','open')->limit(4)->get(),'testimonial'=>$testimonial]);
    }
    public function admin(){
        return view('admin.layout.products.index',['page'=>'product','data'=>Product::all(),'title'=>'Products']);
    }
    public function menu(){
        return view('menu',['type'=>'default','data'=>Product::where('status','=','open')->paginate(8),'title'=>'Menu']);
    }
    public function category($category){
        return view('menu',['type'=>'search','data'=>Product::where('category','=',$category)->get(),'title'=>'Menu']);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layout.products.add',['page'=>'product','title'=>'Add Product']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product'=>'required|max:255|min:2',
            'price'=>'required|max:255|min:3',
            'category'=>'required',
            'image'=>'required|image',
            'status'=>'required|in:open,closed',
            'description'=>'required'
        ],[
            'product.required'=>'Nama Produk Harus di masukan',
            'product.max'=>'Nama Produk Kepanjangan',
            'product.min'=>'Nama Produk terlalu Pendek',
            'price.required'=>'Harga Produk harus ditetapkan ',
            'price.max'=>'Harga Produk terlalu panjang!',
            'price.min'=>'Harga Produk terlalu pendek',
            'category'=>'kategori produk wajib di isi',
            'image.required'=>'Gambar Produk Wajib di isi',
            'image.image'=>'File yang anda Masukan bukan sebuah Gambar',
            'status.in'=>'Status yang anda masukan tidak Valid',
            'status.required'=>'Status Produk Wajib di isi',
            'description.required'=>'Deskripsi Produk wajib di isi',
            'description.max'=>'Deskripsi produk terlalu panjang'
        ]);
        if($request->hasFile('image')){
            $validate['image'] = $validate['image']->store('product');
            if(Product::create($validate)){
                return redirect('/admin/product/index')->with('success','Product : anda berhasil menambahkan produk dengan nama : '.$validate['product']);
            }else{
                return redirect('/admin/product/index')->with('failed','Produk dengan nama : '.$validate['product'].' tidak dapat ditambahakan');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        return view('admin.layout.products.edit',['page'=>'product','data'=>Product::find($id),'title'=>'Edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {
        $validate = $request->validate([
            'product'=>'required',
            'price'=>'required',
            'category'=>'required',
            'status'=>'required',
            'description'=>'required'
        ],[
            'product.required'=>'Nama Produk wajib di isi!',
            'price.required'=>'Harga Wajib di isi',
            'status.required'=>'Status produk wajib di isi',
            'description.required'=>"deskripsi produk wajib di isi"
        ]);
        $data = Product::find($id);
        if($request->hasFile('image')){
            $validate['image'] = $validate['image']->store('product');
            if(Storage::delete($data->image)){
                $data->product = $validate['product'];
                $data->image = $validate['image'];
                $data->price = $validate['price'];
                $data->status = $validate['status'];
                $data->description = $validate['description'];
                $data->category = $validate['category'];
                $data->save();
            }else{
                if(!Storage::disk('local')->has($data->image)){
                    $data->product = $validate['product'];
                    $data->image = $validate['image'];
                    $data->price = $validate['price'];
                    $data->status = $validate['status'];
                    $data->description = $validate['description'];
                    $data->category = $validate['category'];
                    $data->save();
                }
            }
        }else{
            $data->product = $validate['product'];
            $data->price = $validate['price'];
            $data->status = $validate['status'];
            $data->description = $validate['description'];
            $data->category = $validate['category'];
            $data->save();
        }
        return redirect('/admin/product/index')->with('success','Data berhasil di update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
        $data = Product::find($id);
        if(Storage::delete($data->image)){
            if($data->delete()){
                return redirect('/admin/product/index')->with('success','Produk : Data berhasil di hapus');
            }else{
                return redirect('/admin/product/index')->with('failed','Produk Gagal Di hapus karena sebuah kesalahan');
            }
        }else{
            if(!Storage::disk('local')->has($data->image)){
                if($data->delete()){
                    return redirect('/admin/product/index')->with('success','Produk : Data berhasil di hapus');
                }
            }
        }
    }
}
