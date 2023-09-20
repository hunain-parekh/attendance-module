<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Attendance;
use App\Models\Schedule;

class ImportAttendance implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $schedule = Schedule::where('employee_id', $row[0])->first();
        return new Attendance([
            'employee_id' => $row[0],
            'schedule_id' => $schedule->id,
            'check_in' => $row[2],
            'checkout' => $row[3],
            'attendance_date' => $row[4],
        ]);
    }
}
