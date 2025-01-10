<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\M_Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sub_Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'sub__categories';




    protected $primaryKey = 'sub_id';


    protected function name(): Attribute
    {
        return Attribute::make(
           
            // get: fn ($value) => strtolower($value),
                        // Getter - Convert to lowercase when retrieving
                        get: fn ($value) => ucwords($value),
    
                        // Setter - Convert to lowercase when saving (if you want it consistent)
                        set: fn ($value) => strtolower($value),
        );
    }
    public function MainCategory()
    {
        return $this->belongsTo(M_Category::class,'m_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_id');
    }
}
