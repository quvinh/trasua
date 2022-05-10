<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'id_category',
        'id_size',
        'name',
        'unit',
        'price',
        'amount',
        'image',
        'description',
        'visible',
        'promotional_price',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Size()
    {
        return $this->belongsTo(Type::class);
    }
}
