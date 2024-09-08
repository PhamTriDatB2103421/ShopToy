<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'DiscountCode',
        'Description',
        'DiscountType',
        'DiscountValue',
        'StartDate',
        'EndDate',
        'IsActive',
    ];
    protected $primaryKey = 'DiscountId';
    // Nếu khóa chính  tự động tăng
    public $incrementing = true;

    public function productDiscount()  {
        return $this->belongsToMany(ProductDiscount::class, 'DiscountId','DiscountId');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discounts');
    }
}
