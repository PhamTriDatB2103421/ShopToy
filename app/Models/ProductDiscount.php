<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'ProductId',
        'DiscountId',
    ];
    protected $primaryKey = 'ProductDiscountId';
    public $incrementing = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'DiscountId', 'DiscountId');
    }
}
