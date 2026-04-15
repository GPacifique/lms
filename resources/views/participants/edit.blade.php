
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Edit Participant</h2>

    <form method="POST" action="{{ route('participants.update', $participant) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $participant->name }}" class="w-full border p-2 mb-3">

        <input type="email" name="email" value="{{ $participant->email }}" class="w-full border p-2 mb-3">

        <input type="text" name="phone" value="{{ $participant->phone }}" class="w-full border p-2 mb-3">

        <select name="gender" class="w-full border p-2 mb-3">
            <option value="male" {{ $participant->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $participant->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>

        <input type="date" name="date_of_birth"
               value="{{ $participant->date_of_birth }}"
               class="w-full border p-2 mb-3">

        <button class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection