<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('pages.update', $page->id) }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($page))
                            @method('PUT')
                        @endif
                        <div class="mt-4">
                            <x-input-label for="page_title" :value="__('Page title')" />
                            <x-text-input id="page_title" class="block mt-1 w-full" type="text" name="page_title" value="{{ old('page_title', $page->page_title ?? '') }}" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="page_content" :value="__('Page content')" />
                            <textarea id="page_content" rows="10" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="page_content" required>{{ old('page_content', $page->page_content ?? '') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="featured_image" :value="__('Featured image')" />
                            <x-text-input id="featured_image" class="block mt-1 w-full" type="file" name="featured_image" />
                            <br>
                            @if($page->featured_image)
                                <a href="{{ asset('storage/' . $page->featured_image) }}" target="_blank" style="display: inline-block">
                                    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->page_title }}" style="width: 300px; height: 300px; object-fit: cover;">
                                </a>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit" class="ml-4" style="margin-right: 10px;">
                                {{ __('Update page') }}
                            </x-primary-button>

                            <a href="{{ route('pages.index') }}">
                                <x-secondary-button class="ml-4">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                            </a>
                        </div>
                    </form>
                    @if ($errors->any())
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
