<?php
namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(10);
        return view('participants.index', compact('participants'));
    }

    public function create()
    {
        return view('participants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'nullable|date'
        ]);

        Participant::create($validated);

        return redirect()->route('participants.index')
            ->with('success', 'Participant created successfully!');
    }

    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'nullable|date'
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')
            ->with('success', 'Participant updated successfully!');
    }
    public function show(Participant $participant)
{
    $marks = $participant->marks()->with('module')->get();

$labels = $marks->map(fn($m) => $m->module->title);
$data = $marks->map(fn($m) => $m->score);

$attendanceStats = [
    'present' => $attendance->where('status', 'present')->count(),
    'absent' => $attendance->where('status', 'absent')->count(),
];
    $marks = $participant->marks()->with('module')->get();

    $attendance = \DB::table('seminar_attendance')
        ->where('participant_id', $participant->id)
        ->get();

    $seminarsAttended = \DB::table('seminar_attendance')
        ->join('seminars', 'seminars.id', '=', 'seminar_attendance.seminar_id')
        ->where('participant_id', $participant->id)
        ->where('status', 'present')
        ->select('seminars.title', 'seminars.date')
        ->get();

    return view('participants.show',compact(
        'participant',
        'marks',
        'attendance',
        'seminarsAttended',
    'labels',
    'data',
    'attendanceStats'
    ));
}

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return back()->with('success', 'Participant deleted successfully!');
    }
}