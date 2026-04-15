@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Marks Management</h1>

        <a href="{{ route('marks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Add Mark
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3">#</th>
                    <th class="p-3">Participant</th>
                    <th class="p-3">Exam</th>
                    <th class="p-3">Score</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">%</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($marks as $mark)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3">{{ $loop->iteration }}</td>

                        <td class="p-3">
                            {{ $mark->participant->name ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $mark->exam->title ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $mark->score }}
                        </td>

                        <td class="p-3">
                            {{ $mark->total }}
                        </td>

                        <td class="p-3 font-semibold">
                            {{ round(($mark->score / $mark->total) * 100, 2) }}%
                        </td>

                        <td class="p-3 flex gap-2 justify-center">

                            <!-- View -->
                            <a href="{{ route('marks.show', $mark) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                                View
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('marks.edit', $mark) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('marks.destroy', $mark) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this mark?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-gray-500">
                            No marks found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection