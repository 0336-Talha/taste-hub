<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site_Page extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts=[
        'meta_data'=>'json',
    ];
}
