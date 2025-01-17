<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Navigations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('navigations.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="nav_title" :value="__('Menu item title')" />
                            <x-text-input id="nav_title" class="block mt-1 w-full" type="text" name="nav_title" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="page" :value="__('Page')" />
                            <select id="page" name="page" class="block mt-1 w-full" style="color: #000;">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->page_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items center justify-end mt-4">
                            <x-primary-button type="submit" class="ml-4" style="margin-right: 10px;">
                                {{ __('Create item') }}
                            </x-primary-button>

                            <a href="{{ route('navigations.index') }}">
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
