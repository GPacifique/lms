@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <!-- Participant Info -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-2">Participant Details</h2>
        <p><strong>Name:</strong> {{ $participant->name }}</p>
        <p><strong>Email:</strong> {{ $participant->email }}</p>
    </div>

    <!-- Marks Section -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Marks per Module</h2>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Module</th>
                    <th class="p-2 border">Marks</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marks as $mark)
                <tr>
                    <td class="p-2 border">{{ $mark->module->title ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $mark->score }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center p-3">No marks available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Attendance Stats -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Attendance Statistics</h2>

        @php
            $present = $attendance->where('status', 'present')->count();
            $absent = $attendance->where('status', 'absent')->count();
            $total = $attendance->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="bg-green-100 p-4 rounded">
                <p class="text-lg font-bold">{{ $present }}</p>
                <p>Present</p>
            </div>

            <div class="bg-red-100 p-4 rounded">
                <p class="text-lg font-bold">{{ $absent }}</p>
                <p>Absent</p>
            </div>

            <div class="bg-blue-100 p-4 rounded">
                <p class="text-lg font-bold">{{ $total }}</p>
                <p>Total Sessions</p>
            </div>
        </div>
    </div>

    <!-- Seminars Attended -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Seminars Attended</h2>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($seminarsAttended as $seminar)
                <tr>
                    <td class="p-2 border">{{ $seminar->title }}</td>
                    <td class="p-2 border">{{ $seminar->date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center p-3">No seminars attended</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection