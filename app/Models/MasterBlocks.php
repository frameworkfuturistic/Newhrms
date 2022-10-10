<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBlocks extends Model
{
    protected $primaryKey = 'block_id';
    use HasFactory;
    
    protected $fillable = [
        'block_name',
    ];
}
