<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportCoupon extends Model
{
    use HasFactory;

    protected $table = 'import_coupons';
    protected $fillable = [
        'total',
        'discount',
        'total_price',
        'status',
        'description',
    ];
}
