@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Create Seminar</h2>

    <form method="POST" action="{{ route('seminars.store') }}">
        @csrf

        <input type="text" name="title" placeholder="Title" class="w-full border p-2 mb-3">

        <textarea name="description" placeholder="Description" class="w-full border p-2 mb-3"></textarea>

        <input type="date" name="date" class="w-full border p-2 mb-3">

        <input type="text" name="location" placeholder="Location" class="w-full border p-2 mb-3">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection