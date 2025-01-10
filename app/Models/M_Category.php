<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_Category;

class M_Category extends Model
{
    use HasFactory;
    protected $table = 'm_categories';
    
    protected $primaryKey = 'm_id';

    protected $guarded=[];

    public function subCategories()
    {
        return $this->hasMany(Sub_Category::class,'m_id');
    }
}
