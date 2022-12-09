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
        $leaves = DB::table('leaves_admins as la')
            ->leftjoin('users as u', 'la.rec_id', '=', 'u.rec_id')
            ->select('u.name', 'u.rec_id', 'u.avatar', 'u.position', 'u.reporting_authority', 'la.id', 'la.leave_type', 'la.from_date', 'la.to_date', 'la.day', 'la.leave_reason', 'la.status')
            ->where('la.reporting_authority', Auth()->user()->id)
            ->get();

        return view('form.leaves', compact('leaves'));
    }
    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type'   => 'required|string|max:255',
            'from_date'    => 'required|string|max:255',
            'to_date'      => 'nullable|string|max:255',
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
            $date = date_create("$request->from_date");
            $leaves->from_date     = date_format($date, 'Y-m-d');

            if ($request->to_date != NULL) {
                $dateTo = date_create("$request->to_date");
                $leaves->to_date  = date_format($dateTo, 'Y-m-d');
            }

            if ($request->to_date != NULL) {
                $leaves->day = $days + 1;
            } else
                $leaves->day = 1;

            $leaves->leave_reason  = $request->leave_reason;
            $leaves->reporting_authority  = $request->reporting_auth;
            $leaves->save();

            DB::commit();
            Toastr::success('Request sent successfully :)', 'Success');
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
                'day'          => $days + 1,
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
            Toastr::success('Leaves request deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Request deletion failed :)', 'Error');
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
        $user_name = DB::table('users as u')
            ->join('master_designations as md', 'md.designation_id', '=', 'u.designation')
            ->select('u.avatar', 'u.name', 'u.id', 'u.rec_id', 'u.emp_id', 'md.designation_code')->get();

        $dt_cycle = DB::table('attendance_records')->select('DateCycle')->where('attend_rec_id', 1)->first();

        $attendenceRecord = AttendanceRecord::all();

        $DateCycle = $dt_cycle->DateCycle;
        $FrfromDate = Carbon::now()->format("Y-m-$DateCycle");
        $fromDate = Carbon::parse($FrfromDate)->format('Y-m-d');
        $toDate = Carbon::parse($fromDate)->addMonths(1)->format('Y-m-d');

        $userAttendance = array();
        $uptoDate = Carbon::parse($toDate)->addDays(-1)->format('Y-m-d');
        foreach ($user_name as $user_names) {
            $queryDateRange =  "SELECT *,
                                      if((SELECT DAYNAME(selected_date))='SATURDAY','S1',if((SELECT DAYNAME(selected_date))='SUNDAY','S2','Day')) as NameofDay     
                                from (SELECT *,
                                            $user_names->id AS refUserId,
                                            (CASE
                                            WHEN ar.user_id IS NULL THEN 0
                                            ELSE 1
                                            END) AS attend_status
                                
                                        from 
                                        (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
                                        (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
                                        (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
                                        (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
                                        (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
                                        (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
                                        
                                        
                                        LEFT JOIN (SELECT attend_rec_id,
                                                            user_id,
                                                            attend_date,
                                                            time_in,
                                                            time_out,
                                                            inserted_on_time_in,
                                                            inserted_on_time_out 
                                                    FROM attendance_records WHERE user_id='$user_names->id') AS ar ON ar.attend_date=selected_date
                                        LEFT JOIN users AS u ON u.id = $user_names->id
                                        
                                        
                                        where selected_date BETWEEN '$fromDate' AND '$uptoDate'
                                        ORDER BY selected_date ASC
                                    ) as A";

            $rangeDates = DB::select($queryDateRange);      // range Dates
            array_push($userAttendance, $rangeDates);
        }

        // return $userAttendance;
        $no_of_days = array();
        while ($fromDate < $toDate) {
            array_push($no_of_days, Carbon::parse($fromDate)->format('d'));
            $fromDate = Carbon::parse($fromDate)->addDays(1)->format('Y-m-d');
        }

        $cDate = Carbon::now()->format("Y-m-d");

        $currentDate = Carbon::parse($cDate)->format('Y-m-d');


        // $check_attd = DB::table('attendance_records')
        //     ->select()
        //     ->where('user_id', Auth()->user()->id)
        //     ->where('attend_date', $date_picker)
        //     ->first();

        // $check_leave = DB::table('leaves_admins')
        //     ->select()
        //     ->where('rec_id', Auth()->user()->rec_id)
        //     ->where('from_date', $date_picker)
        //     ->get();

        return view('form.attendance', compact('user_name', 'no_of_days', 'DateCycle', 'userAttendance', 'currentDate'));
    }

    // show attendance form
    public function showAttendance()
    {
        return view('form.take_attendance');
    }

    // attendance employee
    public function AttendanceEmployee()
    {
        // $datess = Carbon::today()->format('y-m-d');
        // $today_date = $datess->toDateTimeString();

        $today_date = Carbon::now();


        return view('form.attendanceemployee', compact('today_date'));
    }

    // show Employee Leaves
    public function leavesEmployee()
    {
        $user_id = Auth()->user()->id;
        $leaves = DB::table('leaves_admins as la')
            ->join('users as u', 'u.rec_id', '=', 'la.rec_id')
            ->select('la.*', 'u.position', 'u.reporting_authority', 'u.name', 'u.avatar', 'u.id')
            ->where('u.id', $user_id)
            ->get();

        return view('form.leavesemployee', compact('leaves'));
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
            ->where('attend_date', $today_date)->where('user_id', Auth()->user()->id)->first();

        // if today's record is not available 
        if ($accessData == null) {
            if ($checkCondition == 1) {
                DB::beginTransaction();
                try {
                    $attend_record = new AttendanceRecord();

                    $todayTime = Carbon::now()->format('Y-m-d H:i:s');
                    $todayTimeIn = Carbon::now()->format('Y-m-d H:i:s');

                    $attend_record->user_id = Auth()->user()->id;
                    $attend_record->attend_date = $today_date;
                    $attend_record->status = true;
                    $attend_record->inserted_by_time_in_id = Auth()->user()->id;
                    $attend_record->inserted_on_time_in = $todayTime;
                    $attend_record->time_in = $todayTimeIn;

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
                        $todayTimeOut = Carbon::now()->format('Y-m-d H:i:s');
                        $id           = Auth()->user()->id;

                        $update = [
                            'inserted_by_time_out_id' => $id,
                            'inserted_on_time_out' => $todayTime,
                            'time_out' => $todayTimeOut,
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

    //Update status of leave that may be approved, pending or rejected.

    public function updateStatus(Request $req)
    {
        DB::beginTransaction();
        try {

            $id     = $req->id;
            $status = $req->status;

            $update = [
                'status' => $status
            ];

            LeavesAdmin::where('id', $id)->update($update);
            DB::commit();
            Toastr::success('Application ' . $status . ' :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }

    public function changeDateCycle(Request $request)
    {
        $request->validate([
            'from_date_cycle' => 'required|integer|min:1|max:28'
        ]);

        $from_date_cycle = $request->from_date_cycle;

        $update = [
            'DateCycle' => $from_date_cycle
        ];

        AttendanceRecord::where('attend_rec_id', 1)->update($update);
        DB::commit();
        Toastr::success('Date cycle Changed :)', 'Success');
        return redirect()->back();
    }
}
