@extends('layouts.app')

@section('content')

<div class="card fade-in">
    <h2>Add Mark</h2>

    <form method="POST" action="{{ route('marks.store') }}">
        @csrf

        <label>Participant</label>
        <select name="participant_id" required>
            @foreach($participants as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>

        <label>Module</label>
        <select name="module_id" required>
            @foreach($modules as $m)
                <option value="{{ $m->id }}">{{ $m->title }}</option>
            @endforeach
        </select>

        <label>Score</label>
        <input type="number" name="score" required>

        <label>Total</label>
        <input type="number" name="total" value="100">

        <br><br>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('marks.index') }}" class="btn">Cancel</a>
    </form>
</div>

@endsection