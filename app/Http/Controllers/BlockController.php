<?php

namespace App\Http\Controllers;

use App\Models\MasterDistrict;
use App\Models\MasterStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    public function blockMasterFunc()
    {
        $block_datas = DB::table('master_blocks')->select('block_code', 'block_name')->get();
        $org_datas = DB::table('master_organisations')->select('org_id', 'org_level')->get();
        $state_datas['sd'] = MasterStates::orderby('state_id', 'asc')->select('state_id', 'state_name')->get();

        return view('masters.block-master', compact('block_datas', 'org_datas', 'state_datas'));
    }

    // Fetch district list through Ajax
    public function getDistrictList($st_id = 0)
    {

        // Fetch district name by state id
        $districtListData['sd'] = MasterDistrict::orderby("district_name", "asc")
            ->select('district_id', 'district_name')
            ->where('state_id', $st_id)
            ->get();

        return response()->json($districtListData);
    }
}
