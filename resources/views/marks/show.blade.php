@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">

    <!-- Title -->
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Mark Details
    </h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Details -->
    <div class="space-y-4 text-gray-700">

        <div>
            <span class="font-semibold">Participant:</span>
            {{ $mark->participant->name ?? 'N/A' }}
        </div>

        <div>
            <span class="font-semibold">Module:</span>
            {{ $mark->module->title ?? 'N/A' }}
        </div>

        <div>
            <span class="font-semibold">Score:</span>
            {{ $mark->score }}
        </div>

        <div>
            <span class="font-semibold">Total:</span>
            {{ $mark->total }}
        </div>

        <div>
            <span class="font-semibold">Percentage:</span>
            {{ round(($mark->score / $mark->total) * 100, 2) }}%
        </div>

        <!-- Optional Grade -->
        <div>
            <span class="font-semibold">Grade:</span>
            @php
                $percent = ($mark->score / $mark->total) * 100;
            @endphp

            @if($percent >= 80)
                A
            @elseif($percent >= 70)
                B
            @elseif($percent >= 60)
                C
            @elseif($percent >= 50)
                D
            @else
                F
            @endif
        </div>

    </div>

    <!-- Actions -->
    <div class="mt-6 flex gap-3">

        <a href="{{ route('marks.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>

        <a href="{{ route('marks.edit', $mark) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
            Edit
        </a>

        <form action="{{ route('marks.destroy', $mark) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this mark?')">
            @csrf
            @method('DELETE')

            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Delete
            </button>
        </form>

    </div>

</div>

@endsection