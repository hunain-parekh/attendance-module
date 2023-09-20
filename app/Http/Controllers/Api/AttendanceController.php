<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    //
    public function attendanceData(){
        $attendance = Attendance::with('employee', 'schedule')->get();
        return response()->json(['data' => $attendance]);
    }
}
