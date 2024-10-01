<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserId',
        'OrderStatus',
        'TotalAmount',
        'PaymentStatus',
        'ShippingAddress',
    ];
    protected $primaryKey = 'OrderId';
    public $incrementing = true;


    public function user()
    {
        return $this->belongsTo(User::class, 'UserId', 'UserId');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'OrderId','OrderId');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }
}
