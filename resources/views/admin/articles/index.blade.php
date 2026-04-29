@extends('layouts.app')

@section('title', 'Admin — Articles — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    @include('partials.navbar')

    <main class="max-w-6xl mx-auto px-4 py-10">
        {{-- En-tête --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-xs text-amber-400 font-bold uppercase tracking-widest mb-1">Administration</p>
                <h1 class="text-2xl font-bold">Gestion des Articles</h1>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouvel article
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/40 text-green-300 rounded-xl px-5 py-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Liste des articles --}}
        <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-800 bg-slate-900/80">
                    <tr class="text-left">
                        <th class="px-5 py-4 text-xs text-slate-400 font-semibold uppercase tracking-wider">Titre</th>
                        <th class="px-5 py-4 text-xs text-slate-400 font-semibold uppercase tracking-wider hidden md:table-cell">Catégorie</th>
                        <th class="px-5 py-4 text-xs text-slate-400 font-semibold uppercase tracking-wider hidden lg:table-cell">Statut</th>
                        <th class="px-5 py-4 text-xs text-slate-400 font-semibold uppercase tracking-wider hidden lg:table-cell">Date</th>
                        <th class="px-5 py-4 text-xs text-slate-400 font-semibold uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse($articles as $article)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if($article->cover_image)
                                        <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-10 h-10 rounded-lg object-cover" alt="">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-white">{{ Str::limit($article->title, 50) }}</p>
                                        <p class="text-xs text-slate-500">/articles/{{ $article->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 hidden md:table-cell">
                                <span class="px-2 py-1 bg-slate-800 rounded-full text-xs text-slate-300">{{ $article->category }}</span>
                            </td>
                            <td class="px-5 py-4 hidden lg:table-cell">
                                @if($article->is_published)
                                    <span class="flex items-center gap-1.5 text-xs text-green-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Publié
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-xs text-slate-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span> Brouillon
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 hidden lg:table-cell text-slate-400 text-xs">
                                {{ $article->published_at ? $article->published_at->format('d/m/Y') : '—' }}
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($article->is_published)
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="p-2 rounded-lg hover:bg-slate-700 transition text-slate-400 hover:text-white" title="Voir">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 rounded-lg hover:bg-amber-500/20 transition text-slate-400 hover:text-amber-400" title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Supprimer cet article ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 transition text-slate-400 hover:text-red-400" title="Supprimer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center text-slate-500">
                                Aucun article. <a href="{{ route('admin.articles.create') }}" class="text-amber-400 hover:underline">Créer le premier →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($articles->hasPages())
                <div class="px-5 py-4 border-t border-slate-800">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
