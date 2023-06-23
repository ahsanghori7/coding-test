<?php

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use Carbon\Carbon;

class AttendanceService
{
    public function processAndStoreAttendanceFile($file)
    {

        $data = Excel::toArray(new AttendanceImport(), $file);

        foreach ($data[0] as $row) {

            $employeeId = $row['employee_id'];
            $date = $row['date'];
            $clockIn = round($row['clock_in'] * 86400);
            $clockOut = round($row['clock_out']* 86400);
            
            Attendance::create([
                'employee_id' => $employeeId,
                'schedule_id' => $employeeId,
                'date' => Carbon::createFromTimestamp(($row['date'] - 25569) * 86400)->format('Y-m-d'),
                'clock_in' => Carbon::createFromTimestamp($clockIn)->format('H:i:s'),
                'clock_out' => Carbon::createFromTimestamp($clockOut)->format('H:i:s'),
            ]);
        }
    }

    public function getEmployeeAttendanceWithTotalHours()
    {
        $attendance = Attendance::with('employee')->get();
        
        $attendanceWithTotalHours = $attendance->map(function ($item) {
            $totalWorkingHours = strtotime($item->clock_out) - strtotime($item->clock_in);
            $item->totalWorkingHours = $totalWorkingHours / (60 * 60);

            $item->employee->full_name = $item->employee->first_name . ' ' . $item->employee->last_name;

            return $item;
        });
    
        $totalHours = $attendanceWithTotalHours->sum('totalWorkingHours');
        
        return [
            'attendance' => $attendanceWithTotalHours->toArray(),
        ];
    }
}
