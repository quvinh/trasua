<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;

    protected $table = 'import_details';
    protected $fillable = [
        'id_import',
        'id_coupon',
    ];

    public $timestamps = false;

    public function Import()
    {
        return $this->belongsTo(Import::class);
    }

    public function ImportCoupon()
    {
        return $this->belongsTo(ImportCoupon::class);
    }
}
