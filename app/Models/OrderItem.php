<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderId',
        'ProductId',
        'Quantity',
        'UnitPrice',
        'TotalPrice',
    ];
    protected $primaryKey = 'OrderItemId';
    public $incrementing = true;
    protected $table = 'OrderItems';

    public function order()
    {
        return $this->belongsTo(Order::class , 'OrderId', 'OrderId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId','ProductId');
    }
}
