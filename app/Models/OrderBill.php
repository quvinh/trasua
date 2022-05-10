<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBill extends Model
{
    use HasFactory;

    protected $table = 'order_bills';
    protected $fillable = [
        'id_order',
        'id_bill',
    ];

    public $timestamps = false;

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
