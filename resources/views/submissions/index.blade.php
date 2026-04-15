@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Submissions</h1>

<table class="w-full bg-white shadow rounded">
    <tr class="bg-gray-200">
        <th class="p-2">Participant</th>
        <th class="p-2">Exam</th>
        <th class="p-2">Score</th>
        <th class="p-2">Grade</th>
    </tr>

    @foreach($submissions as $submission)
    <tr class="border-t">
        <td class="p-2">
            {{ $submission->participant->name ?? 'N/A' }}
        </td>

        <td class="p-2">
            {{ $submission->exam->title ?? 'N/A' }}
        </td>

        <td class="p-2">
            {{ $submission->score }}
        </td>

        <td class="p-2">
            @php
                $grade = 'F';
                if ($submission->score >= 80) $grade = 'A';
                elseif ($submission->score >= 70) $grade = 'B';
                elseif ($submission->score >= 60) $grade = 'C';
                elseif ($submission->score >= 50) $grade = 'D';
            @endphp

            <span class="font-bold">{{ $grade }}</span>
        </td>
    </tr>
    @endforeach

</table>

<div class="mt-4">
    {{ $submissions->links() }}
</div>

@endsection