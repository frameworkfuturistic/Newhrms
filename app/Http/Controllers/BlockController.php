<?php

namespace App\Http\Controllers;

use App\Models\MasterBlocks;
use App\Models\MasterDistrict;
use App\Models\MasterStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;


class BlockController extends Controller
{
    public function blockMasterFunc()
    {
        $block_datas = DB::table('master_blocks')->select('block_id', 'block_code', 'block_name')->get();
        $org_datas = DB::table('master_organisations')->select('org_id', 'org_level')->get();
        $state_datas['sd'] = MasterStates::orderby('state_id', 'asc')->select('state_id', 'state_name')->get();

        return view('masters.block-master', compact('block_datas', 'org_datas', 'state_datas'));
    }

    // search district list through Ajax
    public function searchDistrictList($st_idd = 0)
    {

        // Fetch district name by state id
        $searchDistrictList = MasterDistrict::orderby("district_name", "asc")
            ->select('district_id', 'district_name')
            ->where('state_id', $st_idd)
            ->get();

        return response()->json($searchDistrictList);
    }

    //search functionality code
    // public function searchBlockLogin(){
    //     if (Auth::user()->role_name == 'Admin') {
    //         $users      = DB::table('users')->get();
    //         $result     = DB::table('users')->get();
    //         $role_name  = DB::table('role_type_users')->get();
    //         $position   = DB::table('position_types')->get();
    //         $department = DB::table('departments')->get();
    //         $status_user = DB::table('user_types')->get();
    //         $employee_types = DB::table('master_employee_types')->get();
    //         $designation = DB::table('master_designations')->get();
    //         $post = DB::table('master_posts')->get();
    //         $role_type = DB::table('role_type_users')->get();
    //         $attendance_type = DB::table('master_attendance_types')->get();
    //         $organisation['data'] = Master_organisation::orderby("org_id", "asc")->select('org_id', 'org_level')->get();

    //         // search by name
    //         if ($request->name) {
    //             $result = User::where('name', 'LIKE', '%' . $request->name . '%')->get();
    //         }

    //         // search by role name
    //         if ($request->role_name) {
    //             $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')->get();
    //         }

    //         // search by status
    //         if ($request->status) {
    //             $result = User::where('status', 'LIKE', '%' . $request->status . '%')->get();
    //         }

    //         // search by name and role name
    //         if ($request->name && $request->role_name) {
    //             $result = User::where('name', 'LIKE', '%' . $request->name . '%')
    //                 ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
    //                 ->get();
    //         }

    //         // search by role name and status
    //         if ($request->role_name && $request->status) {
    //             $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')
    //                 ->where('status', 'LIKE', '%' . $request->status . '%')
    //                 ->get();
    //         }

    //         // search by name and status
    //         if ($request->name && $request->status) {
    //             $result = User::where('name', 'LIKE', '%' . $request->name . '%')
    //                 ->where('status', 'LIKE', '%' . $request->status . '%')
    //                 ->get();
    //         }

    //         // search by name and role name and status
    //         if ($request->name && $request->role_name && $request->status) {
    //             $result = User::where('name', 'LIKE', '%' . $request->name . '%')
    //                 ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
    //                 ->where('status', 'LIKE', '%' . $request->status . '%')
    //                 ->get();
    //         }

    //         return view('usermanagement.user_control', compact('users', 'role_name', 'position', 'department', 'status_user', 'result', 'employee_types', 'designation', 'post', 'role_type', 'attendance_type', 'organisation'));
    //     } else {
    //         return redirect()->route('home');
    //     }
    // }

    // Fetch district list through Ajax for add block modal
    public function getDistrictList($st_idd = 0)
    {

        // Fetch district name by state id
        $districtListData = MasterDistrict::orderby("district_name", "asc")
            ->select('district_id', 'district_name')
            ->where('state_id', $st_idd)
            ->get();

        return response()->json($districtListData);
    }

    // Add Block by addBlockMaster() in AddBlock modal in block Master page

    public function addBlockMaster(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'district_id' => 'required',
            'block_name' => 'required|unique:master_blocks|max:255',
            'block_code' => 'required|unique:master_blocks|max:255'
        ]);

        DB::beginTransaction();
        try {
            $block_master = new MasterBlocks();
            $block_master->state_id = $request->state_id;
            $block_master->district_id = $request->district_id;
            $block_master->block_name = $request->block_name;
            $block_master->block_code = $request->block_code;
            $block_master->org_id = 1;
            $block_master->save();

            DB::commit();
            Toastr::success('Block is successfully added :)', 'Success');
            return redirect()->route('masters/blockMaster');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }

    // Fetch district list through Ajax for edit modal
    public function editDistrictList($st_idd = 0)
    {

        // Fetch district name by state id
        $editdistrictListData = MasterDistrict::orderby("district_name", "asc")
            ->select('district_id', 'district_name')
            ->where('state_id', $st_idd)
            ->get();

        return response()->json($editdistrictListData);
    }

    //Update Block 

    public function updateBlockMaster(Request $request)
    {
        $request->validate([
            'block_name'   => 'required',
            'block_code'   => 'required',
            'state_id'     => 'required',
            'district_id'  => 'required',
        ]);

        DB::beginTransaction();
        try {

            $block_name = $request->block_name;
            $block_code = $request->block_code;
            $state_id = $request->state_id;
            $district_id = $request->district_id;

            $update = [
                'block_name' => $block_name,
                'block_code' => $block_code,
                'state_id' => $state_id,
                'district_id' => $district_id,
            ];

            $masterBlock = MasterBlocks::where('block_id', $request->block_id)->first();
            $masterBlock->update($update);
            DB::commit();
            Toastr::success('Block updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Block update fail :)', 'Error');
            return redirect()->back();
        }
    }

    //Delete Block

    public function deleteBlockMaster(Request $req)
    {
        try {
            MasterBlocks::destroy($req->block_id);
            Toastr::success('Block deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Block deletion failed :)', 'Error');
            return redirect()->back();
        }
    }
}
