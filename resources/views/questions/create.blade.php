@extends('layouts.app')

@section('content')

<h1>Create Question</h1>

<form method="POST" action="{{ route('questions.store') }}">
@csrf

<select name="exam_id">
@foreach($exams as $exam)
<option value="{{ $exam->id }}">{{ $exam->title }}</option>
@endforeach
</select>

<textarea name="question_text" class="border block"></textarea>

<select name="type">
<option value="mcq">MCQ</option>
<option value="text">Text</option>
</select>

<button>Save</button>

</form>

@endsection