<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home_dashboard(){
        $product_count = Product::count();
        $user_count = User::count();
        $category_count = Category::count();
        $order_count = Order::count();
        return view('dashboard.dashboard',compact('product_count','user_count','category_count','order_count'));
    }
}
