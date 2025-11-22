@extends('layouts.app')

@section('title', 'Articles - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    
    {{-- Header --}}
    <header class="py-2 border-b border-slate-800 bg-slate-950/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
           <div class="flex items-center gap-3">
    <a href="/" class="flex items-center gap-2">
        <img
            src="/images/logoBFF.png"
            alt="Logo Brain Focus Football"
            class="w-14 h-14 object-contain"
        >
        <div class="leading-tight text-sm">
            <p class="font-semibold text-[23px]">Brain Focus Football</p>
            <p class="text-[12px] text-slate-400">Les champions commencent par l'esprit</p>
        </div>
    </a>
</div>

            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('articles.index') }}" class="hover:text-amber-400 text-amber-400">Articles</a>
                <a href="{{ route('player.profile') }}" class="hover:text-amber-400">Profil joueur</a>
                <a href="{{ route('contact') }}" class="hover:text-amber-400">Contact</a>
            </nav>

            <div class="flex items-center gap-2 text-xs">
                <a href="{{ route('login') }}"
                   class="px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="px-3 py-1.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition bff-btn-main">
                    Créer un profil
                </a>
            </div>
        </div>
    </header>

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

            {{-- Articles Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Card 1: Alimentation --}}
                <a href="{{ route('articles.nutrition') }}" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/alimentation.png" alt="Alimentation" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Alimentation</h3>
                        <p class="text-sm text-slate-400 mb-3">Nutrition, hydratation et timing des repas pour optimiser tes performances.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 2: Au sein du groupe --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/groupe.png" alt="Au sein du groupe" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Au sein du groupe</h3>
                        <p class="text-sm text-slate-400 mb-3">Relations avec tes coéquipiers, intégration et dynamique d'équipe.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 3: Blessures --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/blessures.png" alt="Blessures" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Blessures</h3>
                        <p class="text-sm text-slate-400 mb-3">Prévention, récupération et gestion mentale des blessures.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 4: Contrats --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/contrats.png" alt="Contrats" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Contrats</h3>
                        <p class="text-sm text-slate-400 mb-3">Comprendre les contrats, négociations et aspects juridiques.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 5: Exercices --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/exercices.png" alt="Exercices" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Exercices</h3>
                        <p class="text-sm text-slate-400 mb-3">Exercices techniques, physiques et mentaux pour progresser.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 6: Facteurs externe --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/facteurs_externe.png" alt="Facteurs externe" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Facteurs externe</h3>
                        <p class="text-sm text-slate-400 mb-3">Famille, école, réseaux sociaux et distractions à gérer.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 7: Formation --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/formation.png" alt="Formation" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Formation</h3>
                        <p class="text-sm text-slate-400 mb-3">Centres de formation, parcours et développement du joueur.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 8: Histoire --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/histoire.png" alt="Histoire" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Histoire</h3>
                        <p class="text-sm text-slate-400 mb-3">Histoires inspirantes de joueurs et moments clés du football.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 9: Le coaching --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/coaching.png" alt="Le coaching" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Le coaching</h3>
                        <p class="text-sm text-slate-400 mb-3">Relation avec l'entraîneur, conseils et développement personnel.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 10: Préparation mentale --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/preparation_mentale.png" alt="Préparation mentale" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Préparation mentale</h3>
                        <p class="text-sm text-slate-400 mb-3">Gestion du stress, confiance en soi et mental de champion.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 11: Préparation physique --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/preparation_physique.png" alt="Préparation physique" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Préparation physique</h3>
                        <p class="text-sm text-slate-400 mb-3">Entraînement, récupération et optimisation des performances.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 12: Roles --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/roles.png" alt="Roles" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Roles</h3>
                        <p class="text-sm text-slate-400 mb-3">Comprendre les différents rôles et postes sur le terrain.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

                {{-- Card 13: Techniques et tactiques --}}
                <a href="#" class="group block bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-400/70 transition-all hover:transform hover:scale-105">
                    <div class="aspect-video overflow-hidden">
                        <img src="/images/articles/techniques_tactiques.png" alt="Techniques et tactiques" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-400 transition">Techniques et tactiques</h3>
                        <p class="text-sm text-slate-400 mb-3">Systèmes de jeu, schémas tactiques et techniques individuelles.</p>
                        <span class="text-xs text-amber-400 font-medium">Lire les articles →</span>
                    </div>
                </a>

            </div>
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
