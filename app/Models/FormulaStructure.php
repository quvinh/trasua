<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulaStructure extends Model
{
    use HasFactory;

    protected $table = 'formula_structures';
    protected $fillable = [
        'id_formula',
        'id_structure',
    ];

    public $timestamps = false;

    public function Formula()
    {
        return $this->belongsTo(Formula::class);
    }

    public function Structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
