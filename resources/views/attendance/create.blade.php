@extends('layouts.app')

@section('content')

<h1>Mark Attendance</h1>

<form method="POST" action="{{ route('attendance.store') }}">
@csrf

<select name="seminar_id">
@foreach($seminars as $s)
<option value="{{ $s->id }}">{{ $s->title }}</option>
@endforeach
</select>

@foreach($participants as $p)
<div>
    {{ $p->name }}
    <select name="attendance[{{ $p->id }}]">
        <option value="present">Present</option>
        <option value="absent">Absent</option>
    </select>
</div>
@endforeach

<button>Save</button>

</form>

@endsection