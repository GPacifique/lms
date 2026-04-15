@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Seminars</h1>
        <a href="{{ route('seminars.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">+ Add</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 p-2 mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($seminars as $s)
            <tr class="border-t">
                <td class="p-2">{{ $s->title }}</td>
                <td>{{ $s->date }}</td>
                <td>{{ $s->location }}</td>
                <td class="flex gap-2 p-2">
                    <a href="{{ route('seminars.show', $s) }}" class="bg-blue-400 px-2 py-1 rounded">View</a>
                    <a href="{{ route('seminars.edit', $s) }}" class="bg-yellow-400 px-2 py-1 rounded">Edit</a>

                    <form method="POST" action="{{ route('seminars.destroy', $s) }}">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $seminars->links() }}
    </div>
</div>
@endsection