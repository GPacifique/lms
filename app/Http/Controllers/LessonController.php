<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of lessons (with search & filter)
     */
    public function index(Request $request)
    {
        $query = Lesson::with('module');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by module
        if ($request->filled('module_id')) {
            $query->where('module_id', $request->module_id);
        }

        $lessons = $query->latest()->paginate(10);
        $modules = Module::all();

        return view('lessons.index', compact('lessons', 'modules'));
    }

    /**
     * Show the form for creating a new lesson
     */
    public function create()
    {
        $modules = Module::all();
        return view('lessons.create', compact('modules'));
    }

    /**
     * Store a newly created lesson
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
        ]);

        Lesson::create($validated);

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified lesson
     */
    public function show(Lesson $lesson)
    {
        $lesson->load('module');

        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the lesson
     */
    public function edit(Lesson $lesson)
    {
        $modules = Module::all();
        return view('lessons.edit', compact('lesson', 'modules'));
    }

    /**
     * Update the specified lesson
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
        ]);

        $lesson->update($validated);

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified lesson
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson deleted successfully.');
    }
}