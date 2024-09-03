<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Nescription',
        'Price',
        'Stock',
        'CategoryId',
    ];
    protected $primaryKey = 'ProductId';
    // Nếu khóa chính  tự động tăng
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
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'product_discounts');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
