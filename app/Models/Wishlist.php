<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductPhotos;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded=[];

    // public function product()

    // //id jo mery product table ki product_id wishlist table ki
    // {
    //     // return $this->hasMany(Product::class,'id','product_id');
    //     return $this->belongsTo(Product::class, 'product_id');
    // }


        // Define the relationship with User
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
    
        // Define the relationship with Product
        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }

    // only one image
    // public function firstPhoto()
    // {
    //     return $this->hasOne(ProductPhotos::class)->orderBy('id','asc');
    // }

}
