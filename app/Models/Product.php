<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $primaryKey = 'product_id';
    // protected $table = 'my_product';

    protected $guarded = [];
    
    // public $timestamps = false;

    public function category(){
        
        return $this->belongsTo(Category::class);
    
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    
}
