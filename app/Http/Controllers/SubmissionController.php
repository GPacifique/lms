<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Exam;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    /**
     * Display submissions (filter by exam/participant)
     */
    public function index(Request $request)
    {
        $query = Submission::with(['participant', 'exam']);

        if ($request->filled('exam_id')) {
            $query->where('exam_id', $request->exam_id);
        }

        if ($request->filled('participant_id')) {
            $query->where('participant_id', $request->participant_id);
        }

        $submissions = $query->latest()->paginate(10);
        $exams = Exam::all();
        $participants = Participant::all();

        return view('submissions.index', compact('submissions', 'exams', 'participants'));
    }

    /**
     * Show exam submission form (student side)
     */
    public function create(Exam $exam)
    {
        $exam->load('questions.answers');

        return view('submissions.create', compact('exam'));
    }

    /**
     * Store submission (AUTO GRADING for MCQ)
     */
    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $participant = Participant::where('email', Auth::user()->email)->first();

        $score = 0;

        foreach ($exam->questions as $question) {
            if ($question->type === 'mcq') {

                $correctAnswer = $question->answers()->where('is_correct', true)->first();

                if (
                    isset($request->answers[$question->id]) &&
                    $request->answers[$question->id] == $correctAnswer?->id
                ) {
                    $score++;
                }
            }
        }

        $submission = Submission::create([
            'participant_id' => $participant->id,
            'exam_id' => $exam->id,
            'score' => $score,
            'graded_by' => Auth::id(),
        ]);

        return redirect()
            ->route('submissions.show', $submission)
            ->with('success', 'Exam submitted successfully.');
    }

    /**
     * Display submission result
     */
    public function show(Submission $submission)
    {
        $submission->load('participant', 'exam');

        $grade = $this->calculateGrade($submission->score);

        return view('submissions.show', compact('submission', 'grade'));
    }

    /**
     * Manual grading (for text questions)
     */
    public function grade(Request $request, Submission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0',
        ]);

        $submission->update([
            'score' => $request->score,
            'graded_by' => Auth::id(),
        ]);

        return back()->with('success', 'Submission graded successfully.');
    }

    /**
     * Delete submission
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return back()->with('success', 'Submission deleted.');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: GRADE CALCULATION
    |--------------------------------------------------------------------------
    */

    private function calculateGrade($score)
    {
        return match (true) {
            $score >= 80 => 'A',
            $score >= 70 => 'B',
            $score >= 60 => 'C',
            $score >= 50 => 'D',
            default => 'F',
        };
    }
}