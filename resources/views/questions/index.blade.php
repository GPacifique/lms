@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Questions</h1>

<!-- FILTER BY EXAM -->
<form method="GET" class="mb-4">
    <select name="exam_id" class="border p-2">
        <option value="">-- Select Exam --</option>
        @foreach($exams as $exam)
            <option value="{{ $exam->id }}"
                {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                {{ $exam->title }}
            </option>
        @endforeach
    </select>

    <button class="bg-blue-500 text-white px-4 py-2">Filter</button>
</form>

<a href="{{ route('questions.create') }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">
    Add Question
</a>

<!-- TABLE -->
<table class="w-full bg-white shadow rounded">
    <tr class="bg-gray-200">
        <th class="p-2">Exam</th>
        <th class="p-2">Question</th>
        <th class="p-2">Type</th>
        <th class="p-2">Actions</th>
    </tr>

    @forelse($questions as $question)
    <tr class="border-t">
        <td class="p-2">
            {{ $question->exam->title ?? 'N/A' }}
        </td>

        <td class="p-2">
            {{ $question->question_text }}
        </td>

        <td class="p-2">
            <span class="text-sm bg-gray-200 px-2 py-1 rounded">
                {{ strtoupper($question->type) }}
            </span>
        </td>

        <td class="p-2 space-x-2">
            <a href="{{ route('questions.edit', $question) }}" class="text-blue-600">Edit</a>

            <form method="POST" action="{{ route('questions.destroy', $question) }}" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600">Delete</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center p-4">No questions found</td>
    </tr>
    @endforelse

</table>

<div class="mt-4">
    {{ $questions->links() }}
</div>

@endsection