<x-guest-layout>

    <div class="text-white p-5 ">
       <a href="{{ route('public.index', $article->user->id) }}"> <- Retour aux articles </a>
    </div>

    <div >
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->title }}
        </h2>
    </div>

    <div class="text-gray-500 text-sm">
        Publié le {{ $article->created_at->format('d/m/Y') }} par {{ $article->user->name }}
    </div>

    <div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
        </div>
    </div>
</x-guest-layout>