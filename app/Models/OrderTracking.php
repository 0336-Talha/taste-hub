<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'order_trackings';
    protected $id = 'id';


    public function orderItems()
    {
    return $this->hasMany(OrderItem::class, 'order_trackings_id');
    }

    public function order()
    {
    return $this->belongsTo(Order::class);
    }
}
