<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);
        $cat = $request->only(['categories']);
        // Créateur de l'article (auteur)
        $data['user_id'] = Auth::user()->id;

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On crée l'article
        $article = Article::create($data); // $Article est l'objet article nouvellement créé

        // Exemple pour ajouter des catégories à l'article en venant du formulaire
        $article->categories()->sync($cat['categories']);
        

        // On redirige l'utilisateur vers la liste des articles
        return redirect()->route('dashboard');
    }

    public function index()
    {
        // On récupère l'utilisateur connecté.
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->get();

        // On retourne la vue.
        return view('dashboard', [
            'articles' => $articles,
            
        ]);
    }
}
