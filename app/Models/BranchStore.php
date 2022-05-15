<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchStore extends Model
{
    use HasFactory;

    protected $table = 'branch_stores';
    protected $fillable = [
        'id_user',
        'name_branch',
    ];
}
