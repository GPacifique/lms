<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Participant;
use App\Models\Exam;
use App\Models\Module;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display list of marks
     */
    public function index()
    {
        $marks = Mark::with(['participant', 'exam'])
            ->latest()
            ->get();

        return view('marks.index', compact('marks'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $participants = Participant::all();
        $exams = Exam::all();
        $modules = Module::all();

        return view('marks.create', compact('participants', 'exams', 'modules'));
    }

    /**
     * Store new mark
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'module_id'        => 'required|exists:modules,id',
            'score'          => 'required|numeric|min:0',
            'total'          => 'nullable|numeric|min:1'
        ]);

        // Prevent duplicate (same participant + module)
        $exists = Mark::where('participant_id', $validated['participant_id'])
            ->where('module_id', $validated['module_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Mark already recorded for this participant in this exam.');
        }

        Mark::create([
            'participant_id' => $validated['participant_id'],
            'module_id'        => $validated['module_id'],
            'score'          => $validated['score'],
            'total'          => $validated['total'] ?? 100,
        ]);

        return redirect()->route('marks.index')
            ->with('success', 'Mark recorded successfully!');
    }

    /**
     * Show single mark
     */
    public function show(Mark $mark)
    {
        $mark->load(['participant', 'module']);

        return view('marks.show', compact('mark'));
    }

    /**
     * Show edit form
     */
    public function edit(Mark $mark)
    {
        $participants = Participant::all();
        $modules = Module::all();

        return view('marks.edit', compact('mark', 'participants', 'modules'));
    }

    /**
     * Update mark
     */
    public function update(Request $request, Mark $mark)
    {
        $validated = $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'module_id'        => 'required|exists:modules,id',
            'score'          => 'required|numeric|min:0',
            'total'          => 'nullable|numeric|min:1'
        ]);

        $mark->update([
            'participant_id' => $validated['participant_id'],
            'module_id'        => $validated['module_id'],
            'score'          => $validated['score'],
            'total'          => $validated['total'] ?? 100,
        ]);

        return redirect()->route('marks.index')
            ->with('success', 'Mark updated successfully!');
    }

    /**
     * Delete mark
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();

        return redirect()->route('marks.index')
            ->with('success', 'Mark deleted successfully!');
    }
}