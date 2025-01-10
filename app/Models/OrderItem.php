<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductColors;

use App\Models\OrderTracking;


class OrderItem extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // public function getOwner(){

    // }
    public function trackingNumber()
    {
        return $this->belongsTo(OrderTracking::class,'order_trackings_id');
    }

    public function orderColor()
    {
        return $this->belongsTo(ProductColors::class,'color_id');
    }
}
