@extends('layouts.app')

@section('content')

<h1>Exams</h1>

<a href="{{ route('exams.create') }}">Create Exam</a>

<table class="w-full mt-4 bg-white">
<tr>
    <th>Title</th>
    <th>Type</th>
    <th>Total Marks</th>
</tr>

@foreach($exams as $exam)
<tr>
    <td>{{ $exam->title }}</td>
    <td>{{ $exam->type }}</td>
    <td>{{ $exam->total_marks }}</td>
</tr>
@endforeach

</table>

@endsection