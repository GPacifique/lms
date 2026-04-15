@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Create Exam</h1>

<form method="POST" action="{{ route('exams.store') }}">
    @csrf

    <!-- MODULE -->
    <div class="mb-4">
        <label class="block">Module</label>
        <select name="module_id" class="border p-2 w-full">
            @foreach($modules as $module)
                <option value="{{ $module->id }}">
                    {{ $module->title }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- TITLE -->
    <div class="mb-4">
        <label class="block">Title</label>
        <input type="text" name="title" class="border p-2 w-full" required>
    </div>

    <!-- TYPE -->
    <div class="mb-4">
        <label class="block">Type</label>
        <select name="type" class="border p-2 w-full">
            <option value="test">Test</option>
            <option value="exam">Final Exam</option>
        </select>
    </div>

    <!-- TOTAL MARKS -->
    <div class="mb-4">
        <label class="block">Total Marks</label>
        <input type="number" name="total_marks" class="border p-2 w-full" required>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2">
        Save Exam
    </button>

</form>

@endsection