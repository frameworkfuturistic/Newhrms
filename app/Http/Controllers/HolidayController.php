<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidayController extends Controller
{
    // holidays
    public function holiday()
    {
        $holiday = Holiday::all();

        return view('form.holidays', compact('holiday'));
    }

    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'nameHoliday' => 'required|string|max:255',
            'holidayDate' => 'required|date',
            'holidayTo'   => 'nullable|date',
        ]);

        DB::beginTransaction();
        try {
            $holiday = new Holiday;
            $holiday->name_holiday = $request->nameHoliday;
            $date = date_create("$request->holidayDate");
            $holiday->date_holiday  = date_format($date, 'Y-m-d');

            if ($request->holidayTo != NULL) {
                $dateTo = date_create("$request->holidayTo");
                $holiday->to_holiday  = date_format($dateTo, 'Y-m-d');
            }

            $from = Carbon::parse(date_format($date, 'Y-m-d'));
            if ($request->holidayTo != NULL) {
                $to = Carbon::parse(date_format($dateTo, 'Y-m-d'));
                $holiday->no_of_days = ($from->diffInDays($to)) + 1;
            } else
                $holiday->no_of_days = 1;

            $holiday->save();
            DB::commit();
            Toastr::success('Create new holiday successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Holiday fail :)', 'Error');
            return redirect()->back();
        }
    }
    // update
    public function updateRecord(Request $request)
    {
        $request->validate([
            'holidayName' => 'required|string|max:255',
            'holidayDate' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $id           = $request->id;
            $holidayName  = $request->holidayName;
            $date = date_create("$request->holidayDate");
            $holidayDate  = date_format($date, 'Y-m-d');

            if ($request->holidayTo != null) {
                $dateTo = date_create("$request->holidayTo");
                $holidayTo  = date_format($dateTo, 'Y-m-d');
            }

            $from = Carbon::parse(date_format($date, 'Y-m-d'));
            if ($request->holidayTo != NULL) {
                $to = Carbon::parse(date_format($dateTo, 'Y-m-d'));
                $no_of_days = ($from->diffInDays($to)) + 1;
            } else
                $no_of_days = 1;

            if ($request->holidayTo == null) {
                $update = [
                    'id'           => $id,
                    'name_holiday' => $holidayName,
                    'date_holiday' => $holidayDate,
                    'no_of_days'   => $no_of_days,
                ];
            } else {
                $update = [
                    'id'           => $id,
                    'name_holiday' => $holidayName,
                    'date_holiday' => $holidayDate,
                    'to_holiday'   => $holidayTo,
                    'no_of_days'   => $no_of_days,
                ];
            }

            Holiday::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Holiday updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Holiday update fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {
            Holiday::destroy($request->id);
            Toastr::success('Record deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Holiday deletion failed :)', 'Error');
            return redirect()->back();
        }
    }
}
