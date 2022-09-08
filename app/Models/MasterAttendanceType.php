<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAttendanceType extends Model
{
    protected $primaryKey = 'attendance_type_id';
    use HasFactory;
}
