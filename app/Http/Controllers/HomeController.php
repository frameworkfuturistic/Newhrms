<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
}
