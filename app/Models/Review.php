<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'ProductId',
        'UserId',
        'Rating',
        'Comment',
    ];
    protected $primaryKey = 'ReviewId'; // Chỉ định cột khóa chính

    public $incrementing = true; // Nếu cột khóa chính tự động tăng

    protected $keyType = 'int';


    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId', 'UserId');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }
}
