<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;

class ImportAttendance implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $schedule = Schedule::where('employee_id', $row[0])->first();
        if ($schedule) {
            $attendanceDate = Carbon::createFromFormat('Y-m-d',$row[4])->format('Y-m-d');
            return new Attendance([
                'employee_id' => $row[0],
                'schedule_id' => $schedule->id,
                'check_in' => $row[2],
                'checkout' => $row[3],
                'attendance_date' => $attendanceDate,
            ]);
        }
        return null;
    }
}
