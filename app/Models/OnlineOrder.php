<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    use HasFactory;

    protected $table = 'online_orders';
    protected $fillable = [
        'id_product',
        'id_order',
        'id_customer',
    ];

    public $timestamps = false;

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
