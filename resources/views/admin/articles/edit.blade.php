@extends('layouts.app')

@section('title', 'Modifier — ' . $article->title . ' — Admin BFF')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <style>
        trix-toolbar .trix-button-group { border-color: #334155 !important; }
        trix-toolbar .trix-button { background-color: #1e293b !important; color: #cbd5e1 !important; border-color: #334155 !important; }
        trix-toolbar .trix-button--active { background-color: #f59e0b !important; color: #0f172a !important; }
        trix-editor { min-height: 400px !important; border-radius: 0.75rem !important; border-color: #334155 !important; background-color: rgba(30, 41, 59, 0.5) !important; color: #f8fafc !important; }
        trix-editor:focus { border-color: #f59e0b !important; ring: 2px #f59e0b !important; }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endpush

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 py-10">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('admin.articles.index') }}" class="text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <p class="text-xs text-amber-400 font-bold uppercase tracking-widest">Administration</p>
                <h1 class="text-2xl font-bold">Modifier l'article</h1>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/40 rounded-xl p-4 text-sm text-red-300">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Titre <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                        class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Slug (URL)</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition font-mono text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Catégorie <span class="text-red-400">*</span></label>
                    <select name="category" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $article->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Résumé</label>
                    <textarea name="excerpt" rows="2"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition resize-none">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Contenu <span class="text-red-400">*</span></label>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                    <trix-editor input="content" class="trix-content"></trix-editor>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Image de couverture</label>
                    @if($article->cover_image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-32 h-20 object-cover rounded-lg border border-slate-700" alt="">
                            <p class="text-xs text-slate-500 mt-1">Image actuelle</p>
                        </div>
                    @endif
                    <input type="file" name="cover_image" accept="image/*"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-slate-400 file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-amber-500/20 file:text-amber-400 cursor-pointer">
                    <p class="text-xs text-slate-500 mt-1">Laisser vide pour conserver l'image actuelle</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Temps de lecture (min)</label>
                    <input type="number" name="reading_time" value="{{ old('reading_time', $article->reading_time) }}" min="1" max="120"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                            class="w-5 h-5 rounded bg-slate-800 border-slate-600 text-amber-500 focus:ring-amber-500">
                        <div>
                            <span class="text-sm font-semibold text-slate-200">Article publié</span>
                            <p class="text-xs text-slate-500">Décocher pour repasser en brouillon</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-slate-800">
                <button type="submit" class="px-6 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                    Sauvegarder les modifications
                </button>
                <a href="{{ route('admin.articles.index') }}" class="px-6 py-3 rounded-full border border-slate-700 hover:border-slate-500 text-slate-300 text-sm transition">
                    Annuler
                </a>
            </div>
        </form>
    </main>
</div>
@endsection
