<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAttendance;

class AttendanceController extends Controller
{
    //
    public function attendanceData(){
        $attendance = Attendance::with('employee', 'schedule')->get();
        return response()->json(['data' => $attendance]);
    }

    public function import(Request $request){
        Excel::import(new ImportAttendance, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
