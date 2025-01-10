<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tbl_Country;

class Tbl_State extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded=[];
    protected $table="tbl_states";

    public function getCountry(){
        $this->belongsTo(Tbl_Country::class);
    }
}
