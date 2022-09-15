<?php

namespace App\Http\Controllers;

use App\Models\MasterAllowance;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class AllowanceMaster extends Controller
{
    public function allowanceMasterFunc()
    {
        $allowance_data = DB::table('master_allowances')->select('allowance_id', 'allowance_name', 'allowance_desc')->get();
        return view('masters.allowance-master', ['allowance_datas' => $allowance_data]);
    }

    // Add new allowance
    public function addAllowanceMaster(Request $request)
    {
        $request->validate([
            'allowance_name' => 'required|unique:master_allowances|max:255',
            'allowance_desc' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $allowance_master = new MasterAllowance;
            $allowance_master->allowance_name = $request->allowance_name;
            $allowance_master->allowance_desc = $request->allowance_desc;
            $allowance_master->save();

            DB::commit();
            Toastr::success('Allowance is successfully added :)', 'Success');
            return redirect()->route('masters/allowanceMaster');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }

    //Update Allowance 

    public function updateAllowanceMaster(Request $request)
    {
        DB::beginTransaction();
        try {
            $allowance_name  = $request->allowance_name;
            $allowance_desc  = $request->allowance_desc;

            $update = [
                'allowance_name' => $allowance_name,
                'allowance_desc' => $allowance_desc,
            ];

            MasterAllowance::where('allowance_id', $request->allowance_id)->update($update);
            DB::commit();
            Toastr::success('Allowance updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Allowance update fail :)', 'Error');
            return redirect()->back();
        }
    }

    //Delete Allowance

    public function deleteAllowanceMaster(Request $req)
    {
        try {
            MasterAllowance::destroy($req->allowance_id);
            Toastr::success('Allowance deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Allowance deletion failed :)', 'Error');
            return redirect()->back();
        }
    }
}
