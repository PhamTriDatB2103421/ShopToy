<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'CartId',
        'ProductId',
        'Quantity',
    ];
    protected $table = 'cartitems';
    protected $primaryKey = 'CartItemId';
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }

}
