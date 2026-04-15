<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Module;
use App\Models\Seminar;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        // Global stats
        $totalParticipants = Participant::count();
        $totalModules = Module::count();
        $totalSeminars = Seminar::count();
        $totalSubmissions = Submission::count();

        // Participants with relationships
        $participants = Participant::with([
            'marks',
            'seminar_attendance',
            'modules'
        ])->get();

        // Process participant stats
        $participants->map(function ($p) {

            $p->modules_count = $p->modules->count();

            $p->seminars_count = $p->seminar_attendance
                ->where('status', 'present')
                ->count();

            $p->average_marks = round($p->marks->avg('score') ?? 0, 1);

            $total = $p->seminar_attendance->count();
            $present = $p->seminar_attendance->where('status', 'present')->count();

            $p->attendance_rate = $total > 0
                ? round(($present / $total) * 100, 1)
                : 0;

            return $p;
        });

        // Chart: Monthly submissions
        $monthly = Submission::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $labels = $monthly->keys();
        $data = $monthly->values();

        // Chart: Attendance stats
        $attendanceStats = [
            'present' => \App\Models\SeminarAttendance::where('status', 'present')->count(),
            'absent' => \App\Models\SeminarAttendance::where('status', 'absent')->count(),
        ];

        return view('dashboard', compact(
            'participants',
            'totalParticipants',
            'totalModules',
            'totalSeminars',
            'totalSubmissions',
            'labels',
            'data',
            'attendanceStats'
        ));
    }
}