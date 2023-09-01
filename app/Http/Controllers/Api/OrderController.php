<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->admin == 1){
            $orders = Order::get();
            return $this->apiResponse($orders,'Data Returned Successfully',200);

        }else{
            $orders = Order::where('user_id', Auth::user()->id)->get();
            return $this->apiResponse($orders,'Data Returned Successfully',200);
        }
    }
    public function getAdminOrders(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return $this->apiResponse($orders,'Data Returned Successfully',200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        if ($order->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
       
        // Order::where('user_id', Auth::user()->id)
        // ->where('id', $id) 
        // ->delete();   
        $order->delete();  
        return $this->apiResponse(null,'Order Deleted Successfully',200);


        
    }
    public function make_order(Request $request, $id){    
        $product = Product::findOrFail($id);
        $quantity = $request->quantity ?? 1;
        $quantity = max(1, intval($quantity));
        $order = Order::create([
            'price'=>$product->product_price * $quantity,
            'user_id'=>Auth::user()->id,
        ]);
        
        DB::table('order_product')->insert([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => $quantity,
         ]);

        if (Auth::user()->admin == 1){
            $orders = Order::get();
            return $this->apiResponse($orders,'Order Added & Data Returned Successfully',200);

        }else{
            $orders = Order::where('user_id', Auth::user()->id)->get();
            return $this->apiResponse($orders,'Order Added & Data Returned Successfully',200);
        }    
    }

}
