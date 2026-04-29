@extends('layouts.app')

@section('title', 'Articles - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    
    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- Hero Section --}}
    <section class="relative py-16 px-4 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-amber-500/10 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Tous nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-400">Articles</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Découvre les coulisses du football professionnel : mental, carrière, préparation physique et bien plus encore.
                </p>
            </div>

            {{-- Category Filters --}}
            @if($categories->isNotEmpty())
            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-2 rounded-full border {{ !$category ? 'bg-amber-500 border-amber-500 text-slate-950 font-bold' : 'border-slate-800 text-slate-400 hover:border-amber-500/50 hover:text-amber-400' }} text-sm transition">
                    Tous
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                       class="px-4 py-2 rounded-full border {{ $category === $cat ? 'bg-amber-500 border-amber-500 text-slate-950 font-bold' : 'border-slate-800 text-slate-400 hover:border-amber-500/50 hover:text-amber-400' }} text-sm transition">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
            @endif

            {{-- Articles Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="group block bg-slate-900/60 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-500/70 transition-all hover:shadow-2xl hover:shadow-amber-500/10 bff-reveal">
                        <div class="aspect-video overflow-hidden relative">
                            @if($article->cover_image)
                                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-slate-950/80 backdrop-blur-md border border-amber-500/30 text-amber-400 text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                    {{ $article->category }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                                <span>{{ $article->reading_time }} min de lecture</span>
                                <span>•</span>
                                <span>{{ $article->published_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-amber-400 transition leading-tight">{{ $article->title }}</h3>
                            <p class="text-sm text-slate-400 mb-5 line-clamp-2 leading-relaxed">{{ $article->excerpt }}</p>
                            <span class="text-xs text-amber-500 font-bold inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                                Lire l'article 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="text-5xl mb-4">🔍</div>
                        <h3 class="text-xl font-bold text-slate-300">Aucun article trouvé</h3>
                        <p class="text-slate-500 mt-2">Nous préparons de nouveaux contenus, reviens très bientôt !</p>
                        <a href="{{ route('articles.index') }}" class="inline-block mt-6 text-amber-500 hover:underline">Voir tous les articles</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="mt-16">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-slate-800 bg-slate-950 py-4 mt-20">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
            <p>© {{ date('Y') }} Brain Focus Football. Tous droits réservés.</p>
            <div class="flex gap-4">
                <a href="mailto:contact@brainfocusfootball.com" class="hover:text-amber-300">Contact</a>
                <a href="{{ route('home') }}#" class="hover:text-amber-300">Mentions légales</a>
                <a href="{{ route('home') }}#" class="hover:text-amber-300">Confidentialité</a>
            </div>
        </div>
    </footer>
</div>
@endsection
