@extends('layouts.app')

@section('content')

<h1>Create Module</h1>

<form method="POST" action="{{ route('modules.store') }}">
@csrf

<input name="title" placeholder="Title" class="border p-2 block mb-2">

<select name="instructor_id" class="border p-2 block mb-2">
@foreach($instructors as $i)
<option value="{{ $i->id }}">{{ $i->name }}</option>
@endforeach
</select>

<button class="bg-blue-500 text-white px-4 py-2">Save</button>

</form>

@endsection