<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserId',
    ];
    protected $primaryKey = 'CartId';
    protected $table = 'carts';
    // Nếu khóa chính  tự động tăng
    public $incrementing = true;
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'CartId', 'CartId');
    }
}
