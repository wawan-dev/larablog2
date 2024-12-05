<x-guest-layout>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center m-10">
            {{ session('success') }}
        </div>
    @endif

    
    <div class="text-white p-5 ">
       <a href="{{ route('public.index', $article->user->id) }}"> <- Retour aux articles </a>
    </div>
    

    <div>
        @foreach ($article->categories as $category)
            <span class="inline-block px-3 py-1 bg-gray-200 text-black rounded-full text-sm font-medium ml-5 ">
                {{ $category->name }}
            </span>
        @endforeach
    </div>
    <br>
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

    <div>
        @auth
            <a href="{{ route('article.like', $article->id) }}" class="flex inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white ml-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                </svg>
                <span class="text-white ml-2">{{$article->likes}}</span>
            </a>
        @endauth
    </div>

    
    <div class="border-2 border-black rounded-lg m-4 p-4">
        <div class="text-white"> Section commentaire </div> <br>
        @auth
            <form action="{{ route('comments.store') }}" method="post" class="mt-6">
                @csrf
                <input type="hidden" name="articleId" value="{{ $article->id }}">
                <textarea name="content"  placeholder="Votre commentaire"></textarea>
                <button type="submit" class="text-white p-5">Envoyer</button>
                
            </form>
        @endauth

        


        @foreach ($article->comments as $comment)
            <div class="text-white p-5 border-4 border-black rounded-lg shadow-2xl ">
                Commentaire de {{$article->user->name}} : <br>
                
                {{$comment->content}}
            </div>
            <br>
        @endforeach
    </div>

</x-guest-layout>