@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-lg">

<h2 class="font-bold mb-4">Create User</h2>

<form method="POST" action="{{ route('admin.users.store') }}">
@csrf

<input name="name" placeholder="Name" class="input" required>
<input name="email" type="email" placeholder="Email" class="input" required>
<input name="password" type="password" placeholder="Password" class="input" required>

<label class="block mt-3">Roles</label>

@foreach($roles as $role)
<label class="block">
    <input type="checkbox" name="roles[]" value="{{ $role->name }}">
    {{ $role->name }}
</label>
@endforeach

<button class="btn-primary mt-4">Save</button>

</form>

</div>

@endsection