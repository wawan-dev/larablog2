<x-guest-layout>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center m-10">
            {{ session('success') }}
        </div>
    @endif

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

        
    

    @auth
        <form action="{{ route('comments.store') }}" method="post" class="mt-6">
            @csrf
            <input type="hidden" name="articleId" value="{{ $article->id }}">
            <textarea name="content"  placeholder="Votre commentaire"></textarea>
            <button type="submit" class="text-white p-5">Envoyer</button>
            
        </form>
    @endauth


</x-guest-layout>