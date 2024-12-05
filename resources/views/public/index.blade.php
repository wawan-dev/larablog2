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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des articles publiés de {{ $user->name }}
        </h2>
    </div>

    <div>
        <!-- Articles -->
        @foreach ($articles as $article)
        <div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-bold">
                <div class=" flex p-2">
                    {{ $article->title }}
                    @foreach ($article->categories as $category)
                        <span class="inline-block px-3 py-1 bg-gray-200 text-black rounded-full text-sm font-medium ml-5 ">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
                <br>
            </h2>
                <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 30) }}...</p>
                
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