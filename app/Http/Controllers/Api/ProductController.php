<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        return response()->json(['data'=>$products,'message'=>'Data Returned Successfully',"status"=>200]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name'=>'required|string|min:3',
            'product_price'=>'required|numeric',
            'product_availability'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'product_picture'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['message'=>$validator->errors(),"status"=>400]); 
        }
        
        try{
            $products = Product::create($request->all());
        }catch(Throwable $th){
            return response()->json(['message'=>'Server Error',"status"=>503]);

        }
        return response()->json(['data'=>$products,'message'=>'Data Inserted Successfully',"status"=>201]);

    }
    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json(['data'=>$product,'message'=>'Product Returned Successfully',"status"=>200]);

        }
        return response()->json(['message'=>"Product Doesn't Exists","status"=>404]);

    }
    public function destroy($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json(['message'=>'Product Deleted Successfully',"status"=>200]);

        }
        return response()->json(['message'=>"Product Doesn't Exists","status"=>404]);
    }

    public function edit($id,Request $request){
        $product = Product::find($id);
        if($product){
            $updated=$product->update($request->all());
            if($updated){
                return response()->json(['data'=>$product,'message'=>'Product Updated Successfully',"status"=>200]);
            }

        }
        return response()->json(['message'=>"Product Doesn't Exists","status"=>404]);
    }
}
