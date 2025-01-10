<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPhotos;
use App\Models\Brand;
use App\Models\Account;
use App\Models\User;
use App\Models\productColors;
use App\Models\productSize;
use App\Models\OwnerReview;
use App\Models\productOffer;






use App\Models\ProductReview;



use App\Models\M_Category;

use App\Models\Wishlist;





class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function productPhotos()
    {
        return $this->hasMany(ProductPhotos::class,'product_id');
    }

    
    public function productColors()
    {
        return $this->hasMany(ProductColors::class,'product_id');
    }

    public function productSize()
    {
        return $this->hasMany(ProductSize::class,'product_id');
    }


    public function firstPhoto()
{
    return $this->hasOne(ProductPhotos::class)->orderBy('id','asc');
}

public function brand()
{
    return $this->belongsTo(Brand::class);
}

public function subCategory()
{
    return $this->belongsTo(Sub_Category::class,'sub_id');
}

// getproductColors unique colors
public function getProductCol()
{
    return $this->hasOne(ProductColors::class,'product_id','id');
}
//unique size
public function getProductSiz()
{
    return $this->hasOne(ProductSize::class,'product_id','id');
}

public function productuser()
{
    return $this->hasOne(Account::class,'user_id','user_id');
}

public function productusername()
{
    return $this->hasOne(User::class,'id','user_id');
}

public function orders()
{
    return $this->hasManyThrough(Order::class, OrderItem::class);
}


public function mainCategory(){
    return $this->belongsTo(M_Category::class,'m_id');
}

public function productReview()
{
    return $this->belongsTo(ProductReview::class,'id','product_id');
}

public function ownerReview()
{
    return $this->hasOneThrough(OwnerReview::class, User::class, 'id', 'product_owner_id', 'user_id', 'id');
}

// public function productusering()
// {
//     // This will return the user who is the owner of this product
//     return $this->belongsTo(User::class, 'user_id');
// }

public function ratings()
{
    // This will get all reviews of this product and also load the associated product owner (user) info
    return $this->hasMany(ProductReview::class, 'product_id');
                // ->with('productUser'); // This will load the product owner details (user)
}
 
public function productOffer(){ 
    return $this->hasOne(ProductOffer::class, 'product_id');
  
}


 
public function productAllOffer(){ 
    return $this->hasMany(ProductOffer::class, 'product_id');
  
}


    

}

