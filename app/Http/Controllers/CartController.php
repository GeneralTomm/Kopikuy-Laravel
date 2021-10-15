<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(){
        $data = Cart::where('userId','=',Auth::user()->id)->get();
        $angka =Cart::where("userId",'=',Auth::user()->id)->sum('quantity');
        $subtotal = Cart::where("userId",'=',Auth::user()->id)->sum('subtotal');
        $product = Cart::join('products','carts.productId','products.id')
                        ->where('carts.userId','=',Auth::user()->id)
                        ->select('products.*','carts.*')
                        ->get();
        return view('checkout',['title'=>'Check Out','data'=>$product, 'items'=>$angka,'subtotal'=>$subtotal]);
    }
    public function index()
    {
        $data = Cart::where('userId','=',Auth::user()->id)->get();
        $angka =Cart::where("userId",'=',Auth::user()->id)->sum('quantity');
        $subtotal = Cart::where("userId",'=',Auth::user()->id)->sum('subtotal');
        $product = Cart::join('products','carts.productId','products.id')
                        ->where('carts.userId','=',Auth::user()->id)
                        ->select('products.*','carts.*')
                        ->get();
        return view('cart',['title'=>'Cart','data'=>$product, 'items'=>$angka,'subtotal'=>$subtotal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'productId'=>'required',
            'quantity'=>'required|integer|min:1',
            'subtotal'=>'required|integer|min:3'
        ],[
            'productId.required'=>'Maaf, terjadi kesalahan saat mengkonfirmasi Kode Produk. Silahkan refresh ',
            'quantity.required'=>'Maaf, sistem tidak dapat memproses jumlah pesanan kosong',
            'quantity.integer'=>'Maaf, nilai yang dimasukan bukanlah sebuah angka',
            'quantity.min'=>'Maaf , pesanan yang anda masukan kosong',
            'subtotal.required'=>'Maaf, silahkan refresh Browser anda terjadi kesalahan saat memproses subtotal',
            'subtotal.integer'=>'Maaf , subtotal harus berupa angka',
            'subtotal.min'=>'Sub total terlalu pendek'
        ]);
        $old =Product::find($validate['productId']);
        if($validate['quantity'] == 0 || $validate['quantity'] < 1){
            return view('detail',['title'=>'Menu','data'=>$old,'recommendation'=>Product::inRandomOrder()->where('status','=','open')->limit(4)->get()])->with('error','Menu '.$old->product.' tidak ditambahkan karena bernilai 0');
        }else{
            if(Cart::create([
                'userId'=>Auth::user()->id,
                'productId'=>$validate['productId'],
                'quantity'=>$validate['quantity'],
                'subtotal'=>$validate['subtotal']
            ])){
                return view('detail',['title'=>'Menu','data'=>$old,'recommendation'=>Product::inRandomOrder()->where('status','=','open')->limit(4)->get()])->with('success','Menu '.$old->product.' berhasil dimasukan kedalam keranjang');
                
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart,$id)
    {
        $validate = $request->validate([
            'newQuantity'=>'required|integer|',
        ]);
        $data = Cart::find($id);
        $price = Product::find($data->productId)->price;
        $subtotal = $price * $validate['newQuantity'];
        $data->quantity  = $validate['newQuantity'];
        $data->subtotal = $subtotal;
        if($data->save()){
            return redirect('/client/cart')->with('success','Orderan berhasil diedit');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart,$id)
    {
        if(Cart::find($id)->delete()){
            return redirect('/client/cart')->with('success','Orderan berhasil di hapus');
        }
    }
}
