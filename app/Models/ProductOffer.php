<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account; 
use App\Models\Product;  


class ProductOffer extends Model
{ 
    use HasFactory;

    protected $guarded=[];

    public function userAccount(){
        return $this->belongsTo(Account::class, 'user_id', 'user_id'); 
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }
}
