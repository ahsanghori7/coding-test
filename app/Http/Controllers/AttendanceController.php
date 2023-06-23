<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }
    
    public function uploadAttendance(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');

        $this->attendanceService->processAndStoreAttendanceFile($file);

        return response()->json(['message' => 'Attendance data uploaded and stored successfully']);
    }

    public function getEmployeeAttendance(Request $request)
    {
        $attendanceData = $this->attendanceService->getEmployeeAttendanceWithTotalHours();

        return response()->json($attendanceData);
    }
}
