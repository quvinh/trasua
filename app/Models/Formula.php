<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    protected $table = 'formulas';
    protected $fillable = [
        'id_category',
        'name',
        'status',
    ];

    // public $timestamps = false;

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
