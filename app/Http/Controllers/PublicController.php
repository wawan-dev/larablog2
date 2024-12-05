<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->paginate(5);
        
        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);       
    }

    public function home(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('draft', 0)->orderBy('likes', 'desc')->paginate(5);
        
        // On retourne la vue
        return view('public.home', [
            'articles' => $articles,
            'user' => $user
        ]);       
    }

    public function show(User $user, Article $article)
    {
        // $user est l'utilisateur de l'article
        // $article est l'article à afficher

        // Je vous laisse faire le code
        $article = Article::where('user_id', $user->id)->where('id', $article->id)->where('draft', 0)->First();

        
        // On retourne la vue
        return view('public.show', [
            'article' => $article,
            'user' => $user,
            
        ]);
    }
}
