<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Liste tous les articles publiés
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        $query = Article::published()->latest('published_at');

        if ($category) {
            $query->where('category', $category);
        }

        $articles = $query->paginate(12);

        $categories = Article::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('articles', compact('articles', 'categories', 'category'));
    }

    /**
     * Affiche un article par son slug
     */
    public function show(string $slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        // Articles connexes (même catégorie)
        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'related'));
    }
}
