<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'shipped_date',
        'estimated_delivery_date',
        'delivery_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
