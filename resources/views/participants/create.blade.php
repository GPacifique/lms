
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Add Participant</h2>

    <form method="POST" action="{{ route('participants.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name" class="w-full border p-2 mb-3">

        <input type="email" name="email" placeholder="Email" class="w-full border p-2 mb-3">

        <input type="text" name="phone" placeholder="Phone" class="w-full border p-2 mb-3">

        <select name="gender" class="w-full border p-2 mb-3">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <input type="date" name="date_of_birth" class="w-full border p-2 mb-3">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection