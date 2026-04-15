@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Edit Seminar</h2>

    <form method="POST" action="{{ route('seminars.update', $seminar) }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $seminar->title }}" class="w-full border p-2 mb-3">

        <textarea name="description" class="w-full border p-2 mb-3">{{ $seminar->description }}</textarea>

        <input type="date" name="date" value="{{ $seminar->date }}" class="w-full border p-2 mb-3">

        <input type="text" name="location" value="{{ $seminar->location }}" class="w-full border p-2 mb-3">

        <button class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection