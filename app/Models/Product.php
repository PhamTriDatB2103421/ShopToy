<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Stock',
        'so_luong_da_ban',
        'CategoryId',
    ];
    protected $primaryKey = 'ProductId';
    public $incrementing = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryId', 'CategoryId');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'ProductId', 'ProductId');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'ProductId','ProductId');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ProductId', 'ProductId');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'productdiscounts', 'ProductId', 'DiscountId');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}
