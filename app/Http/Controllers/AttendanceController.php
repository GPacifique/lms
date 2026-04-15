<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display attendance list (filter by seminar)
     */
    public function index(Request $request)
    {
        $seminars = Seminar::all();
        $attendance = collect();

        if ($request->filled('seminar_id')) {
            $attendance = DB::table('seminar_attendance')
                ->join('participants', 'participants.id', '=', 'seminar_attendance.participant_id')
                ->where('seminar_attendance.seminar_id', $request->seminar_id)
                ->select('participants.name', 'participants.email', 'seminar_attendance.status')
                ->get();
        }

        return view('attendance.index', compact('seminars', 'attendance'));
    }

    /**
     * Show attendance marking form
     */
    public function create(Request $request)
    {
        $seminars = Seminar::all();
        $participants = Participant::all();

        $selectedSeminar = $request->seminar_id;

        return view('attendance.create', compact('seminars', 'participants', 'selectedSeminar'));
    }

    /**
     * Store attendance (bulk)
     */
    public function store(Request $request)
    {
        $request->validate([
            'seminar_id' => 'required|exists:seminars,id',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $participant_id => $status) {

            DB::table('seminar_attendance')->updateOrInsert(
                [
                    'participant_id' => $participant_id,
                    'seminar_id' => $request->seminar_id,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()
            ->route('attendance.index', ['seminar_id' => $request->seminar_id])
            ->with('success', 'Attendance saved successfully.');
    }

    /**
     * Edit attendance for a seminar
     */
    public function edit($seminar_id)
    {
        $seminar = Seminar::findOrFail($seminar_id);
        $participants = Participant::all();

        $existing = DB::table('seminar_attendance')
            ->where('seminar_id', $seminar_id)
            ->pluck('status', 'participant_id');

        return view('attendance.edit', compact('seminar', 'participants', 'existing'));
    }

    /**
     * Update attendance
     */
    public function update(Request $request, $seminar_id)
    {
        $request->validate([
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $participant_id => $status) {

            DB::table('seminar_attendance')->updateOrInsert(
                [
                    'participant_id' => $participant_id,
                    'seminar_id' => $seminar_id,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()
            ->route('attendance.index', ['seminar_id' => $seminar_id])
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Delete attendance record (optional)
     */
    public function destroy($seminar_id)
    {
        DB::table('seminar_attendance')
            ->where('seminar_id', $seminar_id)
            ->delete();

        return back()->with('success', 'Attendance cleared.');
    }
}