@auth
    @include('layouts.navigation')
@endauth

@guest
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
        </div>
    @endif
@endguest

<x-guest-layout>
    
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center m-10">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Liste des articles les plus likés
        </h2>
    </div>

    <div>
        <!-- Articles -->
        @foreach ($articles as $article)
        <div class="bg-white m-10 rounded-lg ">
            <div class="p-6 text-dark-900 dark:text-dark-100">
            <h2 class="text-2xl font-bold">
                <div class=" flex p-2">
                    {{ $article->title }}
                    @foreach ($article->categories as $category)
                        <span class="inline-block px-3 py-1 bg-red-200 text-black rounded-full text-sm font-medium ml-5 ">
                            {{ $category->name }}
                        </span>
                    @endforeach
                    
                    @auth
                        <a href="{{ route('article.like', $article->id) }}" class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-dark ml-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                            </svg>
                            <span class="text-dark ml-2">{{$article->likes}}</span>
                        </a>
                    @endauth
                </div>
                </div>
                <br>
            </h2>
            <div class="p-5">
                <p class="text-dark-700 dark:text-dark-300">{{ substr($article->content, 0, 30) }}...</p>
                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-red-500 hover:text-red-700">Lire la suite</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    <div class=" mt-6 flex justify-center p-5">
        {{$articles->links()}}
    </div>
</x-guest-layout>