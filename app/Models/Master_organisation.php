<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_organisation extends Model
{
    protected $primaryKey = 'org_id';
    use HasFactory;

    // Get Organisation Level
    public function show()
    {
        return Master_organisation::orderby("org_id", "asc")
            ->select('org_id', 'org_level')
            ->get();
    }
}
