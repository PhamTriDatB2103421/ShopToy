<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    public $incrementing = true;
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productdiscounts', 'DiscountId', 'ProductId');
    }

    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d') : null,
        );
    }

    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d') : null,
        );
    }
    public function productDiscount()
    {
        return $this->belongsToMany(ProductDiscount::class, 'DiscountId', 'DiscountId');
    }


    public function getProductsByDiscountId($id)
    {
        // Lấy discount theo ID
        $discount = $this->find($id);

        // Nếu không tìm thấy discount, trả về mảng rỗng
        if (!$discount) {
            return [];
        }

        // Lấy tất cả các sản phẩm dựa trên discount
        return $discount->products;
    }
}

