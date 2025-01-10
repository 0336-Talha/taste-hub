<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\Account;




class ProductReview extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productuser()
{
    // Here, we assume the ProductReview model has a product relationship, and Product model has user_id (owner)
    return $this->hasMany(Product::class, 'product_id');
}

    public function userAccount(){
        return $this->belongsTo(Account::class, 'user_id','user_id');
 
    }
}
