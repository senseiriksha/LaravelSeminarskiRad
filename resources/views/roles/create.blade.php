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
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="role_name" :value="__('Name')" />
                            <x-text-input id="role_name" class="block mt-1 w-full" type="text" name="role_name" required autofocus />
                        </div>
                        <div class="flex items center justify-end mt-4">
                            <x-primary-button type="submit" class="ml-4" style="margin-right: 10px;">
                                {{ __('Create role') }}
                            </x-primary-button>

                            <a href="{{ route('roles.index') }}">
                                <x-secondary-button class="ml-4">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                            </a>
                        </div>
                    </form>
                    @if ($errors->any())
                        <br>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
