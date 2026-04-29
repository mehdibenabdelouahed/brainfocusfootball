@extends('layouts.app')

@section('title', 'Brain Focus Football - Devenir pro commence dans la tête')

@section('content')
<div class="min-h-screen flex flex-col bg-slate-950 text-white">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <main class="flex-1 min-h-screen bg-slate-950 text-white">
        {{-- HERO avec parallax + reveal + tilt --}}
        <section class="relative bff-parallax-wrapper">
            {{-- Background Image with Blur --}}
            <div class="absolute inset-0 z-0">
                <img src="/images/stade.jpg" alt="Background Stadium" class="w-full h-full object-cover opacity-80">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900/60 via-slate-950/70 to-amber-900/60"></div>
            </div>
            
            {{-- Old gradient (removed/merged above) --}}
            {{-- <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-amber-900 opacity-90"></div> --}}
            <div class="bff-parallax-layer"></div>

            <div class="relative max-w-6xl mx-auto px-4 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-10 bff-reveal">
                {{-- Colonne texte --}}
                <div class="flex-1 bff-animate-fade-in-up">
                
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-4 drop-shadow-xl">
                        Devenir pro commence <span class="bff-title-highlight">dans la tête</span>.
                    </h1>
                    <p class="text-sm sm:text-base text-white drop-shadow-lg mb-6 max-w-xl">
                        Brain Focus Football t’explique les coulisses du football professionnel :
                        mental, carrière, agents, réseaux sociaux, hygiène de vie…  
                        Et te permet de créer un profil joueur pour te montrer comme un pro.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        @auth
                            <a href="{{ route('profile.edit') }}"
                               class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold shadow-lg shadow-amber-500/30 transition bff-btn-main bff-btn-pulse">
                                Voir mon profil joueur
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-sm font-semibold shadow-lg shadow-amber-500/30 transition bff-btn-main bff-btn-pulse">
                                Créer mon profil joueur
                            </a>
                        @endauth
                        <a href="{{ route('articles.index') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-full border border-slate-600 hover:border-amber-400 text-sm font-semibold text-slate-200 hover:text-amber-300 transition">
                            Découvrir les articles
                        </a>
                    </div>

                    <div class="flex items-center gap-6 text-[11px] text-slate-100">
                        <div>
                            <span class="block font-semibold text-white text-xs">Pour joueurs 12–23 ans</span>
                            <span>Axé mental, carrière & entourage</span>
                        </div>
                        <div class="h-8 w-px bg-slate-700"></div>
                        <div>
                            <span class="block font-semibold text-white text-xs">Un projet pensé par un joueur</span>
                            <span>Pas de discours magique, que du concret</span>
                        </div>
                    </div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-slate-500 animate-bounce cursor-pointer opacity-40 hover:opacity-100 transition-opacity hidden lg:flex" onclick="document.getElementById('comment-ca-marche').scrollIntoView({behavior: 'smooth'})">
                    <span class="text-[10px] uppercase tracking-[0.2em]">Découvrir</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>
                </div>

                {{-- Colonne carte profil avec tilt 3D --}}
                <div class="flex-1 w-full">
                    <div class="relative w-full max-w-md mx-auto">
                        <div class="absolute -inset-1 bg-gradient-to-tr from-amber-500/50 via-sky-500/30 to-purple-500/40 rounded-3xl blur-xl opacity-70 bff-animate-gradient"></div>

                        <div class="relative bg-slate-900/95 border border-slate-700/70 rounded-3xl p-5 shadow-2xl text-[11px] bff-card-tilt bff-card-glow">
                            <div class="bff-card-tilt-inner">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-slate-400 text-[10px]">Profil joueur</p>
                                        <p class="text-lg font-semibold">Ilian</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/40 text-[10px]">
                                        Objectif : signer pro
                                    </span>
                                </div>

                                <div class="grid grid-cols-3 gap-3 mb-4">
                                    <div class="bg-slate-800/80 rounded-xl p-3">
                                        <p class="text-slate-400 text-[10px]">Poste</p>
                                        <p class="font-semibold mt-1">Ailier droit</p>
                                    </div>
                                    <div class="bg-slate-800/80 rounded-xl p-3">
                                        <p class="text-slate-400 text-[10px]">Âge</p>
                                        <p class="font-semibold mt-1">18 ans</p>
                                    </div>
                                    <div class="bg-slate-800/80 rounded-xl p-3">
                                        <p class="text-slate-400 text-[10px]">Club</p>
                                        <p class="font-semibold mt-1">AFC tubize</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="text-slate-400 text-[10px] mb-1">Vidéo mise en avant</p>
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

                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-slate-400 text-[10px]">Radar de Performance</p>
                                        <span class="text-[9px] text-amber-500 font-bold uppercase tracking-wider">Élite U19</span>
                                    </div>
                                    
                                    <div class="relative bg-slate-800/40 rounded-2xl p-4 flex items-center justify-center border border-slate-700/30">
                                        {{-- SVG Radar Chart --}}
                                        <svg viewBox="0 0 100 100" class="w-32 h-32 transform drop-shadow-lg">
                                            {{-- Background Hexagons --}}
                                            <polygon points="50,5 93,30 93,80 50,100 7,80 7,30" fill="none" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <polygon points="50,25 73,38 73,63 50,75 27,63 27,38" fill="none" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            
                                            {{-- Axis Lines --}}
                                            <line x1="50" y1="50" x2="50" y2="5" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <line x1="50" y1="50" x2="93" y2="30" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <line x1="50" y1="50" x2="93" y2="80" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <line x1="50" y1="50" x2="50" y2="100" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <line x1="50" y1="50" x2="7" y2="80" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />
                                            <line x1="50" y1="50" x2="7" y2="30" stroke="currentColor" stroke-width="0.5" class="text-slate-700" />

                                            {{-- Performance Data Polygon --}}
                                            <polygon 
                                                points="50,15 85,35 80,75 50,90 20,75 15,35" 
                                                fill="rgba(245, 158, 11, 0.3)" 
                                                stroke="#f59e0b" 
                                                stroke-width="1.5"
                                                class="bff-animate-radar"
                                            />

                                            {{-- Data Points --}}
                                            <circle cx="50" cy="15" r="1.5" fill="#f59e0b" />
                                            <circle cx="85" cy="35" r="1.5" fill="#f59e0b" />
                                            <circle cx="80" cy="75" r="1.5" fill="#f59e0b" />
                                            <circle cx="50" cy="90" r="1.5" fill="#f59e0b" />
                                            <circle cx="20" cy="75" r="1.5" fill="#f59e0b" />
                                            <circle cx="15" cy="35" r="1.5" fill="#f59e0b" />
                                        </svg>

                                        {{-- Labels --}}
                                        <div class="absolute inset-0 pointer-events-none text-[8px] font-bold text-slate-400">
                                            <span class="absolute top-1 left-1/2 -translate-x-1/2 text-amber-500">MENTAL</span>
                                            <span class="absolute top-1/4 right-0 translate-x-1">PHY</span>
                                            <span class="absolute bottom-1/4 right-0 translate-x-1">TECH</span>
                                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2">VISION</span>
                                            <span class="absolute bottom-1/4 left-0 -translate-x-1">VIT</span>
                                            <span class="absolute top-1/4 left-0 -translate-x-1">SOCIAL</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 grid grid-cols-2 gap-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                            <span class="text-[9px] text-slate-400 italic">"Grosse force mentale sous pression"</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-amber-500/40"></div>
                                            <span class="text-[9px] text-slate-400 italic">"À travailler : volume de jeu"</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-slate-800 flex items-center justify-between">
                                    <p class="text-[10px] text-slate-400">
                                        Montre ton profil aux clubs & agents, pas seulement à tes potes.
                                    </p>
                                    @auth
                                        <a href="{{ route('profile.edit') }}" class="text-[10px] text-amber-300 hover:text-amber-200">
                                            Mon profil →
                                        </a>
                                    @else
                                        <a href="{{ route('register') }}" class="text-[10px] text-amber-300 hover:text-amber-200">
                                            Créer mon profil →
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- COMMENT ÇA MARCHE (reveal au scroll) --}}
        <section id="comment-ca-marche" class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">Comment Brain Focus Football t’aide ?</h2>
            <p class="text-sm text-slate-300 mb-8 max-w-2xl">
                L’objectif n’est pas de te vendre du rêve, mais de te donner les codes du monde pro
                et un espace pour te présenter sérieusement.
            </p>

            <div class="grid md:grid-cols-3 gap-5 text-sm bff-reveal-stagger">
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                    <p class="text-xs uppercase text-amber-400 mb-1">Étape 1</p>
                    <h3 class="font-semibold mb-1">Comprendre le système</h3>
                    <p class="text-slate-300 text-xs">
                        Articles sur le mental, les agents, les essais, les réseaux sociaux,
                        les blessures, l’entourage… Tu comprends les règles du jeu.
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

        {{-- COMPTEURS DE STATS (Section Golden) --}}
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

        {{-- ARTICLES / CATÉGORIES (reveal + stagger) --}}
        <section id="articles" class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">Comprendre le monde du football pro</h2>
            <p class="text-sm text-slate-300 mb-8 max-w-2xl">
                Avant de parler de contrats et de gros clubs, il faut comprendre ce que les pros vivent vraiment :
                pression, choix de carrière, sacrifices, entourage…  
                On t’explique tout, sans filtre.
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
                        Gérer les sorties, TikTok, les amis, l’école… sans perdre ton objectif de vue.
                    </p>
                    <a href="{{ route('articles.index') }}" class="text-[11px] text-amber-300 hover:text-amber-200">Explorer →</a>
                </div>
            </div>
        </section>

        {{-- BANDEAU DÉFILANT TALENTS (Marquee Interactif) --}}
        <section class="py-6 bg-slate-950/80 border-y border-slate-900/50 overflow-hidden bff-reveal">
            <div class="max-w-6xl mx-auto px-4 mb-3 flex items-center gap-3 opacity-60">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                <h2 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Talents à la une</h2>
            </div>
            
            <div class="relative flex overflow-hidden group">
                <div class="flex animate-marquee whitespace-nowrap gap-12 items-center py-2">
                    @forelse ($players->concat($players) as $player) {{-- On double pour l'effet infini si peu de joueurs --}}
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
                        {{-- Fallback si pas encore de joueurs --}}
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





        {{-- SECTION PROFIL JOUEUR (reveal) --}}
        <section id="profil-joueur" class="bg-slate-900/70 border-y border-slate-800 bff-reveal">
            <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14 flex flex-col lg:flex-row gap-10 items-center">
                <div class="flex-1">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ton profil joueur, pensé pour les recruteurs.</h2>
                    <p class="text-sm text-slate-300 mb-5 max-w-xl">
                        Fini les vidéos perdues sur WhatsApp. Tu as une page propre, avec tes infos, tes vidéos,
                        tes stats et tes objectifs.  
                        Quand un coach te demande “tu as quelque chose à m’envoyer ?”, tu as un lien prêt.
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
                        <p class="text-slate-400 text-[10px] mb-2">Aperçu d’un profil type</p>
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

        {{-- TÉMOIGNAGES (Section Prestige) --}}
        <section class="max-w-6xl mx-auto px-4 py-16 lg:py-20 bff-reveal">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ils ont franchi un palier avec nous</h2>
                <div class="w-16 h-1 bg-amber-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8 bff-reveal-stagger">
                {{-- Témoignage 1 --}}
                <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative">
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">“</div>
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
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">“</div>
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
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500/20 text-4xl font-serif">“</div>
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

        {{-- SECTION FAQ (Accordéon Premium) --}}
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

        {{-- CALL TO ACTION FINAL (reveal) --}}

        <section class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
            <div class="bg-gradient-to-r from-amber-600/20 via-amber-500/10 to-sky-500/10 border border-amber-500/30 rounded-3xl p-6 lg:p-8 flex flex-col lg:flex-row items-center justify-between gap-6">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">
                        Prendre ta carrière au sérieux, ça commence maintenant.
                    </h2>
                    <p class="text-sm text-slate-200 max-w-xl">
                        Tu peux continuer à espérer que quelqu’un te découvre par hasard,  
                        ou tu peux commencer à te présenter comme un joueur pro dès aujourd’hui.
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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.bff-counter').parentElement.parentElement.parentElement.parentElement;
        observer.observe(statsSection);

    });
</script>
@endpush
