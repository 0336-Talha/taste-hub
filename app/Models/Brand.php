<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Brand extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected function name(): Attribute
    {
        return Attribute::make(
           
            // get: fn ($value) => strtolower($value),
                        // Getter - Convert to lowercase when retrieving
                        get: fn ($value) => ucwords($value),
    
                        // Setter - Convert to lowercase when saving (if you want it consistent)
                        // set: fn ($value) => strtolower($value),
        );
    }
}
