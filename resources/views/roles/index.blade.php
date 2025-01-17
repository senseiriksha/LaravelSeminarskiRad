<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        <br>
                    @endif
                    <table cellpadding="10" style="width:100%; text-align: center;">
                        <tr style="border-bottom: 1px solid #fff;">
                            <th>Role name</th>
                            @if (Auth::user()->roles->contains('id', 1))
                                <th colspan="2">Actions</th>
                            @endif
                        </tr>
                        @foreach ($roles as $role)
                        <tr style="border-bottom: 1px solid #fff;">
                            <td>{{ $role->role_name }}</td>
                            @if (Auth::user()->roles->contains('id', 1))
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                                            onclick="return confirm('Are you sure you want to delete this role?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <a href="{{ route('roles.create') }}">
                        <x-primary-button class="ms-3">
                            {{ __('Create new role') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
