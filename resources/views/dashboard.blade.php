<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Les articles') }}
        </h2>
    </x-slot>

    <!-- Message flash -->
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center m-10">
        {{ session('success') }}
    </div>
    @endif

    <!-- Articles -->
    @foreach ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 m-10 ">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                <p class="text-gray-700">{{ substr($article->content, 0, 30) }}...</p>
                <div class="text-right">
                    <a href="{{ route('articles.edit', $article->id) }}" class="text-red-500 hover:text-red-700">Modifier</a>
                </div>
            </div>
        </div>
    @endforeach
    <div class=" mt-6 flex justify-center p-5">
        {{$articles->links()}}
    </div>
</x-app-layout>
