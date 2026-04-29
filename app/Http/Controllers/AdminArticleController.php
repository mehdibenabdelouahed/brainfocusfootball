<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = [
            'Alimentation', 'Au sein du groupe', 'Blessures', 'Contrats',
            'Exercices', 'Facteurs externes', 'Formation', 'Histoire',
            'Le coaching', 'Préparation mentale', 'Préparation physique',
            'Rôles', 'Techniques et tactiques',
        ];
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', 'unique:articles,slug'],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'content'      => ['required', 'string'],
            'category'     => ['required', 'string', 'max:100'],
            'cover_image'  => ['nullable', 'image', 'max:4096'],
            'reading_time' => ['nullable', 'integer', 'min:1', 'max:120'],
            'is_published' => ['boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        if (!empty($validated['is_published'])) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article publié avec succès !');
    }

    public function edit(Article $article)
    {
        $categories = [
            'Alimentation', 'Au sein du groupe', 'Blessures', 'Contrats',
            'Exercices', 'Facteurs externes', 'Formation', 'Histoire',
            'Le coaching', 'Préparation mentale', 'Préparation physique',
            'Rôles', 'Techniques et tactiques',
        ];
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', 'unique:articles,slug,' . $article->id],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'content'      => ['required', 'string'],
            'category'     => ['required', 'string', 'max:100'],
            'cover_image'  => ['nullable', 'image', 'max:4096'],
            'reading_time' => ['nullable', 'integer', 'min:1', 'max:120'],
            'is_published' => ['boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        // Gérer published_at
        if (!empty($validated['is_published']) && !$article->published_at) {
            $validated['published_at'] = now();
        } elseif (empty($validated['is_published'])) {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour !');
    }

    public function destroy(Article $article)
    {
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }
}
