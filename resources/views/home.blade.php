@extends('layouts.app')

@section('title', 'Brain Focus Football - Devenir pro commence dans la tête')

@section('content')
<div class="min-h-screen flex flex-col bg-slate-950 text-white">

    {{-- NAVBAR --}}
    <header class="py-2 border-b border-slate-800 bg-slate-950/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
           <div class="flex items-center gap-3">
    <a href="/" class="flex items-center gap-2">
        <img
            src="/images/logoBFF.png"
            alt="Logo Brain Focus Football"
            class="w-12 h-12 object-contain"
        >
        <div class="leading-tight text-sm">
            <p class="font-semibold text-[23px]">Brain Focus Football</p>
            <p class="text-[12px] text-slate-400">Les champions commencent par l'esprit</p>
        </div>
    </a>
</div>


            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="#articles" class="text-slate-300 hover:text-emerald-400 transition">Catégories</a>
                <a href="#profil-joueur" class="text-slate-300 hover:text-emerald-400 transition">Profil joueurs</a>
                <a href="#comment-ca-marche" class="text-slate-300 hover:text-emerald-400 transition">Comment ça marche</a>
            </nav>

            <div class="flex items-center gap-2 text-xs">
        
                <a href="#"
                   class="px-3 py-1.5 rounded-full border border-slate-700 hover:border-emerald-400 text-slate-200 hover:text-emerald-300 transition">
                    Connexion
                </a>
                {{-- Plus tard : href="{{ route('register') }}" --}}
                <a href="#"
                   class="px-3 py-1.5 rounded-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-semibold transition bff-btn-main">
                    Créer un profil
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1">
        {{-- HERO avec parallax + reveal + tilt --}}
        <section class="relative bff-parallax-wrapper">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-emerald-900 opacity-90"></div>
            <div class="bff-parallax-layer"></div>

            <div class="relative max-w-6xl mx-auto px-4 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-10 bff-reveal">
                {{-- Colonne texte --}}
                <div class="flex-1 bff-animate-fade-in-up">
                
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-4">
                        Devenir pro commence <span class="bff-title-highlight">dans la tête</span>.
                    </h1>
                    <p class="text-sm sm:text-base text-slate-300 mb-6 max-w-xl">
                        Brain Focus Football t’explique les coulisses du football professionnel :
                        mental, carrière, agents, réseaux sociaux, hygiène de vie…  
                        Et te permet de créer un profil joueur pour te montrer comme un pro.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        {{-- Plus tard : route('register') --}}
                        <a href="#"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-emerald-500 hover:bg-emerald-400 text-sm font-semibold shadow-lg shadow-emerald-500/30 transition bff-btn-main bff-btn-pulse">
                            Créer mon profil joueur
                        </a>
                        <a href="#articles"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-full border border-slate-600 hover:border-emerald-400 text-sm font-semibold text-slate-200 hover:text-emerald-300 transition">
                            Découvrir les articles
                        </a>
                    </div>

                    <div class="flex items-center gap-6 text-[11px] text-slate-400">
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

                {{-- Colonne carte profil avec tilt 3D --}}
                <div class="flex-1 w-full">
                    <div class="relative w-full max-w-md mx-auto">
                        <div class="absolute -inset-1 bg-gradient-to-tr from-emerald-500/50 via-sky-500/30 to-purple-500/40 rounded-3xl blur-xl opacity-70 bff-animate-gradient"></div>

                        <div class="relative bg-slate-900/95 border border-slate-700/70 rounded-3xl p-5 shadow-2xl text-[11px] bff-card-tilt bff-card-glow">
                            <div class="bff-card-tilt-inner">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-slate-400 text-[10px]">Profil joueur</p>
                                        <p class="text-lg font-semibold">Ilian</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-300 border border-emerald-500/40 text-[10px]">
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
                                            src="/videos/header.mp4"
                                            autoplay
                                            muted
                                            loop
                                            playsinline
                                            class="absolute inset-0 bg-gradient-to-tr from-slate-950/30 to-transparent">
                                        </video>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="text-slate-400 text-[10px] mb-1">Objectifs</p>
                                    <ul class="space-y-1">
                                        <li class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                            Intégrer un centre de formation pro
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                            Publier 1 nouvelle vidéo / mois
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                            Travailler le mental & la pression des matchs
                                        </li>
                                    </ul>
                                </div>

                                <div class="pt-3 border-t border-slate-800 flex items-center justify-between">
                                    <p class="text-[10px] text-slate-400">
                                        Montre ton profil aux clubs & agents, pas seulement à tes potes.
                                    </p>
                                    {{-- Plus tard : route('register') --}}
                                    <a href="#" class="text-[10px] text-emerald-300 hover:text-emerald-200">
                                        Créer mon profil →
                                    </a>
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
                    <p class="text-xs uppercase text-emerald-400 mb-1">Étape 1</p>
                    <h3 class="font-semibold mb-1">Comprendre le système</h3>
                    <p class="text-slate-300 text-xs">
                        Articles sur le mental, les agents, les essais, les réseaux sociaux,
                        les blessures, l’entourage… Tu comprends les règles du jeu.
                    </p>
                </div>

                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                    <p class="text-xs uppercase text-emerald-400 mb-1">Étape 2</p>
                    <h3 class="font-semibold mb-1">Structurer ta carrière</h3>
                    <p class="text-slate-300 text-xs">
                        Tu clarifies tes objectifs : où tu veux aller, en combien de temps,
                        quelles habitudes tu dois mettre en place au quotidien.
                    </p>
                </div>

                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                    <p class="text-xs uppercase text-emerald-400 mb-1">Étape 3</p>
                    <h3 class="font-semibold mb-1">Créer ta vitrine</h3>
                    <p class="text-slate-300 text-xs">
                        Tu crées un profil joueur propre, avec vidéos, stats et description.
                        Quand une opportunité arrive, tu as déjà quelque chose à envoyer.
                    </p>
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
                <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                    <p class="text-[11px] uppercase tracking-wide text-emerald-400 mb-1">Mental</p>
                    <h3 class="font-semibold mb-1 text-sm">Confiance & pression</h3>
                    <p class="text-slate-300 text-xs mb-3">
                        Gestion du stress, concurrence, banc, critiques, réseaux sociaux…
                    </p>
                    <span class="text-[11px] text-emerald-300">Lire les articles →</span>
                </div>

                <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                    <p class="text-[11px] uppercase tracking-wide text-emerald-400 mb-1">Carrière</p>
                    <h3 class="font-semibold mb-1 text-sm">Agents, essais & contrats</h3>
                    <p class="text-slate-300 text-xs mb-3">
                        Comment approcher un agent, se préparer à un essai et éviter les pièges.
                    </p>
                    <span class="text-[11px] text-emerald-300">Découvrir →</span>
                </div>

                <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                    <p class="text-[11px] uppercase tracking-wide text-emerald-400 mb-1">Hygiène de vie</p>
                    <h3 class="font-semibold mb-1 text-sm">Sommeil, nutrition, récup</h3>
                    <p class="text-slate-300 text-xs mb-3">
                        Ce que les pros font au quotidien pour rester au top physiquement.
                    </p>
                    <span class="text-[11px] text-emerald-300">Voir plus →</span>
                </div>

                <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                    <p class="text-[11px] uppercase tracking-wide text-emerald-400 mb-1">Environnement</p>
                    <h3 class="font-semibold mb-1 text-sm">Famille, école, distractions</h3>
                    <p class="text-slate-300 text-xs mb-3">
                        Gérer les sorties, TikTok, les amis, l’école… sans perdre ton objectif de vue.
                    </p>
                    <span class="text-[11px] text-emerald-300">Explorer →</span>
                </div>
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
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span><strong>Infos claires :</strong> poste, club, âge, taille, pied fort, niveau.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span><strong>Vidéos :</strong> best-of, matchs complets, entraînements.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span><strong>Objectifs :</strong> ce que tu vises et comment tu comptes y arriver.</span>
                        </li>
                    </ul>

                    <div class="mt-6 flex flex-wrap gap-3">
                        {{-- Plus tard : route('register') --}}
                        <a href="#"
                           class="px-5 py-3 rounded-full bg-emerald-500 hover:bg-emerald-400 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/30 transition bff-btn-main">
                            Créer mon profil maintenant
                        </a>
                        {{-- Plus tard : route('login') --}}
                        <a href="#"
                           class="px-5 py-3 rounded-full border border-slate-600 hover:border-emerald-400 text-sm font-semibold text-slate-200 hover:text-emerald-300 transition">
                            J’ai déjà un compte
                        </a>
                    </div>
                </div>

                <div class="flex-1 w-full">
                    <div class="bg-slate-950/90 border border-slate-800 rounded-2xl p-4 text-[11px]">
                        <p class="text-slate-400 text-[10px] mb-2">Aperçu d’un profile type</p>
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
                                    <p class="text-slate-400 text-[10px]">Poste</p>
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
                                            src="/videos/header.mp4"
                                            autoplay
                                            muted
                                            loop
                                            playsinline
                                            class="absolute inset-0 bg-gradient-to-tr from-slate-950/30 to-transparent">
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

        {{-- CALL TO ACTION FINAL (reveal) --}}
        <section class="max-w-6xl mx-auto px-4 py-10 lg:py-14 bff-reveal">
            <div class="bg-gradient-to-r from-emerald-600/20 via-emerald-500/10 to-sky-500/10 border border-emerald-500/30 rounded-3xl p-6 lg:p-8 flex flex-col lg:flex-row items-center justify-between gap-6">
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
                    {{-- Plus tard : route('register') --}}
                    <a href="#"
                       class="px-5 py-3 rounded-full bg-emerald-500 hover:bg-emerald-400 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/40 transition bff-btn-main bff-btn-pulse">
                        Je crée mon profil maintenant
                    </a>
                    <a href="#comment-ca-marche"
                       class="px-5 py-3 rounded-full border border-slate-200/40 hover:border-emerald-300 text-sm font-semibold text-slate-100 hover:text-emerald-200 transition">
                        Voir comment ça fonctionne
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
                <a href="#" class="hover:text-emerald-300">Mentions légales</a>
                <a href="#" class="hover:text-emerald-300">Confidentialité</a>
                <a href="#" class="hover:text-emerald-300">Contact</a>
            </div>
        </div>
    </footer>
</div>
@endsection
