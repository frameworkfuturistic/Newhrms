<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeavesAdmin;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\AttendanceRecord;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class LeavesController extends Controller
{
    // leaves
    public function leaves()
    {
        $leaves = DB::table('leaves_admins')
            ->join('users', 'users.rec_id', '=', 'leaves_admins.rec_id')
            ->select('leaves_admins.*', 'users.position', 'users.name', 'users.avatar')
            ->get();

        return view('form.leaves', compact('leaves'));
    }
    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type'   => 'required|string|max:255',
            'from_date'    => 'required|string|max:255',
            'to_date'      => 'required|string|max:255',
            'leave_reason' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $leaves = new LeavesAdmin;
            $leaves->rec_id        = $request->rec_id;
            $leaves->leave_type    = $request->leave_type;
            $leaves->from_date     = $request->from_date;
            $leaves->to_date       = $request->to_date;
            $leaves->day           = $days;
            $leaves->leave_reason  = $request->leave_reason;
            $leaves->save();

            DB::commit();
            Toastr::success('Create new Leaves successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Leaves fail :)', 'Error');
            return redirect()->back();
        }
    }

    // edit record
    public function editRecordLeave(Request $request)
    {
        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $update = [
                'id'           => $request->id,
                'leave_type'   => $request->leave_type,
                'from_date'    => $request->from_date,
                'to_date'      => $request->to_date,
                'day'          => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeavesAdmin::where('id', $request->id)->update($update);
            DB::commit();

            DB::commit();
            Toastr::success('Updated Leaves successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update Leaves fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteLeave(Request $request)
    {
        try {

            LeavesAdmin::destroy($request->id);
            Toastr::success('Leaves admin deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Leaves admin delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    // leaveSettings
    public function leaveSettings()
    {
        return view('form.leavesettings');
    }

    // attendance admin
    public function attendanceIndex()
    {
        return view('form.attendance');
    }

    // show attendance form
    public function showAttendance()
    {
        return view('form.take_attendance');
    }

    // attendance employee
    public function AttendanceEmployee()
    {
        return view('form.attendanceemployee');
    }

    // leaves Employee
    public function leavesEmployee()
    {
        return view('form.leavesemployee');
    }

    // take attendance
    public function insertAttendDetail(Request $req)
    {
        $req->validate([
            'status' => 'required'
        ]);

        $today_date = Carbon::today()->format('y-m-d');

        // check the status is time in or time out
        $checkCondition = $req->status;
        $accessData = AttendanceRecord::select('inserted_on_time_in', 'inserted_on_time_out')
            ->where('date', $today_date)->where('user_id', Auth()->user()->id)->first();

        // if today's record is not available 
        if ($accessData == null) {
            if ($checkCondition == 1) {
                DB::beginTransaction();
                try {
                    $attend_record = new AttendanceRecord();

                    $todayTime = Carbon::now()->format('Y-m-d H:i:s');

                    $attend_record->user_id = Auth()->user()->id;
                    $attend_record->date = $today_date;
                    $attend_record->status = true;
                    $attend_record->inserted_by_time_in_id = Auth()->user()->id;
                    $attend_record->inserted_on_time_in = $todayTime;

                    $attend_record->save();

                    DB::commit();
                    Toastr::success('Attendance is successfully done :)', 'Success');
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollback();
                    Toastr::error('Something is wrong :)', 'Error');
                    return redirect()->back();
                }
            } else {
                Toastr::error('First of all submit entry time :)', 'Error');
                return redirect()->back();
            }
        }

        // if today's record is available 
        if ($accessData != null) {
            if ($checkCondition == 1) {
                if ($accessData->inserted_on_time_in != null) {
                    Toastr::error('Record is already Submitted :)', 'Error');
                    return redirect()->back();
                }
            }
            if ($checkCondition == 0) {
                if ($accessData->inserted_on_time_out == null) {
                    DB::beginTransaction();
                    try {

                        $todayTime = Carbon::now()->format('Y-m-d H:i:s');
                        $id           = Auth()->user()->id;
                        $time_out = $todayTime;

                        $update = [
                            'inserted_by_time_out_id' => $id,
                            'inserted_on_time_out' => $todayTime,
                        ];

                        AttendanceRecord::where('user_id', $id)->update($update);
                        DB::commit();
                        Toastr::success('Attendance is successfully done :)', 'Success');
                        return redirect()->back();
                    } catch (\Exception $e) {
                        DB::rollback();
                        Toastr::error('Something is wrong :)', 'Error');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Record is already Submitted :)', 'Error');
                    return redirect()->back();
                }
            }
        }
    }

    // attendance record search by month 
    // public function attendanceRecordSearch(Request $request)
    // {
    //     $userList = DB::table('users')->get();

    //     // search by name
    //     if ($request->emp_name) {
    //         $users = DB::table('users as u')
    //             ->join('attendance_records as ar', 'u.id', '=', 'ar.user_id')
    //             ->select('u.*', 'ar.*')
    //             ->where('name', 'LIKE', '%' . $request->emp_name . '%')
    //             ->get();
    //     }

    //     // search by month
    //     if ($request->month) {
    //         $users = DB::table('users as u')
    //             ->join('attendance_records as ar', 'u.id', '=', 'ar.user_id')
    //             ->select('u.*', 'ar.*')
    //             ->where('name', 'LIKE', '%' . $request->emp_name . '%')
    //             ->get();
    //     }

    //     // search by year
    //     if ($request->year) {
    //         $users = DB::table('users as u')
    //             ->join('attendance_records as ar', 'u.id', '=', 'ar.user_id')
    //             ->select('u.*', 'ar.*')
    //             ->where('name', 'LIKE', '%' . $request->emp_name . '%')
    //             ->get();
    //     }

    //     // search by name and id
    //     if ($request->employee_id && $request->name) {
    //         $users = DB::table('users')
    //             ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
    //             ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
    //             ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
    //             ->where('users.name', 'LIKE', '%' . $request->name . '%')
    //             ->get();
    //     }
    //     // search by position and id
    //     if ($request->employee_id && $request->position) {
    //         $users = DB::table('users')
    //             ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
    //             ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
    //             ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
    //             ->where('users.position', 'LIKE', '%' . $request->position . '%')
    //             ->get();
    //     }
    //     // search by name and position
    //     if ($request->name && $request->position) {
    //         $users = DB::table('users')
    //             ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
    //             ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
    //             ->where('users.name', 'LIKE', '%' . $request->name . '%')
    //             ->where('users.position', 'LIKE', '%' . $request->position . '%')
    //             ->get();
    //     }
    //     // search by name and position and id
    //     if ($request->employee_id && $request->name && $request->position) {
    //         $users = DB::table('users')
    //             ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
    //             ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
    //             ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
    //             ->where('users.name', 'LIKE', '%' . $request->name . '%')
    //             ->where('users.position', 'LIKE', '%' . $request->position . '%')
    //             ->get();
    //     }
    //     return view('form.allemployeecard', compact('users', 'userList', 'permission_lists'));
    // }
}
