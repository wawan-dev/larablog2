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
        return redirect()->route('dashboard')->with('success', 'Article Ajouter !');;
    }

    public function index()
    {
        // On récupère l'utilisateur connecté.
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->paginate(5);

        // On retourne la vue.
        return view('dashboard', [
            'articles' => $articles,
            
        ]);
    }

    public function edit(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article !");
        }

        // On retourne la vue avec l'article
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit de modifier cet article !");
        }

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On met à jour l'article
        $article->update($data);

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        
        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function remove(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit de supprimer cet article !");
        }
        
        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Article supprimer !');
    }
}
