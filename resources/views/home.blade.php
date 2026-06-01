@extends('layouts.app')

@section('title', 'Brain Focus Football - Devenir pro commence dans la tête')

@section('content')
<div class="min-h-screen flex flex-col bg-slate-950 text-white" x-data="{ mode: 'joueur' }">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- TOGGLE SWITCH JOUEUR / RECRUTEUR                      --}}
    {{-- ═══════════════════════════════════════════════════════ --}}    <div class="sticky top-[73px] md:top-[89px] z-[999] py-4 -mb-[80px] pointer-events-none">
        <div class="max-w-6xl mx-auto px-4 flex justify-center">
            <div class="relative inline-flex items-center bg-slate-900 border border-slate-800 rounded-full p-1 shadow-2xl shadow-black/80 pointer-events-auto">
                {{-- Sliding indicator --}}
                <div
                    class="absolute top-1 bottom-1 rounded-full bg-gradient-to-r from-amber-500 to-amber-400 shadow-lg shadow-amber-500/40 transition-all duration-400 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                    :class="mode === 'joueur'
                        ? 'left-1 w-[calc(50%-2px)]'
                        : 'left-[calc(50%+1px)] w-[calc(50%-2px)]'"
                    style="transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);"
                ></div>

                {{-- Bouton Joueur --}}
                <button
                    @click="mode = 'joueur'"
                    class="relative z-10 px-6 sm:px-8 py-2.5 rounded-full text-sm font-bold tracking-wide transition-colors duration-300 flex items-center gap-2 select-none"
                    :class="mode === 'joueur' ? 'text-slate-950' : 'text-slate-400 hover:text-slate-200'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Joueur
                </button>

                {{-- Bouton Recruteur --}}
                <button
                    @click="mode = 'recruteur'"
                    class="relative z-10 px-6 sm:px-8 py-2.5 rounded-full text-sm font-bold tracking-wide transition-colors duration-300 flex items-center gap-2 select-none"
                    :class="mode === 'recruteur' ? 'text-slate-950' : 'text-slate-400 hover:text-slate-200'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Recruteur
                </button>
            </div>
        </div>
    </div>


    <main class="flex-1 min-h-screen bg-slate-950 text-white">

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- CONTENU JOUEUR                                        --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div x-show="mode === 'joueur'"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
        >
            {{-- HERO JOUEUR --}}
            <section class="relative bff-parallax-wrapper min-h-[85vh] flex items-center">
                {{-- Background Image with Blur --}}
                <div class="absolute inset-0 z-0">
                    <img src="/images/stade.jpg" alt="Background Stadium" class="w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-slate-950/80 to-slate-950"></div>
                </div>
                <div class="bff-parallax-layer"></div>

                <div class="relative max-w-4xl mx-auto px-4 py-20 flex flex-col items-center text-center bff-reveal">
                    {{-- Colonne texte centrée --}}
                    <div class="bff-animate-fade-in-up flex flex-col items-center">
                    
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-none mb-6 drop-shadow-2xl">
                            Devenir pro commence <span class="bff-title-highlight">dans la tête</span>.
                        </h1>
                        <p class="text-base sm:text-lg text-slate-200 drop-shadow-lg mb-8 max-w-2xl leading-relaxed mx-auto">
                            Brain Focus Football t'explique les coulisses du football professionnel :
                            mental, carrière, agents, réseaux sociaux, hygiène de vie…  
                            Et te permet de créer un profil joueur pour te montrer comme un pro.
                        </p>

                        <div class="flex flex-wrap justify-center items-center gap-4 mb-10">
                            @auth
                                <a href="{{ route('profile.edit') }}"
                                   class="inline-flex items-center justify-center px-6 py-3.5 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-black text-slate-950 shadow-lg shadow-amber-500/30 transition bff-btn-main bff-btn-pulse">
                                    Voir mon profil joueur
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                   class="inline-flex items-center justify-center px-6 py-3.5 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-black text-slate-950 shadow-lg shadow-amber-500/30 transition bff-btn-main bff-btn-pulse">
                                    Créer mon profil joueur
                                </a>
                            @endauth
                            <a href="{{ route('articles.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3.5 rounded-full border border-slate-600 hover:border-amber-400 text-sm font-semibold text-slate-200 hover:text-amber-300 transition">
                                Découvrir les articles
                            </a>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-10 text-xs text-slate-300 bg-slate-950/60 backdrop-blur-sm border border-slate-800/80 rounded-2xl px-6 py-4">
                            <div class="text-center sm:text-left">
                                <span class="block font-bold text-white text-sm mb-0.5">Pour joueurs 12–23 ans</span>
                                <span class="text-slate-400">Axé mental, carrière & entourage</span>
                            </div>
                            <div class="hidden sm:block h-8 w-px bg-slate-800"></div>
                            <div class="text-center sm:text-left">
                                <span class="block font-bold text-white text-sm mb-0.5">Un projet pensé par un joueur</span>
                                <span class="text-slate-400">Pas de discours magique, que du concret</span>
                            </div>
                        </div>
                    </div>

                    {{-- Scroll Indicator --}}
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 text-slate-500 animate-bounce cursor-pointer opacity-40 hover:opacity-100 transition-opacity hidden lg:flex" onclick="document.getElementById('joueur-features').scrollIntoView({behavior: 'smooth'})">
                        <span class="text-[9px] uppercase tracking-[0.2em] font-bold">Découvrir</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                        </svg>
                    </div>
                    </div>
            </section>

            {{-- COMMENT ÇA MARCHE JOUEUR --}}
            <section id="joueur-features" class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
                <h2 class="text-2xl sm:text-3xl font-bold mb-3">Comment Brain Focus Football t'aide ?</h2>
                <p class="text-sm text-slate-300 mb-8 max-w-2xl">
                    L'objectif n'est pas de te vendre du rêve, mais de te donner les codes du monde pro
                    et un espace pour te présenter sérieusement.
                </p>

                <div class="grid md:grid-cols-3 gap-5 text-sm bff-reveal-stagger">
                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                        <p class="text-xs uppercase text-amber-400 mb-1">Étape 1</p>
                        <h3 class="font-semibold mb-1">Comprendre le système</h3>
                        <p class="text-slate-300 text-xs">
                            Articles sur le mental, les agents, les essais, les réseaux sociaux,
                            les blessures, l'entourage… Tu comprends les règles du jeu.
                        </p>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                        <p class="text-xs uppercase text-amber-400 mb-1">Étape 2</p>
                        <h3 class="font-semibold mb-1">Structurer ta carrière</h3>
                        <p class="text-slate-300 text-xs">
                            Tu clarifies tes objectifs : où tu veux aller, en combien de temps,
                            quelles habitudes tu dois mettre en place au quotidien.
                        </p>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                        <p class="text-xs uppercase text-amber-400 mb-1">Étape 3</p>
                        <h3 class="font-semibold mb-1">Créer ta vitrine</h3>
                        <p class="text-slate-300 text-xs">
                            Tu crées un profil joueur propre, avec vidéos, stats et description.
                        </p>
                    </div>
                </div>
            </section>

            {{-- COMPTEURS DE STATS --}}
            <section class="bg-slate-900/40 border-y border-slate-800/50 py-12 bff-reveal">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        <div>
                            <div class="text-3xl lg:text-4xl font-black text-amber-500 mb-1 bff-counter" data-target="850">0</div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-medium">Joueurs Inscrits</div>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-black text-amber-500 mb-1 bff-counter" data-target="42">0</div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-medium">Articles Pro</div>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-black text-amber-500 mb-1 bff-counter" data-target="15">0</div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-medium">Centres Partenaires</div>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-black text-amber-500 mb-1 bff-counter" data-target="100" data-suffix="%">0</div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-medium">Focus Mental</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ARTICLES / CATÉGORIES --}}
            <section id="articles" class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
                <h2 class="text-2xl sm:text-3xl font-bold mb-3">Comprendre le monde du football pro</h2>
                <p class="text-sm text-slate-300 mb-8 max-w-2xl">
                    Avant de parler de contrats et de gros clubs, il faut comprendre ce que les pros vivent vraiment :
                    pression, choix de carrière, sacrifices, entourage…  
                    On t'explique tout, sans filtre.
                </p>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 text-sm bff-reveal-stagger">
                    <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-amber-400/70 transition">
                        <p class="text-[11px] uppercase tracking-wide text-amber-400 mb-1">Mental</p>
                        <h3 class="font-semibold mb-1 text-sm">Confiance & pression</h3>
                        <p class="text-slate-300 text-xs mb-3">
                            Gestion du stress, concurrence, banc, critiques, réseaux sociaux…
                        </p>
                        <a href="{{ route('articles.index') }}" class="text-[11px] text-amber-300 hover:text-amber-200">Lire les articles →</a>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-amber-400/70 transition">
                        <p class="text-[11px] uppercase tracking-wide text-amber-400 mb-1">Carrière</p>
                        <h3 class="font-semibold mb-1 text-sm">Agents, essais & contrats</h3>
                        <p class="text-slate-300 text-xs mb-3">
                            Comment approcher un agent, se préparer à un essai et éviter les pièges.
                        </p>
                        <a href="{{ route('articles.index') }}" class="text-[11px] text-amber-300 hover:text-amber-200">Découvrir →</a>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-amber-400/70 transition">
                        <p class="text-[11px] uppercase tracking-wide text-amber-400 mb-1">Hygiène de vie</p>
                        <h3 class="font-semibold mb-1 text-sm">Sommeil, nutrition, récup</h3>
                        <p class="text-slate-300 text-xs mb-3">
                            Ce que les pros font au quotidien pour rester au top physiquement.
                        </p>
                        <a href="{{ route('articles.nutrition') }}" class="text-[11px] text-amber-300 hover:text-amber-200">Voir plus →</a>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-amber-400/70 transition">
                        <p class="text-[11px] uppercase tracking-wide text-amber-400 mb-1">Environnement</p>
                        <h3 class="font-semibold mb-1 text-sm">Famille, école, distractions</h3>
                        <p class="text-slate-300 text-xs mb-3">
                            Gérer les sorties, TikTok, les amis, l'école… sans perdre ton objectif de vue.
                        </p>
                        <a href="{{ route('articles.index') }}" class="text-[11px] text-amber-300 hover:text-amber-200">Explorer →</a>
                    </div>
                </div>
            </section>

            {{-- BANDEAU DÉFILANT TALENTS --}}
            <section class="py-6 bg-slate-950/80 border-y border-slate-900/50 overflow-hidden bff-reveal">
                <div class="max-w-6xl mx-auto px-4 mb-3 flex items-center gap-3 opacity-60">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <h2 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Talents à la une</h2>
                </div>
                
                <div class="relative flex overflow-hidden group">
                    <div class="flex animate-marquee whitespace-nowrap gap-12 items-center py-2">
                        @forelse ($players->concat($players) as $player)
                            <a href="{{ route('profile.show', $player->id) }}" class="flex items-center gap-4 group/item cursor-pointer">
                                <div class="relative w-12 h-12 rounded-full overflow-hidden border border-slate-800 transition-all duration-500 group-hover/item:border-amber-500/50">
                                    @if($player->profile_photo)
                                        <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $player->name }}" class="w-full h-full object-cover blur-[1px] grayscale opacity-70 group-hover/item:blur-0 group-hover/item:grayscale-0 group-hover/item:opacity-100 transition-all duration-700">
                                    @else
                                        <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-amber-500/10 group-hover/item:bg-transparent transition-colors"></div>
                                </div>
                                <div class="text-[11px]">
                                    <p class="font-bold text-slate-300 group-hover/item:text-amber-400 transition-colors">{{ $player->first_name }} {{ substr($player->last_name, 0, 1) }}.</p>
                                    <p class="text-[9px] text-slate-500 uppercase">{{ $player->position ?? 'Joueur' }}</p>
                                </div>
                            </a>
                        @empty
                            @for($i=0; $i<6; $i++)
                                <div class="flex items-center gap-4 opacity-30">
                                    <div class="w-12 h-12 rounded-full bg-slate-800"></div>
                                    <div class="text-[11px]">
                                        <p class="font-bold text-slate-600">Talent BFF</p>
                                        <p class="text-[9px] text-slate-700">À venir...</p>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                    
                    {{-- Overlays de dégradé --}}
                    <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-slate-950 to-transparent z-10"></div>
                    <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-slate-950 to-transparent z-10"></div>
                </div>
            </section>

            {{-- SECTION PROFIL JOUEUR --}}
            <section id="profil-joueur" class="bg-slate-900/70 border-y border-slate-800 bff-reveal">
                <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14 flex flex-col lg:flex-row gap-10 items-center">
                    <div class="flex-1">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ton profil joueur, pensé pour les recruteurs.</h2>
                        <p class="text-sm text-slate-300 mb-5 max-w-xl">
                            Fini les vidéos perdues sur WhatsApp. Tu as une page propre, avec tes infos, tes vidéos,
                            tes stats et tes objectifs.  
                            Quand un coach te demande "tu as quelque chose à m'envoyer ?", tu as un lien prêt.
                        </p>

                        <ul class="space-y-3 text-sm text-slate-200">
                            <li class="flex gap-2">
                                <span class="mt-1 w-2 h-2 rounded-full bg-amber-400"></span>
                                <span><strong>Infos claires :</strong> poste, club, âge, taille, pied fort, niveau.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-1 w-2 h-2 rounded-full bg-amber-400"></span>
                                <span><strong>Vidéos :</strong> best-of, matchs complets, entraînements.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-1 w-2 h-2 rounded-full bg-amber-400"></span>
                                <span><strong>Objectifs :</strong> ce que tu vises et comment tu comptes y arriver.</span>
                            </li>
                        </ul>

                        <div class="mt-6 flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('profile.edit') }}"
                                   class="px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/30 transition bff-btn-main">
                                    Éditer mon profil
                                </a>
                                <a href="{{ route('profile.show', Auth::id()) }}"
                                   class="px-5 py-3 rounded-full border border-slate-600 hover:border-amber-400 text-sm font-semibold text-slate-200 hover:text-amber-300 transition">
                                    Voir mon profil public
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                   class="px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/30 transition bff-btn-main">
                                    Créer mon profil maintenant
                                </a>
                                <a href="{{ route('login') }}"
                                   class="px-5 py-3 rounded-full border border-slate-600 hover:border-amber-400 text-sm font-semibold text-slate-200 hover:text-amber-300 transition">
                                    J'ai déjà un compte
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="flex-1 w-full">
                        <div class="bg-slate-950/90 border border-slate-800 rounded-2xl p-4 text-[11px]">
                            <p class="text-slate-400 text-[10px] mb-2">Aperçu d'un profil type</p>
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                     <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-700">
                                         <img
                                            src="/images/bulle.jpg"
                                            alt="Photo de Mehdi"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm">Mehdi</p>
                                        <p class="text-slate-400 text-[11px]">Meneur de jeu • U19 Élite</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2 mt-3">
                                    <div class="bg-slate-900 rounded-lg p-2">
                                        <p class="text-slate-400 text-[10px]">Club</p>
                                        <p class="font-semibold">RSC Anderlecht</p>
                                    </div>
                                    <div class="bg-slate-900 rounded-lg p-2">
                                        <p class="text-slate-400 text-[10px]">Postee</p>
                                        <p class="font-semibold">10 / 8 offensif</p>
                                    </div>
                                    <div class="bg-slate-900 rounded-lg p-2">
                                        <p class="text-slate-400 text-[10px]">Matches (2024/25)</p>
                                        <p class="font-semibold">24</p>
                                    </div>
                                    <div class="bg-slate-900 rounded-lg p-2">
                                        <p class="text-slate-400 text-[10px]">Buts / Passes</p>
                                        <p class="font-semibold">9 / 11</p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <p class="text-slate-400 text-[10px] mb-1">Vidéo principale</p>
                                    <div class="aspect-video rounded-xl overflow-hidden relative">
                                            <video
                                                src="/videos/ilian.mp4"
                                                autoplay
                                                muted
                                                loop
                                                playsinline
                                                class="absolute inset-0 w-full h-full object-cover bg-gradient-to-tr from-slate-950/30 to-transparent">
                                            </video>
                                        </div>
                                </div>

                                <div class="mt-3">
                                    <p class="text-slate-400 text-[10px] mb-1">Description</p>
                                    <p class="text-slate-300 text-[11px]">
                                        Meneur de jeu créatif, gros volume de course, spécialité passes entre les lignes.
                                        Habitué à la pression des gros matchs.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- TÉMOIGNAGES --}}
            <section class="max-w-6xl mx-auto px-4 py-16 lg:py-20 bff-reveal">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ils ont franchi un palier avec nous</h2>
                    <div class="w-16 h-1 bg-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8 bff-reveal-stagger">
                    {{-- Témoignage 1 --}}
                    <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative">
                        <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">"</div>
                        <p class="text-slate-300 italic mb-6 text-sm leading-relaxed">
                            "Brain Focus Football m'a aidé à comprendre que mon talent ne suffisait pas. J'ai revu mon hygiène de vie et ma préparation mentale, et j'ai enfin signé en centre de formation."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-amber-500/30"></div>
                            <div>
                                <p class="font-bold text-sm">Lucas M.</p>
                                <p class="text-[10px] text-amber-400 uppercase tracking-tighter">U17 National</p>
                            </div>
                        </div>
                    </div>

                    {{-- Témoignage 2 --}}
                    <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative">
                        <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">"</div>
                        <p class="text-slate-300 italic mb-6 text-sm leading-relaxed">
                            "La page profil est un vrai plus. J'ai pu envoyer mon lien à plusieurs agents, c'est bien plus pro qu'une simple vidéo YouTube. Ça montre qu'on est sérieux sur son projet."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-amber-500/30"></div>
                            <div>
                                <p class="font-bold text-sm">Thomas D.</p>
                                <p class="text-[10px] text-amber-400 uppercase tracking-tighter">Joueur Senior R1</p>
                            </div>
                        </div>
                    </div>

                    {{-- Témoignage 3 --}}
                    <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative">
                        <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">"</div>
                        <p class="text-slate-300 italic mb-6 text-sm leading-relaxed">
                            "Les articles sur les agents et l'entourage m'ont ouvert les yeux sur les coulisses. On ne nous dit pas tout en club, ici on a enfin la vérité sur le monde pro."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-amber-500/30"></div>
                            <div>
                                <p class="font-bold text-sm">Sofiane B.</p>
                                <p class="text-[10px] text-amber-400 uppercase tracking-tighter">Entourage Joueur</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- NEWSLETTER CTA --}}
            @include('partials.newsletter-cta')

            {{-- FAQ --}}
            <section id="faq" class="max-w-4xl mx-auto px-4 py-16 lg:py-20 bff-reveal">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Questions fréquentes</h2>
                    <p class="text-sm text-slate-400">Tout ce que tu dois savoir sur Brain Focus Football.</p>
                </div>

                <div class="space-y-4" x-data="{ active: null }">
                    {{-- Question 1 --}}
                    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-500/30">
                        <button 
                            @click="active !== 1 ? active = 1 : active = null" 
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-sm sm:text-base pr-4">Est-ce que Brain Focus Football remplace un agent ?</span>
                            <svg 
                                class="w-5 h-5 text-amber-500 transition-transform duration-300" 
                                :class="active === 1 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="active === 1" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5 pt-0 text-xs sm:text-sm text-slate-400 leading-relaxed border-t border-slate-800/50 bg-slate-900/20"
                        >
                            Non, nous ne sommes pas des agents. Nous sommes une plateforme d'accompagnement mental et de visibilité. Notre but est de te donner les outils pour que tu puisses gérer ta carrière toi-même ou avec ton entourage de manière pro, que tu aies déjà un agent ou non.
                        </div>
                    </div>

                    {{-- Question 2 --}}
                    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-500/30">
                        <button 
                            @click="active !== 2 ? active = 2 : active = null" 
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-sm sm:text-base pr-4">À quel âge peut-on s'inscrire sur la plateforme ?</span>
                            <svg 
                                class="w-5 h-5 text-amber-500 transition-transform duration-300" 
                                :class="active === 2 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="active === 2" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5 pt-0 text-xs sm:text-sm text-slate-400 leading-relaxed border-t border-slate-800/50 bg-slate-900/20"
                        >
                            La plateforme est optimisée pour les joueurs entre 12 et 23 ans. C'est la période charnière où le mental et la compréhension de l'écosystème font la plus grosse différence entre un joueur amateur et un futur pro.
                        </div>
                    </div>

                    {{-- Question 3 --}}
                    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-500/30">
                        <button 
                            @click="active !== 3 ? active = 3 : active = null" 
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-sm sm:text-base pr-4">Combien coûte la création d'un profil joueur ?</span>
                            <svg 
                                class="w-5 h-5 text-amber-500 transition-transform duration-300" 
                                :class="active === 3 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="active === 3" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5 pt-0 text-xs sm:text-sm text-slate-400 leading-relaxed border-t border-slate-800/50 bg-slate-900/20"
                        >
                            La création de ton profil joueur de base est entièrement gratuite. Nous voulons que chaque talent ait sa chance de se montrer. Des outils de coaching avancés et du contenu exclusif peuvent être proposés par la suite pour ceux qui veulent aller plus loin.
                        </div>
                    </div>

                    {{-- Question 4 --}}
                    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-500/30">
                        <button 
                            @click="active !== 4 ? active = 4 : active = null" 
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-sm sm:text-base pr-4">Mon profil sera-t-il vraiment visible par des recruteurs ?</span>
                            <svg 
                                class="w-5 h-5 text-amber-500 transition-transform duration-300" 
                                :class="active === 4 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="active === 4" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5 pt-0 text-xs sm:text-sm text-slate-400 leading-relaxed border-t border-slate-800/50 bg-slate-900/20"
                        >
                            Oui, nous travaillons à développer un réseau de partenaires qui consultent la base de données. Mais surtout, ton profil est conçu pour être ta "carte de visite digitale" : tu peux envoyer ton lien personnalisé directement aux clubs ou agents que tu sollicites.
                        </div>
                    </div>

                    {{-- Question 5 --}}
                    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-500/30">
                        <button 
                            @click="active !== 5 ? active = 5 : active = null" 
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-sm sm:text-base pr-4">Je suis un parent, quel est mon rôle ici ?</span>
                            <svg 
                                class="w-5 h-5 text-amber-500 transition-transform duration-300" 
                                :class="active === 5 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="active === 5" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5 pt-0 text-xs sm:text-sm text-slate-400 leading-relaxed border-t border-slate-800/50 bg-slate-900/20"
                        >
                            Votre rôle est crucial. Nous avons des contenus dédiés à l'entourage pour vous aider à accompagner votre enfant dans les moments de doute, de pression ou face aux choix de carrière, afin d'être un pilier solide sans devenir une source de stress supplémentaire.
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA FINAL JOUEUR --}}
            <section class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
                <div class="bg-gradient-to-r from-amber-600/20 via-amber-500/10 to-sky-500/10 border border-amber-500/30 rounded-3xl p-6 lg:p-8 flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold mb-2">
                            Prendre ta carrière au sérieux, ça commence maintenant.
                        </h2>
                        <p class="text-sm text-slate-200 max-w-xl">
                            Tu peux continuer à espérer que quelqu'un te découvre par hasard,  
                            ou tu peux commencer à te présenter comme un joueur pro dès aujourd'hui.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('profile.edit') }}"
                               class="px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/40 transition bff-btn-main bff-btn-pulse">
                                Éditer mon profil
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/40 transition bff-btn-main bff-btn-pulse">
                                Je crée mon profil maintenant
                            </a>
                        @endauth
                        <a href="{{ route('contact') }}"
                           class="px-5 py-3 rounded-full border border-slate-200/40 hover:border-amber-300 text-sm font-semibold text-slate-100 hover:text-amber-200 transition">
                            Nous contacter
                        </a>
                    </div>
                </div>
            </section>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- CONTENU RECRUTEUR                                     --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div x-show="mode === 'recruteur'"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
        >
            {{-- HERO RECRUTEUR --}}
            <section class="relative bff-parallax-wrapper">
                <div class="absolute inset-0 z-0">
                    <img src="/images/stade.jpg" alt="Background Stadium" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-950/80 via-sky-950/70 to-slate-900/90"></div>
                </div>
                <div class="bff-parallax-layer" style="opacity: 0.3;"></div>

                <div class="relative max-w-6xl mx-auto px-4 py-16 lg:py-24">
                    <div class="max-w-3xl bff-animate-fade-in-up">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-500/10 border border-sky-500/30 text-sky-400 text-xs font-semibold mb-6">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Espace Recruteur & Scout
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5 drop-shadow-xl">
                            Accédez aux <span class="bff-title-highlight-sky">talents de demain</span>,<br> avant tout le monde.
                        </h1>
                        <p class="text-base sm:text-lg text-slate-300 mb-8 max-w-2xl leading-relaxed">
                            Brain Focus Football centralise des profils joueurs structurés : vidéos, stats, parcours, et mentalité. 
                            Fini les PDF douteux et les vidéos WhatsApp. Ici, chaque joueur a une page pro.
                        </p>

                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('talents') }}"
                               class="inline-flex items-center justify-center px-6 py-3.5 rounded-full bg-sky-500 hover:bg-sky-400 text-sm font-bold text-slate-950 shadow-lg shadow-sky-500/30 transition bff-btn-main">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Voir les profils joueurs
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center px-6 py-3.5 rounded-full border border-slate-500 hover:border-sky-400 text-sm font-semibold text-slate-200 hover:text-sky-300 transition">
                                Nous contacter
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CE QUE VOUS TROUVEZ SUR BFF --}}
            <section class="max-w-6xl mx-auto px-4 py-12 lg:py-16 bff-reveal">
                <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ce que vous trouvez sur chaque profil</h2>
                <p class="text-sm text-slate-300 mb-10 max-w-2xl">
                    Chaque joueur inscrit construit sa vitrine digitale. Vous accédez à des informations claires, structurées et vérifiables.
                </p>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 text-sm bff-reveal-stagger">
                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 hover:border-sky-500/40 transition group">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center mb-4 group-hover:bg-sky-500/20 transition">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold mb-2">Fiche joueur complète</h3>
                        <p class="text-slate-400 text-xs">
                            Poste, club, âge, taille, pied fort, nationalité, niveau actuel, parcours sportif.
                        </p>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 hover:border-sky-500/40 transition group">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center mb-4 group-hover:bg-sky-500/20 transition">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold mb-2">Vidéos de qualité</h3>
                        <p class="text-slate-400 text-xs">
                            Best-of, matchs complets, entraînements. Tout est accessible en un clic, sans passer par YouTube.
                        </p>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 hover:border-sky-500/40 transition group">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center mb-4 group-hover:bg-sky-500/20 transition">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold mb-2">Stats & performances</h3>
                        <p class="text-slate-400 text-xs">
                            Buts, passes décisives, matchs joués, radar de compétences. Des données concrètes, pas du blabla.
                        </p>
                    </div>

                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 hover:border-sky-500/40 transition group">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center mb-4 group-hover:bg-sky-500/20 transition">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold mb-2">Mentalité & objectifs</h3>
                        <p class="text-slate-400 text-xs">
                            Chaque joueur affiche ses objectifs, sa vision de carrière et son engagement. Vous savez à qui vous avez affaire.
                        </p>
                    </div>
                </div>
            </section>

            {{-- POURQUOI BFF POUR LES RECRUTEURS --}}
            <section class="bg-slate-900/50 border-y border-slate-800/50 bff-reveal">
                <div class="max-w-6xl mx-auto px-4 py-12 lg:py-16 flex flex-col lg:flex-row gap-10 items-center">
                    <div class="flex-1">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-4">Pourquoi utiliser Brain Focus Football ?</h2>
                        <p class="text-sm text-slate-300 mb-6 max-w-xl">
                            Nous ne sommes pas une agence. Nous sommes un outil qui structure la visibilité des jeunes talents. 
                            En tant que recruteur ou scout, vous gagnez du temps et accédez à des profils sérieux.
                        </p>

                        <div class="space-y-4">
                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1">Profils standardisés</h3>
                                    <p class="text-slate-400 text-xs">Toutes les infos au même endroit, dans le même format. Pas besoin de chercher.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1">Des joueurs sérieux</h3>
                                    <p class="text-slate-400 text-xs">Si un joueur prend le temps de construire son profil ici, c'est qu'il est engagé dans son projet sportif.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1">Accès direct et gratuit</h3>
                                    <p class="text-slate-400 text-xs">Consultez les profils librement. Contactez les joueurs directement si un talent vous intéresse.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1">Filtrer par critères</h3>
                                    <p class="text-slate-400 text-xs">Poste, âge, localisation, niveau… Trouvez le profil qui correspond à ce que vous cherchez.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Aperçu grille de profils --}}
                    <div class="flex-1 w-full">
                        <div class="bg-slate-950/90 border border-slate-800 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Base de talents</p>
                                <span class="text-[10px] text-sky-400 font-semibold">{{ $players->count() }}+ profils</span>
                            </div>
                            
                            <div class="space-y-3">
                                @foreach($players->take(4) as $player)
                                    <a href="{{ route('profile.show', $player->id) }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/60 border border-slate-800/50 hover:border-sky-500/30 transition group">
                                        <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-700 flex-shrink-0">
                                            @if($player->profile_photo)
                                                <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $player->first_name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-slate-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-xs group-hover:text-sky-400 transition">{{ $player->first_name }} {{ substr($player->last_name, 0, 1) }}.</p>
                                            <p class="text-[10px] text-slate-500">{{ $player->position ?? 'Joueur' }} {{ $player->club ? '• ' . $player->club : '' }}</p>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-600 group-hover:text-sky-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endforeach

                                @if($players->count() === 0)
                                    @for($i=0; $i<3; $i++)
                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/60 border border-slate-800/50 opacity-40">
                                            <div class="w-10 h-10 rounded-full bg-slate-800 flex-shrink-0"></div>
                                            <div class="flex-1">
                                                <div class="h-3 bg-slate-800 rounded w-24 mb-1"></div>
                                                <div class="h-2 bg-slate-800/60 rounded w-16"></div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                            <a href="{{ route('talents') }}" class="mt-4 flex items-center justify-center gap-2 text-xs font-semibold text-sky-400 hover:text-sky-300 transition py-2">
                                Voir tous les profils
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- COMMENT ÇA MARCHE RECRUTEUR --}}
            <section class="max-w-6xl mx-auto px-4 py-12 lg:py-16 bff-reveal">
                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Comment ça marche ?</h2>
                    <p class="text-sm text-slate-400">3 étapes simples pour trouver votre prochain talent.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 bff-reveal-stagger">
                    <div class="text-center">
                        <div class="w-14 h-14 rounded-2xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-black text-sky-400">1</span>
                        </div>
                        <h3 class="font-bold mb-2">Parcourez les profils</h3>
                        <p class="text-slate-400 text-xs max-w-xs mx-auto">
                            Naviguez dans la base de talents. Filtrez par poste, âge, localisation ou niveau.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-14 h-14 rounded-2xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-black text-sky-400">2</span>
                        </div>
                        <h3 class="font-bold mb-2">Analysez en détail</h3>
                        <p class="text-slate-400 text-xs max-w-xs mx-auto">
                            Consultez la fiche complète : vidéos, stats, radar de compétences, objectifs du joueur.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-14 h-14 rounded-2xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-black text-sky-400">3</span>
                        </div>
                        <h3 class="font-bold mb-2">Contactez le joueur</h3>
                        <p class="text-slate-400 text-xs max-w-xs mx-auto">
                            Un talent vous intéresse ? Contactez-le directement via la plateforme ou ses coordonnées.
                        </p>
                    </div>
                </div>
            </section>

            {{-- TARIFS RECRUTEUR --}}
            <section class="bg-slate-900/30 border-y border-slate-800/50 py-14 lg:py-20 bff-reveal">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="text-center mb-12">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-3">Nos offres pour les recruteurs</h2>
                        <p class="text-sm text-slate-400 max-w-xl mx-auto">
                            Choisissez la formule adaptée à vos besoins. Commencez gratuitement, évoluez quand vous le souhaitez.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto items-start">

                        {{-- GRATUIT --}}
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col hover:border-slate-700 transition">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-slate-300 mb-2">Gratuit</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-black text-white">0€</span>
                                    <span class="text-slate-500 text-sm">/ mois</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-2">Idéal pour découvrir la plateforme.</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Recherche basique</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Consultation 5 profils/mois</span>
                                </div>
                                <div class="flex items-start gap-3 opacity-50">
                                    <svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    <span class="text-sm text-slate-500 line-through">Contact direct</span>
                                </div>
                                <div class="flex items-start gap-3 opacity-50">
                                    <svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    <span class="text-sm text-slate-500 line-through">Recherche avancée (Radar)</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'GRATUIT']) }}" class="w-full py-3 text-center rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 font-bold transition">Choisir ce plan</a>
                        </div>

                        {{-- STANDARD --}}
                        <div class="bg-slate-900 border border-slate-700 hover:border-sky-500/50 rounded-2xl p-6 flex flex-col transition relative group">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-sky-300 mb-2">Standard</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-black text-white">29€</span>
                                    <span class="text-slate-500 text-sm">/ mois</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-2">Pour les agents indépendants.</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Recherche avancée (Radar)</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Consultation 50 profils/mois</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">10 demandes contact/mois</span>
                                </div>
                                <div class="flex items-start gap-3 opacity-50">
                                    <svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    <span class="text-sm text-slate-500 line-through">Alertes Favoris</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'STANDARD']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white group-hover:bg-sky-600 font-bold transition">Choisir Standard</a>
                        </div>

                        {{-- PRO --}}
                        <div class="bg-gradient-to-b from-sky-900/40 to-slate-900 border-2 border-sky-500 rounded-2xl p-6 flex flex-col relative lg:scale-105 z-10 shadow-2xl shadow-sky-900/20">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-sky-500 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                                Le plus populaire
                            </div>
                            <div class="mb-6">
                                <h3 class="text-xl font-black text-sky-400 mb-2">PRO</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-black text-white">79€</span>
                                    <span class="text-sky-500/50 text-sm">/ mois</span>
                                </div>
                                <p class="text-xs text-sky-200 mt-2">Le standard des clubs professionnels.</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-white">Profils & Contacts illimités</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-white">Accès Stats physiques (si accord)</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-white">Shortlists & Favoris</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm font-semibold text-white">Export CSV/PDF</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'PRO']) }}" class="w-full py-3 text-center rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-black transition">Passer PRO</a>
                        </div>

                        {{-- ACADÉMIE --}}
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col hover:border-indigo-500 transition relative">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-indigo-400 mb-2">Académie</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-black text-white">199€</span>
                                    <span class="text-slate-500 text-sm">/ mois</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-2">Pour les staffs techniques complets.</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Fonctionnalités PRO incluses</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Multi-utilisateurs (5 scouts)</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Dashboard Équipe</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-sm text-slate-300">Support Prioritaire & API</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'ACADEMIE']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white hover:bg-indigo-600 font-bold transition">Contacter les Ventes</a>
                        </div>

                    </div>
                </div>
            </section>

            {{-- CTA FINAL RECRUTEUR --}}
            <section class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
                <div class="bg-gradient-to-r from-sky-600/20 via-sky-500/10 to-slate-500/10 border border-sky-500/30 rounded-3xl p-6 lg:p-8 flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold mb-2">
                            Le prochain talent est peut-être déjà sur BFF.
                        </h2>
                        <p class="text-sm text-slate-300 max-w-xl">
                            Accédez à des profils joueurs structurés, avec vidéos et stats. 
                            Gagnez du temps dans votre scouting.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('talents') }}"
                           class="px-5 py-3 rounded-full bg-sky-500 hover:bg-sky-400 text-sm font-semibold text-slate-950 shadow-lg shadow-sky-500/40 transition bff-btn-main">
                            Explorer les profils
                        </a>
                        <a href="{{ route('contact') }}"
                           class="px-5 py-3 rounded-full border border-slate-200/40 hover:border-sky-300 text-sm font-semibold text-slate-100 hover:text-sky-200 transition">
                            Devenir partenaire
                        </a>
                    </div>
                </div>
            </section>
        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="border-t border-slate-800 bg-slate-950 py-4">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
            <p>© {{ date('Y') }} Brain Focus Football. Tous droits réservés.</p>
            <div class="flex gap-4">
                <a href="{{ route('contact') }}" class="hover:text-amber-300">Contact</a>
                <a href="{{ route('home') }}#" class="hover:text-amber-300">Mentions légales</a>
                <a href="{{ route('home') }}#" class="hover:text-amber-300">Confidentialité</a>
            </div>
        </div>
    </footer>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- ANIMATION DES COMPTEURS ---
        const counters = document.querySelectorAll('.bff-counter');
        const speed = 200;

        const animateCounters = () => {
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText.replace('%', '');
                    const suffix = counter.getAttribute('data-suffix') || '';
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc) + suffix;
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };
                updateCount();
            });
        };

        // Lancer l'animation quand la section devient visible
        const counterEl = document.querySelector('.bff-counter');
        if (counterEl) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = counterEl.parentElement.parentElement.parentElement.parentElement;
            observer.observe(statsSection);
        }
    });
</script>
@endpush
