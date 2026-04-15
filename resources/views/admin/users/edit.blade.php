@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-lg">

<h2 class="font-bold mb-4">Edit User</h2>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
@csrf @method('PUT')

<input name="name" value="{{ $user->name }}" class="input">
<input name="email" value="{{ $user->email }}" class="input">

<label class="block mt-3">Roles</label>

@foreach($roles as $role)
<label class="block">
    <input type="checkbox" name="roles[]"
        value="{{ $role->name }}"
        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
    {{ $role->name }}
</label>
@endforeach

<button class="btn-primary mt-4">Update</button>

</form>

</div>

@endsection