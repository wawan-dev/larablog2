<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Articles -->
    @foreach ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 m-10 ">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                <p class="text-gray-700">{{ substr($article->content, 0, 30) }}...</p>
            </div>
        </div>
    @endforeach
</x-app-layout>
