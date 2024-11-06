<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title', 'category', 'descriptions', 'quantity','new_price', 'old_price' , 'sold'
    ];

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function productAttribute()
    {
        return $this->hasMany(AttributeProduct::class);
    }
}
