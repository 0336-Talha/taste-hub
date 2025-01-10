<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\OwnerReview;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'number',
    ];

   
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ownerRating()
{
    return $this->hasOne(OwnerReview::class,'product_owner_id','id');
}

public function ownerRatings()
{
    return $this->hasMany(OwnerReview::class,'product_owner_id','id');
}


public function wishlists()
{
    return $this->hasMany(Wishlist::class, 'user_id');
}

// Optionally, you can also directly fetch the products for convenience
public function productsInWishlist()
{
    return $this->hasManyThrough(Product::class, Wishlist::class, 'user_id', 'id', 'id', 'product_id');
}


}
