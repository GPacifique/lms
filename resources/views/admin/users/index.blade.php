@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-lg font-bold">Users</h2>

        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add User
        </a>
    </div>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="p-2">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    @foreach($user->roles as $role)
                        <span class="bg-green-100 px-2 py-1 rounded text-xs">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </td>

                <td class="space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="text-blue-600">Edit</a>

                    <form method="POST"
                          action="{{ route('admin.users.destroy', $user) }}"
                          class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>

@endsection