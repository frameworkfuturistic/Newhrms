<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $primaryKey = 'attend_rec_id';
    use HasFactory;
    public $timestamps = false;
}
