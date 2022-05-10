<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAtTable extends Model
{
    use HasFactory;

    protected $table = 'product_at_tables';
    protected $fillable = [
        'id_product',
        'id_table',
        'id_order',
    ];

    public $timestamps = false;

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Table()
    {
        return $this->belongsTo(Table::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
