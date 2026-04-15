@extends('layouts.app')

@section('content')

<h1>{{ $exam->title }}</h1>

<form method="POST" action="{{ route('submissions.store', $exam) }}">
@csrf

@foreach($exam->questions as $q)

<div class="mb-4">
    <p>{{ $q->question_text }}</p>

    @if($q->type == 'mcq')
        @foreach($q->answers as $a)
            <label>
                <input type="radio" name="answers[{{ $q->id }}]" value="{{ $a->id }}">
                {{ $a->answer_text }}
            </label><br>
        @endforeach
    @else
        <textarea name="answers[{{ $q->id }}]" class="border w-full"></textarea>
    @endif
</div>

@endforeach

<button class="bg-green-500 text-white px-4 py-2">Submit</button>

</form>

@endsection