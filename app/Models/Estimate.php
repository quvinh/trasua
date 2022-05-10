<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $table = 'estimates';
    protected $fillable = [
        'id_material',
        'id_formula',
    ];

    public $timestamps = false;

    public function Material()
    {
        return $this->belongsTo(Material::class);
    }

    public function Formula()
    {
        return $this->belongsTo(Formula::class);
    }
}
