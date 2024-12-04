<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Récupération des valeurs
        $content = $request->input('content');
        $articleId = $request->input('articleId');

        // Vérification de l'authentification
        if (Auth::check()) {
            // Création du commentaire
            Comment::create([
                'content' => $content,
                'article_id' => $articleId,
                'user_id' => Auth::user()->id,
            ]);

            // Redirection après succès
            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
        } else {
            // Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
            return redirect()->route('login');
        }
    }
}
