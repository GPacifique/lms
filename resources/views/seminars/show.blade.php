@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Seminar Details</h2>

    <p><strong>Title:</strong> {{ $seminar->title }}</p>
    <p><strong>Description:</strong> {{ $seminar->description }}</p>
    <p><strong>Date:</strong> {{ $seminar->date }}</p>
    <p><strong>Location:</strong> {{ $seminar->location }}</p>

    <a href="{{ route('seminars.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded mt-4 inline-block">
        Back
    </a>
</div>
@endsection