<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function edit($req)
    {
        $userId = $req->user_id;
        $preFamilies = FamilyInfo::where('user_id', $userId)
            ->get();
        $relations = $req->fam_relation;
        $names = $req->fam_name;
        $ages = $req->fam_age;
        if ($preFamilies) {     // Delete The Existing
            $this->deleteExisting($preFamilies);
        }

        collect($relations)->map(function ($relation, $key) use ($names, $ages, $userId) {
            $metaReqs = [
                'user_id' => $userId,
                'relation' => $relation,
                'name' => $names[$key],
                'age' => $ages[$key],
            ];
            FamilyInfo::create($metaReqs);
        });
    }

    public function deleteExisting($preFamilies)
    {
        collect($preFamilies)->map(function ($preFamilies) {
            $preFamilies->delete();
        });
    }
}
