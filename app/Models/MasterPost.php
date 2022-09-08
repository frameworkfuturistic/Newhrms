<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPost extends Model
{
    protected $primaryKey = 'post_id';
    use HasFactory;
}
