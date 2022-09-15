<?php

namespace App\Http\Controllers;

use App\Models\MasterStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class StateController extends Controller
{
    public function stateMasterFunc()
    {
        $state_data = DB::table('master_states')->select('state_id', 'state_name', 'state_code')->get();
        return view('masters.state-master', ['state_datas' => $state_data]);
    }

    // Add new state
    public function addStateMaster(Request $request)
    {
        $request->validate([
            'state_name' => 'required|unique:master_states|max:255',
            'state_code' => 'required|unique:master_states|string'
        ]);

        DB::beginTransaction();
        try {
            $state_master = new MasterStates();
            $state_master->org_id = 1;
            $state_master->state_name = $request->state_name;
            $state_master->state_code = $request->state_code;
            $state_master->save();

            DB::commit();
            Toastr::success('State is successfully added :)', 'Success');
            return redirect()->route('masters/stateMaster');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }

    //Update State 

    public function updateStateMaster(Request $request)
    {
        DB::beginTransaction();
        try {
            $state_name  = $request->state_name;
            $state_code  = $request->state_code;

            $update = [
                'state_name' => $state_name,
                'state_code' => $state_code
            ];

            MasterStates::where('state_id', $request->state_id)->update($update);
            DB::commit();
            Toastr::success('State updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('State update fail :)', 'Error');
            return redirect()->back();
        }
    }

    //Delete State

    public function deleteStateMaster(Request $req)
    {
        try {
            MasterStates::destroy($req->state_id);
            Toastr::success('State deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('State deletion failed :)', 'Error');
            return redirect()->back();
        }
    }
}
