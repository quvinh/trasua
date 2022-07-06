<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $table = 'structures';
    protected $fillable = [
        'id_size',
        'id_unit',
        'name',
        'capacity',
        'status',
    ];

    public $timestamps = false;

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }
}
