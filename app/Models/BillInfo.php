<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInfo extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = [
        'id_bill',
        'id_product',
        'month',
    ];

    public $timestamps = false;
}
