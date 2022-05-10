<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $table = 'imports';
    protected $fillable = [
        'created_by',
        'id_supplier',
        'name',
        'unit',
        'amount',
        'price',
        'description',
    ];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
