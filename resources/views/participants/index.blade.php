
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Participants</h1>
        <a href="{{ route('participants.create') }}"
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
                <th class="p-2">Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($participants as $p)
            <tr class="border-t">
                <td class="p-2">{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->phone }}</td>
                <td>{{ ucfirst($p->gender) }}</td>
                <td class="flex gap-2 p-2">
                    <a href="{{ route('participants.show', $p) }}" class="bg-blue-400 px-2 py-1 rounded">View</a>
                    <a href="{{ route('participants.edit', $p) }}" class="bg-yellow-400 px-2 py-1 rounded">Edit</a>

                    <form method="POST" action="{{ route('participants.destroy', $p) }}">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $participants->links() }}
    </div>
</div>
@endsection