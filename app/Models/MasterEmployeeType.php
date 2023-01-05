<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterEmployeeType extends Model
{
    protected $primaryKey = 'emp_type_id';
    use HasFactory;

    public function getAllEmployeeTypes()
    {
        return DB::table('master_employee_types')
            ->get();
    }
}
