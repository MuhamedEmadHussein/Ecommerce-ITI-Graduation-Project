<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->admin == 1){
            $orders = Order::get();
        }else{
            $orders = Order::where('user_id', Auth::user()->id)->get();
        }
            
        return view('order.dashboard', compact('orders'));
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function make_order(Request $request, $id){    
        $product = Product::findOrFail($id);
        $order = Order::create([
            'price'=>$product->product_price * $request->quantity,
            'user_id'=>Auth::user()->id,
        ]);
        DB::table('order_product')->insert([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => $request->quantity,
         ]);
        //  $orders = Order::where('user_id', Auth::user()->id)->get();
         if(Auth::user()->admin==0){
            return redirect()->route('order.index');
         }else{
            return redirect()->route('admin.orders'); 
         }
        

    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $product = Product::findOrFail($id);
       return view('order.showdashboard', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Order::where('user_id', Auth::user()->id)
        ->where('id', $id) 
        ->delete();        
        return redirect()->back();
    }
    public function getAdminOrders(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('order.adminorder', compact('orders'));
    }
}
