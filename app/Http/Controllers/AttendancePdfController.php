<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancePdfController extends Controller
{
    public function generate(Request $request)
    {
        $start = $request->query('weekStart');

        $weekStart = $start ? Carbon::parse($start)->startOfWeek() : Carbon::now()->startOfWeek();

        $weekDates = [];
        for ($i = 0; $i < 7; $i++) {
            $weekDates[] = $weekStart->copy()->addDays($i)->format('Y-m-d');
        }

        $employees = Employee::orderBy('lastName')->get()->map(function ($e) {
            return [
                'id' => $e->id,
                'full_name' => trim($e->middleName.' '.$e->lastName.' '.$e->firstName),
            ];
        });

        // Load attendances for the week to pre-fill the PDF
        $attendanceRows = Attendance::whereIn('employee_id', $employees->pluck('id')->toArray())
            ->whereBetween('date', [$weekDates[0], $weekDates[6]])
            ->get();

        $attendancesMap = [];
        foreach ($attendanceRows as $r) {
            $d = Carbon::parse($r->date)->format('Y-m-d');
            $attendancesMap[$r->employee_id][$d] = $r->status;
        }

        $data = [
            'weekStart' => $weekStart,
            'weekDates' => $weekDates,
            'employees' => $employees,
            'attendancesMap' => $attendancesMap,
        ];

        // Use Barryvdh/Dompdf if available
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('attendance.attendance-pdf', $data);
            $filename = 'presence_'.$weekStart->format('Y-m-d').'.pdf';
            return $pdf->download($filename);
        }

        // Fallback: render HTML view in browser
        return view('attendance.attendance-pdf', $data);
    }
}
