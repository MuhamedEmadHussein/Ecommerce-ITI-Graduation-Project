<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $selectedCategory = request()->input('id');
        
        if ($selectedCategory) {
            $categories = Category::where('id', $selectedCategory)->get();
        } else {
            $categories = Category::all();
        }
        return view('category.dashboard', compact('categories','selectedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_name' => 'required' 
        ]);
    
        Category::create([
            'name' => $request->input('category_name') 
        ]);
    
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    //     $category = Category::findOrFail($id);
    //    return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->category_name
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $category = Category::findOrFail($id);
        return view('category.update',compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('category.index');  
        
    }
}
