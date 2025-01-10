<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;


class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function product()

    //id jo mery product table ki product_id wishlist table ki
    {
        // return $this->hasMany(Product::class,'id','product_id');
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function User()

    //id jo mery product table ki product_id wishlist table ki
    {
        // return $this->hasMany(Product::class,'id','product_id');
        return $this->belongsTo(User::class, 'user_id');
    }
}
