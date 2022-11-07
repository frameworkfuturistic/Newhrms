<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // employee dashboard
    public function emDashboard()
    {
        if (auth()->user()->role_name == 'Employee') {
            $dt        = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            return view('dashboard.emdashboard', compact('todayDate'));
        } else
            return redirect('/home');
    }

    public function generatePDF(Request $request)
    {
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }

    public function addashboard(Request $request)
    {
        // $pendingAllLeaves = DB::table('leaves_admins as la')->select('status')->where('status', 'new')->orWhere('status', 'pending')->count();

        

        $pendingSPRCLeaves = DB::table('leaves_admins as la')->select('la.rec_id')
            ->leftjoin('users as u', 'u.rec_id', '=', 'la.rec_id')->where('u.org_id', '1')->where('la.from_date', '>=', date('Y-m-d'))->where(function ($query) {
                $query->where('la.status', 'new')
                    ->orWhere('la.status', 'pending');
            })->get()->count();

        $pendingDPRCLeaves = DB::table('leaves_admins as la')->select('la.rec_id')
            ->leftjoin('users as u', 'u.rec_id', '=', 'la.rec_id')->where('u.org_id', '2')->where('la.from_date', '>=', date('Y-m-d'))->where(function ($query) {
                $query->where('la.status', 'new')
                    ->orWhere('la.status', 'pending');
            })->get()->count();

        $pendingBPRCLeaves = DB::table('leaves_admins as la')->select('la.rec_id')
            ->leftjoin('users as u', 'u.rec_id', '=', 'la.rec_id')->where('u.org_id', '3')->where('la.from_date', '>=', date('Y-m-d'))->where(function ($query) {
                $query->where('la.status', 'new')
                    ->orWhere('la.status', 'pending');
            })->get()->count();

        // $pendingLeaves = DB::table('leaves_admins as la')
        //     ->leftjoin('users as u', 'la.rec_id', '=', 'u.rec_id')
        //     ->select('u.name', 'u.rec_id', 'u.avatar', 'u.position', 'u.reporting_authority', 'la.id', 'la.leave_type', 'la.from_date', 'la.to_date', 'la.day', 'la.leave_reason', 'la.status')
        //     ->where('la.reporting_authority', Auth()->user()->id)
        //     ->count();

        $totalStaff = User::select('rec_id')->count();

        $totalSPRCStaff = User::select('rec_id')->where('org_id', '1')->count();

        $totalDPRCStaff = User::select('rec_id')->where('org_id', '2')->count();

        $totalBPRCStaff = User::select('rec_id')->where('org_id', '3')->count();

        $totalSPRCPresentStaff = DB::table('attendance_records as ar')->select('ar.user_id')
            ->leftJoin('users as u', 'u.id', '=', 'ar.user_id')->where('ar.attend_date', '=', date('Y-m-d'))->where('u.org_id', '1')->count();

        $totalDPRCPresentStaff = DB::table('attendance_records as ar')->select('ar.user_id')
            ->leftJoin('users as u', 'u.id', '=', 'ar.user_id')->where('ar.attend_date', '=', date('Y-m-d'))->where('u.org_id', '2')->count();

        $totalBPRCPresentStaff = DB::table('attendance_records as ar')->select('ar.user_id')
            ->leftJoin('users as u', 'u.id', '=', 'ar.user_id')->where('ar.attend_date', '=', date('Y-m-d'))->where('u.org_id', '3')->count();

        // $totalPresentStaff = DB::table('attendance_records')->select('attend_date')->where('attend_date', date('Y-m-d'))->count();

        $totalStaff = User::select('*')->count();

        $request->validate([
            'level_type'   => 'required'
        ]);

        if ($request->level_type == 1)
            return view('dashboard.dashboard');

        if ($request->level_type == 2)
            return view('dashboard.tdashboard', ['pendingLeaves' => $pendingSPRCLeaves, 'totalPresentStaff' => $totalSPRCPresentStaff, 'totalStaff' => $totalSPRCStaff]);

        if ($request->level_type == 3)
            return view('dashboard.tdashboard', ['pendingLeaves' => $pendingDPRCLeaves, 'totalPresentStaff' => $totalDPRCPresentStaff, 'totalStaff' => $totalDPRCStaff]);

        if ($request->level_type == 4)
            return view('dashboard.tdashboard', ['pendingLeaves' => $pendingBPRCLeaves, 'totalPresentStaff' => $totalBPRCPresentStaff, 'totalStaff' => $totalBPRCStaff]);
    }
}
