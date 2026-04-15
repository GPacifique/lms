<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions (filter by exam)
     */
    public function index(Request $request)
    {
        $query = Question::with('exam');

        // Filter by exam
        if ($request->filled('exam_id')) {
            $query->where('exam_id', $request->exam_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('question_text', 'like', '%' . $request->search . '%');
        }

        $questions = $query->latest()->paginate(10);
        $exams = Exam::all();

        return view('questions.index', compact('questions', 'exams'));
    }

    /**
     * Show form to create question
     */
    public function create(Request $request)
    {
        $exams = Exam::all();
        $exam_id = $request->exam_id;

        return view('questions.create', compact('exams', 'exam_id'));
    }

    /**
     * Store new question
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_id'       => 'required|exists:exams,id',
            'question_text' => 'required|string',
            'type'          => 'required|in:mcq,text',
        ]);

        $question = Question::create($validated);

        return redirect()
            ->route('questions.index', ['exam_id' => $validated['exam_id']])
            ->with('success', 'Question created successfully.');
    }

    /**
     * Show question details
     */
    public function show(Question $question)
    {
        $question->load('exam', 'answers');

        return view('questions.show', compact('question'));
    }

    /**
     * Show edit form
     */
    public function edit(Question $question)
    {
        $exams = Exam::all();

        return view('questions.edit', compact('question', 'exams'));
    }

    /**
     * Update question
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'exam_id'       => 'required|exists:exams,id',
            'question_text' => 'required|string',
            'type'          => 'required|in:mcq,text',
        ]);

        $question->update($validated);

        return redirect()
            ->route('questions.index', ['exam_id' => $validated['exam_id']])
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Delete question
     */
    public function destroy(Question $question)
    {
        $exam_id = $question->exam_id;

        $question->delete();

        return redirect()
            ->route('questions.index', ['exam_id' => $exam_id])
            ->with('success', 'Question deleted successfully.');
    }
}