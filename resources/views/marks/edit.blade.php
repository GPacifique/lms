@extends('layouts.app')

@section('content')

<div class="card fade-in">
    <h2>Edit Mark</h2>

    <form method="POST" action="{{ route('marks.update', $mark) }}">
        @csrf
        @method('PUT')

        <label>Participant</label>
        <select name="participant_id">
            @foreach($participants as $p)
                <option value="{{ $p->id }}" {{ $mark->participant_id == $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>

        <label>Exam</label>
        <select name="exam_id">
            @foreach($exams as $e)
                <option value="{{ $e->id }}" {{ $mark->exam_id == $e->id ? 'selected' : '' }}>
                    {{ $e->title }}
                </option>
            @endforeach
        </select>

        <label>Score</label>
        <input type="number" name="score" value="{{ $mark->score }}">

        <label>Total</label>
        <input type="number" name="total" value="{{ $mark->total }}">

        <br><br>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('marks.index') }}" class="btn">Cancel</a>
    </form>
</div>

@endsection