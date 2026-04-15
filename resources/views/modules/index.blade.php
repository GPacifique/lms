@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Modules</h1>

<a href="{{ route('modules.create') }}" class="bg-blue-500 text-white px-4 py-2">Create</a>

<table class="w-full mt-4 bg-white">
<tr>
    <th>Title</th>
    <th>Instructor</th>
    <th>Action</th>
</tr>

@foreach($modules as $m)
<tr>
    <td>{{ $m->title }}</td>
    <td>{{ $m->instructor->name ?? '' }}</td>
    <td>
        <a href="{{ route('modules.show',$m) }}">View</a>
        <a href="{{ route('modules.edit',$m) }}">Edit</a>
    </td>
</tr>
@endforeach

</table>

@endsection