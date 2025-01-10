<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Account extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function accountUser(){
        return $this->hasOne(User::class,'id','user_id'); 
     }
}
