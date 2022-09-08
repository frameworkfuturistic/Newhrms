<?php

namespace App\Http\Controllers;

use App\Models\Master_organisation;
use App\Models\MasterEmployeeType;
use App\Models\MasterPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Toastr;

class PostController extends Controller
{
    public function postMasterFunc()
    {
        $post_data = MasterPost::select('post_id', 'post_title')->get();
        $org_data = Master_organisation::select('org_id', 'org_level')->get();
        $emp_type_data = MasterEmployeeType::select('emp_type_id', 'emp_type')->get();
        return view('masters.post-master', compact('post_data', 'org_data', 'emp_type_data'));
    }

    // Add new Post
    public function addPostMaster(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:master_posts|max:255',
            'org_id' => 'required',
            'emp_type_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $post_master = new MasterPost();
            $post_master->post_title = $request->post_title;
            $post_master->org_id = $request->org_id;
            $post_master->emp_type_id = $request->emp_type_id;
            $post_master->save();

            DB::commit();
            Toastr::success('Allowance is successfully added :)', 'Success');
            return redirect()->route('masters/postMaster');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }

    //Update Post 

    public function updatePostMaster(Request $request)
    {
        DB::beginTransaction();
        try {
            $post_title  = $request->post_title;
            $org_id  = $request->org_id;
            $emp_type_id  = $request->emp_type_id;

            $update = [
                'post_title' => $post_title,
                'org_id' => $org_id,
                'emp_type_id' => $emp_type_id
            ];

            MasterPost::where('post_id', $request->post_id)->update($update);
            DB::commit();
            Toastr::success('Post updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Post update fail :)', 'Error');
            return redirect()->back();
        }
    }
}
