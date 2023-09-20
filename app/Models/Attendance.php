<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'checkout',
        'employee_id',
        'schedule_id',
        'attendance_date',
    ];

    protected $appends = ['total_hours'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    // Accessor to calculate and retrieve the total_hours attribute
    public function getTotalHoursAttribute()
{
    if ($this->check_in && $this->checkout) {
        $checkIn = Carbon::parse($this->check_in);
        $checkOut = Carbon::parse($this->checkout);
        $diffInHours = $checkOut->diffInHours($checkIn);
        return sprintf('%02d:%02d', $diffInHours, ($checkOut->diffInMinutes($checkIn) % 60));
    }
    return '00:00';
}
}
