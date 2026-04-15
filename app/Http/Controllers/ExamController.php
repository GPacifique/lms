<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Module;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of exams (with search & filter)
     */
    public function index(Request $request)
    {
        $query = Exam::with('module');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by module
        if ($request->filled('module_id')) {
            $query->where('module_id', $request->module_id);
        }

        $exams = $query->latest()->paginate(10);
        $modules = Module::all();

        return view('exams.index', compact('exams', 'modules'));
    }

    /**
     * Show the form for creating a new exam
     */
    public function create()
    {
        $modules = Module::all();
        return view('exams.create', compact('modules'));
    }

    /**
     * Store a newly created exam
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id'   => 'required|exists:modules,id',
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:test,exam',
            'total_marks' => 'required|integer|min:1',
        ]);

        Exam::create($validated);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified exam
     */
    public function show(Exam $exam)
    {
        $exam->load('module', 'questions.answers');

        return view('exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the exam
     */
    public function edit(Exam $exam)
    {
        $modules = Module::all();
        return view('exams.edit', compact('exam', 'modules'));
    }

    /**
     * Update the specified exam
     */
    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'module_id'   => 'required|exists:modules,id',
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:test,exam',
            'total_marks' => 'required|integer|min:1',
        ]);

        $exam->update($validated);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified exam
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam deleted successfully.');
    }
}