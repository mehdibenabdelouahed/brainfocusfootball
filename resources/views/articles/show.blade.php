@extends('layouts.app')

@section('title', $article->title . ' — Brain Focus Football')

@section('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($article->excerpt ?? $article->content), 160) }}">
    <meta property="og:title" content="{{ $article->title }} | BFF">
    <meta property="og:description" content="{{ Str::limit(strip_tags($article->excerpt ?? $article->content), 160) }}">
    <meta property="og:image" content="{{ $article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $article->category }}">
@endsection

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    @include('partials.navbar')

    {{-- Hero Article --}}
    <div class="relative">
        @if($article->cover_image)
            <div class="absolute inset-0 h-72">
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover opacity-20">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-950/60 via-slate-950/80 to-slate-950"></div>
            </div>
        @else
            <div class="absolute inset-0 h-72 bg-gradient-to-br from-amber-500/10 via-slate-950 to-slate-950"></div>
        @endif

        <div class="relative max-w-3xl mx-auto px-4 pt-16 pb-10">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-amber-400 transition mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Tous les articles
            </a>

            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 bg-amber-500/20 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-wider rounded-full">
                    {{ $article->category }}
                </span>
                <span class="text-slate-500 text-xs">{{ $article->reading_time }} min de lecture</span>
                <span class="text-slate-600 text-xs">•</span>
                <span class="text-slate-500 text-xs">{{ $article->published_at->format('d M Y') }}</span>
            </div>

            <h1 class="text-3xl md:text-4xl font-black leading-tight mb-4">
                {{ $article->title }}
            </h1>

            @if($article->excerpt)
                <p class="text-slate-300 text-lg leading-relaxed">{{ $article->excerpt }}</p>
            @endif
        </div>
    </div>

    {{-- Contenu principal --}}
    <div class="max-w-3xl mx-auto px-4 pb-16">

        @if($article->cover_image)
            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}"
                 class="w-full rounded-2xl object-cover max-h-96 mb-10 border border-slate-800">
        @endif

        {{-- Corps de l'article --}}
        <div class="prose-bff">
            {!! $article->content !!}
        </div>

        {{-- CTA bas d'article --}}
        <div class="mt-16 bg-gradient-to-r from-amber-600/20 to-sky-600/10 border border-amber-500/30 rounded-2xl p-8 text-center">
            <h3 class="text-xl font-bold mb-2">Rejoins la communauté Brain Focus Football</h3>
            <p class="text-slate-300 text-sm mb-5">Crée ton profil joueur et accède à tous nos contenus exclusifs.</p>
            @auth
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                    Mon Tableau de Bord →
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-block px-6 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                    Créer mon profil gratuitement →
                </a>
            @endauth
        </div>

        {{-- Articles liés --}}
        @if($related->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-xl font-bold mb-6">Articles similaires</h2>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($related as $rel)
                        <a href="{{ route('articles.show', $rel->slug) }}" class="group bg-slate-900/60 border border-slate-800 hover:border-amber-500/40 rounded-xl overflow-hidden transition">
                            @if($rel->cover_image)
                                <img src="{{ asset('storage/' . $rel->cover_image) }}" alt="{{ $rel->title }}" class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 bg-slate-800 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <p class="text-xs text-amber-500 font-bold uppercase mb-1">{{ $rel->category }}</p>
                                <p class="text-sm font-semibold group-hover:text-amber-300 transition">{{ Str::limit($rel->title, 60) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Footer --}}
    <footer class="border-t border-slate-800 bg-slate-950 py-6">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>© {{ date('Y') }} Brain Focus Football.</p>
            <div class="flex gap-4">
                <a href="{{ route('contact') }}" class="hover:text-amber-300">Contact</a>
                <a href="{{ route('home') }}" class="hover:text-amber-300">Accueil</a>
            </div>
        </div>
    </footer>
</div>

@push('scripts')
<style>
.prose-bff h2 { font-size: 1.4rem; font-weight: 800; color: #fff; margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #1e293b; }
.prose-bff h3 { font-size: 1.1rem; font-weight: 700; color: #f59e0b; margin: 1.5rem 0 0.75rem; }
.prose-bff p { color: #cbd5e1; line-height: 1.9; margin-bottom: 1.25rem; font-size: 0.95rem; }
.prose-bff ul, .prose-bff ol { color: #cbd5e1; padding-left: 1.5rem; margin-bottom: 1.25rem; }
.prose-bff li { margin-bottom: 0.5rem; line-height: 1.7; font-size: 0.95rem; }
.prose-bff strong { color: #f1f5f9; font-weight: 700; }
.prose-bff em { color: #94a3b8; font-style: italic; }
</style>
@endpush
@endsection
