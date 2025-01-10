<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Tbl_State;
use App\Models\Prodcut;
use App\Models\User;
use App\Models\Account;


use App\Models\Tbl_Country;



class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function items()
{
    return $this->hasMany(OrderItem::class);
}

    public function userProduct(){
        // return $this->belongsTo(OrderItem::class,'id','order_id')->with('items');
        return $this->hasManyThrough(Product::class, OrderItem::class, 'order_id', 'id', 'id', 'product_id');
    }

    

    // public function diffShip(){
    //     return $this->hasOne(Order::class,'id');
    // }

    // public function orderGiver() {
    //     return $this->hasOne( User::class, 'id', 'user_id');
    // }
    public function orderMaker() {
        return $this->hasOne( Account::class, 'user_id', 'user_id');
    }


    public function diffShip() {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function getState() {
        return $this->hasOne(Tbl_State::class, 'id', 'state_id');
    }

    public function getCountry() {
        return $this->hasOne(Tbl_Country::class, 'id', 'country_id');
    }
}
