@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Attendance</h1>

<!-- FILTER BY SEMINAR -->
<form method="GET" class="mb-4">
    <select name="seminar_id" class="border p-2">
        <option value="">-- Select Seminar --</option>
        @foreach($seminars as $seminar)
            <option value="{{ $seminar->id }}"
                {{ request('seminar_id') == $seminar->id ? 'selected' : '' }}>
                {{ $seminar->title }}
            </option>
        @endforeach
    </select>

    <button class="bg-blue-500 text-white px-4 py-2">Filter</button>
</form>

<a href="{{ route('attendance.create') }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">
    Mark Attendance
</a>

<!-- TABLE -->
<table class="w-full bg-white shadow rounded">
    <tr class="bg-gray-200">
        <th class="p-2">Name</th>
        <th class="p-2">Email</th>
        <th class="p-2">Status</th>
    </tr>

    @forelse($attendance as $row)
    <tr class="border-t">
        <td class="p-2">{{ $row->name }}</td>
        <td class="p-2">{{ $row->email }}</td>
        <td class="p-2">
            <span class="{{ $row->status == 'present' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($row->status) }}
            </span>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="text-center p-4">No attendance records found</td>
    </tr>
    @endforelse

</table>

@endsection