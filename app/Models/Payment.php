<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderId',
        'PaymentMethod',
        'PaymentDate',
        'Amount',
    ];
    protected $primaryKey = 'PaymentId';
    public $incrementing = true;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
