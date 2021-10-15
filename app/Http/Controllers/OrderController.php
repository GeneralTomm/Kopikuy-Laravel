<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finish($id){
        $kodeOrder = Order::find($id)->kodeOrder;
        $pesanan  = Order::where('kodeOrder','=',$kodeOrder)->update(['status'=>'ready']);
        return redirect('/worker/order')->with('success','Pesanan Sudah selesai di kerjakan !');
    }
    public function orderan($id){
        $kodeOrder = Order::find($id)->kodeOrder;
        $pesanan = Order::join('products','products.id','=','orders.productId')->where('orders.kodeOrder','=',$kodeOrder)->get();
        return view('Worker.layouts.order-list',['data'=>$pesanan,'title'=>'Daftar Pesanan','id'=>$id,'status'=>Order::find($id)->status]);
    }
    public function accept($id){
        $data =Order::find($id)->kodeOrder;
        $pesanan  = Order::where('kodeOrder','=',$data)->update(['status'=>'working']);
        return redirect('/worker/order')->with('success','Pesanan sudah diterima Selamat bekerja !');
    }
    public function home(){
        return view("Worker.dashboard",['title'=>'Dashboard']);
    }
    public function index()
    {
        //$data = Order::select('users.username')->join('users','users.id','=','orders.userId')->groupBy('order.kodeOrder')->get();
        $data = Order::join('users','users.id','=','orders.userId')->select('orders.id','users.username','orders.subtotal','orders.status')->groupBy('orders.kodeOrder')->get();
        return view('Worker.layouts.pesanan',['data'=>$data,'title'=>'Pesanan']);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
