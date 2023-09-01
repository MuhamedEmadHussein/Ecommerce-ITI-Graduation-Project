<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $products = Product::get();
        return $this->apiResponse($products,'Data Returned Successfully',200);
    }
    public function sort_products(Request $request){
        $validatedData = $request->validate([
            'sort' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1',
        ]);

        $sorts = explode(',',$request->input('sort',''));

        $query = Product::query();

        foreach($sorts as $sortColumn){
            $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
            $sortColumn = ltrim($sortColumn,'-');
            $query->orderBy($sortColumn,$sortDirection);
        }
        
        $per_page = $validatedData['per_page'] ?? 20;
        $results = $query->paginate($per_page);
        
        return $this->apiResponse($results,'Data Sorted Successfully',200);

    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name'=>'required|string|min:3',
            'product_price'=>'required|numeric',
            'product_availability'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'product_picture'=>'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        $photo = $request->file('product_picture')->getClientOriginalName();
        $filename = time() . '_' . $photo; 
        $path = $request->file('product_picture')->storeAs('products', $filename, 'myimages');

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
    }
        
        try{
            $products = Product::create([
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'product_availability'=>$request->product_availability,
                'category_id'=>$request->category_id,
                'product_picture'=>$path
                ]); 
        }catch(Throwable $th){
            return $this->apiResponse(null,'Server Error',503);
        }
        return $this->apiResponse($products,'Data Inserted Successfully',201);

    }
    public function show($id){
        $product = Product::find($id);
        if($product){
            return $this->apiResponse($product,'Product Returned Successfully',200);

        }
        return $this->apiResponse(null,"Product Doesn't Exists",404);

    }
    public function destroy($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return $this->apiResponse(null,'Product Deleted Successfully',200);

        }
        return $this->apiResponse(null,"Product Doesn't Exists",404);
}

    public function edit(Request $request,$id){
        $product = Product::find($id);

        if($product){
            if ($request->hasFile('product_picture')) {
                $photo = $request->file('product_picture')->getClientOriginalName();
                $filename = time() . '_' . $photo; 
                $path = $request->file('product_picture')->storeAs('products', $filename, 'myimages');
    
                $updated = $product->update([
                    'product_name' => $request->product_name ?? $product->product_name,
                    'product_price' => $request->product_price ?? $product->product_price,
                    'product_availability' => $request->product_availability ?? $product->product_availability,
                    'category_id' => $request->category_id ?? $product->category_id,
                    'product_picture' => $path
                ]);
            } else {
                $updated = $product->update([
                    'product_name' => $request->product_name ?? $product->product_name,
                    'product_price' => $request->product_price ?? $product->product_price,
                    'product_availability' => $request->product_availability ?? $product->product_availability,
                    'category_id' => $request->category_id ?? $product->category_id,
                ]);
            }
            if($updated){
                return $this->apiResponse($product,'Product Updated Successfully',200);
        }

        }
        return $this->apiResponse(null,"Product Doesn't Exists",404);

}
    public function products_search(Request $request){
        if($request->name){
            $result = Product::where('product_name','like',"%".$request->name."%")->get();
        }
        if($request->has('category')){
            $category = $request->input('category');

            $result = Product::with('category')
                ->whereHas('category', function ($query) use ($category) {
                    $query->where('name','like', '%'.$category.'%');
                })
                ->get();
        }
        if($result){
            return $this->apiResponse($result,'Products Founded',200);
        }else{
            return $this->apiResponse(null,"Product Doesn't Exists",404);  
        }
    }
}
