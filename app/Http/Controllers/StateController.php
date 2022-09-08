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
        $state_data = DB::table('master_states')->select('state_id', 'state_name', 'state_code', 'org_id')->get();
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
}



// $post = DB::table('master_posts')->select('post_id', 'post_title')->get();

// $allDatas = $designation_data->merge($post);
