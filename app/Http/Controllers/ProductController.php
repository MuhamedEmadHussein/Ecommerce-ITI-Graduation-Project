<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    // public function product_dashboard(){
    //     return view('product.dashboard');
    // }
    public function create(){
        $data = Category::all();
        return view('product.createproduct',compact('data'));
    }
    public function index(){
        $categories = Category::all();
        $selectedCategory = request()->input('category_id');
        
        if ($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }

    return view('product.dashboard', compact('categories', 'products','selectedCategory'));
    }
    public function show($id){
        $product = Product::findOrFail($id);
        return view('show',compact('product'));
    }
    public function destroy($id){
      Product::findOrFail($id)->delete();
      return redirect()->route('product.dashboard');  
      
    }

    public function update($id){

      $product = Product::findOrFail($id);
      $categories = Category::where('id','!=',$product->category_id)->get();
      return view('product.updateproduct',compact('product','categories'));
      
    }
    public function edit(Request $request,$id){ 
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_availability'=>'required',
            'category_id'=>'required',
        ]);
        $product = Product::findOrFail($id);
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('products', $photo, 'myimages');
    
            $product->update([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_availability' => $request->product_availability,
                'category_id' => $request->category_id,
                'product_picture' => $path
            ]);
        } else {
            $product->update([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_availability' => $request->product_availability,
                'category_id' => $request->category_id,
            ]);
        }
        return redirect()->route('product.dashboard');
    }
    
    public function store(Request $request){
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_availability'=>'required',
            'category_id'=>'required',
        ]);
        $photo = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('products',$photo,'myimages');
        Product::create([
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_availability'=>$request->product_availability,
            'category_id'=>$request->category_id,
            'product_picture'=>$path
            ]); 
        return redirect()->route('product.dashboard');    
    }
    public function search(Request $request){
        // $search = $request->search;
        // $products = Product::where('product_name','like','%'.$search.'%')->get();
        
        // return view('index',compact('products'));
    $search = $request->search;
    $selectedCategory = $request->category_id;
    
    $productsQuery = Product::query();

    if ($search) {
        $productsQuery->where('product_name', 'like', '%' . $search . '%');
    }

    if ($selectedCategory) {
        $productsQuery->where('category_id', $selectedCategory);
    }
    
    $products = $productsQuery->get();
    
    $categories = Category::all();

    return view('product.dashboard', compact('products', 'categories', 'selectedCategory'));
    }
    public function shop(){
        $categories = Category::all();
        $selectedCategory = request()->input('category_id');
        
        if ($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }

        return view('product.shop',compact('categories','products','selectedCategory'));
    }
    public function shop_search(Request $request){
        $search = $request->search;
        $selectedCategory = $request->category_id;
        
        $productsQuery = Product::query();
    
        if ($search) {
            $productsQuery->where('product_name', 'like', '%' . $search . '%');
        }
    
        if ($selectedCategory) {
            $productsQuery->where('category_id', $selectedCategory);
        }
        
        $products = $productsQuery->get();
        
        $categories = Category::all();
        
        return view('product.shop',compact('categories','products','selectedCategory'));
    }
    public function make_order($id){    
        $product = Product::findOrFail($id);
        $order = Order::create([
            'price'=>$product->product_price * 1,
            'user_id'=>Auth::user()->id,
        ]);
        DB::table('order_product')->insert([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => 1,
         ]);
        //  $orders = Order::where('user_id', Auth::user()->id)->get();
         if(Auth::user()->admin==0){
            return redirect()->route('order.index');
         }else{
            return redirect()->route('admin.orders'); 
         }
        

    }

}
