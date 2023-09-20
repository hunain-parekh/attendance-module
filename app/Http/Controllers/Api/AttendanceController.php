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
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,csv', // Adjust the allowed file types as needed
        ]);
        try {
            $file = $request->file('excel_file');
            Excel::import(new ImportAttendance, $file);
            return redirect()->back()->with('success', 'Attendance data imported successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while importing attendance data: ' . $e->getMessage());
        }
    }
}
