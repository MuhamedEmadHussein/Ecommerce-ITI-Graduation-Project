<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::get();
        return $this->apiResponse($categories,'Data Returned Successfully',200);

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
        $validator = Validator::make($request->all(), [
            'category_name' => 'required' 
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        try{
            $category = Category::create([
                'name' => $request->input('category_name') 
            ]);
        }catch(Throwable $th){
            return $this->apiResponse(null,'Server Error',503);

        }
        return $this->apiResponse($category,'Data Inserted Successfully',201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if ($category){
            return $this->apiResponse($category,'Category Returned Successfully',200);
        }
        return $this->apiResponse(null,"Category Doesn't Exists",404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $category = Category::find($id);
        if($category){
            $updated = $category->update([
                'name' => $request->category_name
            ]);
            if($updated){
                return $this->apiResponse($category,'Category Updated Successfully',200);
            }
        }
        return $this->apiResponse(null,"Category Doesn't Exists",404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return $this->apiResponse(null,'Category Deleted Successfully',200);

        }
        return $this->apiResponse(null,"Category Doesn't Exists",404);
    }
}
