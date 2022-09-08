<?php

namespace App\Http\Controllers;

use App\Models\MasterDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class DesignationMaster extends Controller
{
    public function DesignationMasterFunc()
    {
        $designation_data = DB::table('master_designations')->select('designation_id', 'designation_name', 'designation_code')->get();
        $post = DB::table('master_posts')->select('post_id', 'post_title')->get();


        //select i.post_title, m.designation_name, m.designation_code from master_posts i left join master_designation m on m.post_id = i.post_id;

        // DB::table('master_posts')->select('i.post_title, m.designation_name, m.designation_code')

        //＄users = DB::table('master_posts')->select()->leftJoin('posts', 'users.id', '=', 'posts.user_id')->get();

        return view('masters.designation-master', ['designation_datas' => $designation_data, 'posts' => $post]);
    }

    // Add new designation
    public function addDesignationMaster(Request $request)
    {
        $request->validate([
            'designation_name' => 'required|unique:master_designations|max:255',
            'designation_code' => 'required|string',
            'post_name' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $designation_master = new MasterDesignation();
            $designation_master->designation_name = $request->designation_name;
            $designation_master->designation_code = $request->designation_code;
            $designation_master->post_id = $request->post_name;
            $designation_master->save();

            DB::commit();
            Toastr::success('Designation is successfully added :)', 'Success');
            return redirect()->route('masters/designationMaster');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }
}
