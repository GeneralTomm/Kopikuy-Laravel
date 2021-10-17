<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
#guest Models
use App\Models\Records;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
#----------------------
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kodetransaksi(Request $request){
        $msg = [
            'password.required'=>'Password Wajib Di isi',
            'password.string'=>'Format Password Anda Salah',
        ];
        $validate = $request->validate([
            'password'=>'required',
            'username'=>'required',
            'email'=>'required',
            'idtransaksi'=>'required|string'
        ],$msg);
        if(Auth::attempt(['username'=>$validate['username'],'password'=>$validate['password'],'email'=>$validate['email']])){
            $data = Transaction::find($validate['idtransaksi'])->kodetransaksi;
            return redirect('/client/profile')->with('kode',$data);            
        }else{
            return redirect('/client/profile')->with('error','Data yang masukan tidak tepat');
        }
    }
    public function history(){
        $belum = Transaction::latest()->where('userId','=',Auth::user()->id)->where('status','=','no')->get();
        $sudah = Transaction::where('userId','=',Auth::user()->id)->where('status','=','ok')->get();
        return view('profile',['title'=>'Profile','belum'=>$belum,'sudah'=>$sudah]);
    }
    public function dashboard(){
        $data = Transaction::join('orders','orders.kodetransaksi','=','transactions.kodetransaksi')
                            ->join('products','orders.productId','=','products.id')
                            ->where('transactions.recap','=','true')
                            ->groupBy('products.product')
                            ->selectRaw('sum(orders.quantity) as total,products.product')
                            ->get();
        return view('admin.index',['page'=>'dashboard','title'=>'Dashboard','data'=>$data]);
    }
    public function produk($date){
        $data = Transaction::where('date','=',$date)
                            ->join('orders','orders.kodetransaksi','=','transactions.kodetransaksi')
                            ->join('products','orders.productId','=','products.id')
                            ->groupBy('orders.productId')
                            ->selectRaw('sum(orders.quantity) as quantity ,products.image,products.product')
                            ->orderBy('quantity')
                            ->get();
        return view('admin.layout.rekap.produk',['title'=>'product','page'=>'report','data'=>$data]);
    }
    public function showRecap(){
        $data = Transaction::groupBy('date')->where('recap','=','true')->selectRaw('sum(grandtotal) as total ,date')->get();
        return view('admin.layout.rekap.hasil',['data'=>$data,'title'=>'Hasil Rekap','page'=>'report']);
    }
    public function Rekap(Request $request, $tgl){
          $data = Transaction::where('date','=',$tgl)->get();
        if(count(json_decode($data)) > 0){
             $auth = Transaction::where('date','=',$tgl)->where('status','=','no')->get();
            if(count(json_decode($auth)) > 0){
                return redirect('/admin/rekap/index')->with('failed','Tidak bisa Merekap Transaksi Karena masih ada transaksi yang belum dikonfirmasi !');
            }else{
                if(Transaction::where('date','=',$tgl)->update(['recap'=>'true'])) {
                    return redirect('/admin/rekap/index')->with('success','Transaksi Berhasil di rekap');
                }
            }
        }
    }
    public function indexRekap(){
        $data = Transaction::select('date')->where('recap','=','false')->get();
        return view('admin.layout.rekap.index',['page'=>'report','title'=>'Rekap','data'=>$data]);
    }
    public function loadTransaksi(Request $request){
        $validate = $request->validate([
            'date'=>'required|string'
        ]);
        $data = Transaction::where('date','=',$validate['date'])->get();
        return redirect('/admin/rekap/index')->with('transaksi',$data);
    }
    public function detail($id){
      $data = Transaction::join('users','users.id','transactions.userId')
                           ->where('transactions.id','=',$id)
                           ->select(
                                    'transactions.bukti',
                                    'transactions.kodetransaksi',
                                    'users.first_name',
                                    'users.last_name',
                                    'users.username',
                                    'transactions.pengambilan',
                                    'transactions.status as statusTransaksi',
                                    'transactions.penerima',
                                    'transactions.date',
                                    'transactions.metodePembayaran',
                                    'transactions.grandtotal as subtotal')
                           ->first();
      $product = Transaction::join('orders','transactions.kodetransaksi','=','orders.kodetransaksi')
                            ->join('products','orders.productId','=','products.id')
                            ->where('transactions.id','=',$id)
                            ->select('products.image','products.product','orders.quantity')
                            ->get();

    $kodetransaksi = Transaction::find($id)->kodetransaksi;
     $countProduct = Transaction::where('transactions.kodetransaksi','=',$kodetransaksi)
                                ->join('orders','transactions.kodetransaksi','=','orders.kodetransaksi')
                                ->groupBy('transactions.kodetransaksi')
                                ->selectRaw('sum(quantity) as quantity,transactions.kodetransaksi')
                                //->get();                               
                                ->sum('orders.quantity');
      return view('admin.layout.transaksi.detail',['totalPembelian'=>$countProduct,'data'=>$data,'product'=>$product,'page'=>'transaksi','title'=>"Detail"]);
    }
    public function search(Request $request){
      $validate = $request->validate([
        'search'=>'required|string'
      ]);
      $data = Transaction::join('users','users.id','=','transactions.userId')
                           ->where('users.username','like','%'.$validate['search'].'%')
                           ->orWhere('users.first_name','like','%'.$validate['search'].'%')
                           ->orWhere('users.last_name','like','%'.$validate['search'].'%')
                           ->orWhere('transactions.kodetransaksi','like','%'.$validate['search'].'%')
                           ->select('transactions.kodetransaksi','users.first_name','users.last_name','users.username','users.email','transactions.id as idTransaksi')
                           ->get();
      return view('admin.layout.transaksi.index',['title'=>'Transaksi','data'=>$data,'page'=>'transaksi']);

    }
    public function index()
    {
        $data = Transaction::join('users','users.id','=','transactions.userId')
                            ->select('transactions.kodetransaksi','users.first_name','users.last_name','users.username','users.email','transactions.id as idTransaksi')
                            ->groupBy('transactions.userId')
                            ->get();
        return view('admin.layout.transaksi.index',['title'=>'Transaksi','data'=>$data,'page'=>'transaksi']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(){
        $title = 'Cari Kode';
        return view('Worker.layouts.payment',compact('title'));
    }
    public function accept($id){
        $data = Transaction::find($id);
        $data->status = 'ok';
        $data->save();
        return redirect('/worker/konfirmasi')->with('success','Anda Telah mengkonfirmasi Proses transaksi ini!');
    }
    public function decline($id){
        $data = Transaction::find($id);
        $data->status= 'no';
        $data->save();
        return redirect('/worker/konfirmasi')->with('success','Proses Pengiriman Bukti transaksi akan di kirim kembali !');
    }
    public function findTransaction(Request $request){
        $validate = $request->validate([
            'code'=>'required'
        ]);
        $statusTransaksi= Transaction::where('kodetransaksi','=',$validate['code'])->first();
        $data = Transaction::join('users','users.id','=','transactions.userId')
                            ->join('orders','users.id','=','orders.userId')
                            ->where('transactions.kodetransaksi','=',$validate['code'])
                            ->select('transactions.kodetransaksi','transactions.bukti','transactions.id','users.first_name','users.last_name','users.username','transactions.penerima','orders.status as statusOrder','transactions.grandtotal as subtotal','transactions.metodePembayaran','transactions.pengambilan')
                            ->first();
        if(empty($data)){
            return view('Worker.layouts.confirmation-form',['title'=>'Konfirmasi','error'=>'404']);
       }else{
        $totalItem = Order::where('kodetransaksi','=',$data->kodetransaksi)->sum('quantity');
        return view('Worker.layouts.confirmation-form',['statusTransaksi'=>$statusTransaksi,'data'=>$data,'title'=>'Konfirmasi','pesanan'=>$totalItem]);
       }
    }
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $validate = $request->validate([
            'penerima'=>'required|max:255',
            'metodePembayaran'=>'required|in:cash,virtual',
            'pengambilan'=>'required|in:kasir,drive',
        ],);
        $grandtotal = Cart::where('userId','=' ,$id)->sum('subtotal');
        $token = Str::random(4);
        $kodetransaksi = Str::random(5);
        if($validate['metodePembayaran'] == 'virtual' && $request->hasFile('bukti')){
            $message = ['bukti.image'=>'File yang anda masukan Harus berupa Image'];
            $validateImage = $request->validate(['bukti'=>'image'],$message);
            $fileName = $validateImage['bukti']->store('bukti_transaksi');
            $transaksi = [
                'date'=>date('Y-m-d'),
                'userId'=>$id, 'grandtotal'=>$grandtotal,
                'metodePembayaran'=>$validate['metodePembayaran'],
                'pengambilan'=>$validate['pengambilan'],
                'bukti'=>$fileName,
                'kodetransaksi'=>$kodetransaksi,
                'token'=>$token,
                'status'=>'no',
                'penerima'=>$validate['penerima'],
                'recap'=>'false'
            ];

            if(Transaction::create($transaksi)){
                $data = Cart::where('userId','=',$id)->get();
                foreach ($data as $key) {
                    $pesanan = [
                        'kodeOrder'=>Str::random(5),
                        'kodetransaksi'=>$kodetransaksi,
                        'userId'=>$key->userId,
                        'productId'=>$key->productId,
                        'quantity'=>$key->quantity,
                        'subtotal'=>$key->subtotal
                    ];
                    $records = [
                        'userId'=>$key->userId,
                        'productId'=>$key->productId,
                        'quantity'=>$key->quantity,
                        'subtotal'=>$key->subtotal
                    ];
                     if(Order::create($pesanan)){
                        if(Records::create($records)){
                            Cart::find($key->id)->delete();
                        }
                     }
                }
            }
        }else if($validate['metodePembayaran'] == 'cash' && !$request->hasFile('bukti')){
            $data = [
                'date'=>date('Y-m-d'),
                'userId'=>$id,
                'grandtotal'=>$grandtotal,
                'metodePembayaran'=>$validate['metodePembayaran'],
                'pengambilan'=>$validate['pengambilan'],
                'bukti'=>'-',
                'kodetransaksi'=>$kodetransaksi,
                'token'=>Str::random(4),
                'status'=>'no',
                'penerima'=>$validate['penerima'],
                'recap'=>'false'
            ];
            if(Transaction::create($data)){
                $data = Cart::where('userId','=',$id)->get();
                $kodeOrder=Str::random(5);
                foreach ($data as $key) {
                    $records = [
                        'userId'=>$key->userId,
                        'productId'=>$key->productId,
                        'quantity'=>$key->quantity,
                        'subtotal'=>$key->subtotal
                    ];
                    $pesanan = [
                        'kodeOrder'=>$kodeOrder,
                        'kodetransaksi'=>$kodetransaksi,
                        'userId'=>$key->userId,
                        'productId'=>$key->productId,
                        'quantity'=>$key->quantity,
                        'subtotal'=>$key->subtotal
                    ];
                    if(Order::create($pesanan)){
                        if(Records::create($records)){
                            Cart::find($key->id)->delete();
                        }
                    }
                }
             }
        }
        return view('waiting',['title'=>'Waiting','token'=>$token,'kodetransaksi'=>$kodetransaksi,'method'=>$validate['metodePembayaran']]);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

    }
}
