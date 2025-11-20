@extends('layouts.app')

@section('title', 'Nutrition du Footballeur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-[#0B1120] text-slate-300 font-sans selection:bg-emerald-500/30">
    
    {{-- Progress Bar (Optional, adds a nice touch) --}}
    <div class="fixed top-0 left-0 h-1 bg-emerald-500 z-50 w-0" id="progress-bar"></div>

    {{-- Hero Section --}}
    <div class="relative w-full pt-32 pb-20 px-4 overflow-hidden">
        {{-- Background Glow Effects --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[500px] bg-emerald-500/10 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-3xl mx-auto relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium uppercase tracking-wider mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                Nutrition & Performance
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.1] mb-6">
                Nutrition du Footballeur : <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Le Guide Complet</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-400 leading-relaxed max-w-2xl mx-auto">
                Comprendre comment manger pour tenir 90 minutes, accélérer la récupération et éviter les blessures.
            </p>

            {{-- Author / Meta --}}
            <div class="flex items-center justify-center gap-4 mt-8 text-sm text-slate-500">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700">
                        <span class="font-bold text-slate-300">BF</span>
                    </div>
                    <span>Brain Focus Team</span>
                </div>
                <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                <time datetime="2023-11-20">20 Nov 2023</time>
                <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                <span>8 min de lecture</span>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <article class="max-w-2xl mx-auto px-4 pb-24">
        <div class="prose prose-lg prose-invert prose-headings:text-white prose-p:text-slate-300 prose-a:text-emerald-400 hover:prose-a:text-emerald-300 prose-strong:text-white prose-li:text-slate-300 max-w-none">
            
            <div class="p-6 rounded-2xl bg-slate-900/50 border border-slate-800/50 mb-12 not-prose">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                    Sommaire
                </h3>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="#pilier" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><span class="text-slate-600">01.</span> Le pilier de la performance</a></li>
                    <li><a href="#macros" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><span class="text-slate-600">02.</span> Les macronutriments</a></li>
                    <li><a href="#hydration" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><span class="text-slate-600">03.</span> L'hydratation</a></li>
                    <li><a href="#timing" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><span class="text-slate-600">04.</span> Timing des repas</a></li>
                </ul>
            </div>

            <h2 id="pilier" class="flex items-center gap-3 group">
                <span class="text-emerald-500/20 text-5xl font-black -ml-4 select-none group-hover:text-emerald-500/30 transition-colors">1</span>
                Pourquoi la nutrition est un pilier
            </h2>
            
            <p>
                Un footballeur parcourt <strong class="text-white">10 à 12 km par match</strong> et réalise 30 à 50 actions explosives. 
                Cela représente entre 1100 et 1500 kcal dépensées, et vide presque totalement les réserves de glycogène. 
            </p>
            <p>
                Une bonne nutrition n'est pas un "plus", c'est la base qui permet de maintenir l'intensité, prévenir les blessures et optimiser la récupération.
            </p>

            <h2 id="macros" class="flex items-center gap-3 group mt-16">
                <span class="text-emerald-500/20 text-5xl font-black -ml-4 select-none group-hover:text-emerald-500/30 transition-colors">2</span>
                Les macronutriments
            </h2>

            <div class="grid gap-6 not-prose my-8">
                <div class="p-5 rounded-xl bg-slate-900 border border-slate-800 hover:border-emerald-500/30 transition-colors group/card">
                    <h3 class="text-lg font-semibold text-emerald-400 mb-2 group-hover/card:text-emerald-300">Glucides : L'énergie</h3>
                    <p class="text-sm text-slate-400 mb-3">Source principale d'énergie pour les efforts explosifs.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Pâtes</span>
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Riz</span>
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Fruits</span>
                    </div>
                </div>

                <div class="p-5 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/30 transition-colors group/card">
                    <h3 class="text-lg font-semibold text-blue-400 mb-2 group-hover/card:text-blue-300">Protéines : La réparation</h3>
                    <p class="text-sm text-slate-400 mb-3">Indispensables pour reconstruire les fibres musculaires.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Poulet</span>
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Oeufs</span>
                        <span class="px-2 py-1 rounded bg-slate-800 text-xs text-slate-300 border border-slate-700">Poisson</span>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-white mt-8">Les Lipides : Énergie durable</h3>
            <ul>
                <li>20—35% de l’apport total</li>
                <li>Favoriser oméga-3 : saumon, noix, huile d’olive</li>
            </ul>

            <h2 id="hydration" class="flex items-center gap-3 group mt-16">
                <span class="text-emerald-500/20 text-5xl font-black -ml-4 select-none group-hover:text-emerald-500/30 transition-colors">3</span>
                Hydratation : Facteur N°1
            </h2>
            
            <blockquote class="border-l-4 border-emerald-500 pl-6 py-2 my-8 bg-emerald-500/5 italic text-slate-300 rounded-r-lg">
                "Une perte de 2% d’eau = -20% de performance. L’hydratation influence la lucidité, les crampes et la vitesse de récupération."
            </blockquote>

            <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900/50 not-prose">
                <table class="w-full text-sm text-left text-slate-400">
                    <thead class="text-xs text-slate-200 uppercase bg-slate-800/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Moment</th>
                            <th scope="col" class="px-6 py-3">Quantité recommandée</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <tr class="hover:bg-slate-800/30">
                            <td class="px-6 py-4 font-medium text-white">Avant match</td>
                            <td class="px-6 py-4">500 ml (3h avant) + 300 ml (30 min avant)</td>
                        </tr>
                        <tr class="hover:bg-slate-800/30">
                            <td class="px-6 py-4 font-medium text-white">Pendant</td>
                            <td class="px-6 py-4">150–300 ml toutes les 20 min</td>
                        </tr>
                        <tr class="hover:bg-slate-800/30">
                            <td class="px-6 py-4 font-medium text-white">Après match</td>
                            <td class="px-6 py-4">150% du poids perdu</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 id="timing" class="flex items-center gap-3 group mt-16">
                <span class="text-emerald-500/20 text-5xl font-black -ml-4 select-none group-hover:text-emerald-500/30 transition-colors">4</span>
                Exemple de journée de match
            </h2>

            <ul class="relative border-l border-slate-800 ml-3 space-y-8 not-prose mt-8">
                <li class="ml-6 relative">
                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-slate-900 border-2 border-emerald-500"></span>
                    <h4 class="text-white font-bold mb-1">08:00 - Petit Déjeuner</h4>
                    <p class="text-sm text-slate-400">Avoine + fruits rouges + eau. Un bon départ glucidique.</p>
                </li>
                <li class="ml-6 relative">
                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-slate-900 border-2 border-emerald-500"></span>
                    <h4 class="text-white font-bold mb-1">11:00 - Repas d'avant-match</h4>
                    <p class="text-sm text-slate-400">Riz blanc + dinde + légumes vapeur. Facile à digérer.</p>
                </li>
                <li class="ml-6 relative">
                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-slate-900 border-2 border-emerald-500"></span>
                    <h4 class="text-white font-bold mb-1">14:00 - Hydratation</h4>
                    <p class="text-sm text-slate-400">Boisson isotonique pour charger les réserves.</p>
                </li>
                <li class="ml-6 relative">
                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-slate-900 border-2 border-emerald-500"></span>
                    <h4 class="text-white font-bold mb-1">19:00 - Récupération</h4>
                    <p class="text-sm text-slate-400">Saumon + quinoa + légumes verts. Anti-inflammatoire et reconstructeur.</p>
                </li>
            </ul>

        </div>

        {{-- Footer / Read Next --}}
        <div class="mt-20 pt-10 border-t border-slate-800">
            <h3 class="text-white font-semibold mb-6">À lire ensuite</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                <a href="#" class="group block p-4 rounded-xl bg-slate-900/50 border border-slate-800 hover:border-emerald-500/50 transition-all">
                    <span class="text-xs text-emerald-400 uppercase tracking-wider font-medium">Mental</span>
                    <h4 class="text-white font-medium mt-2 group-hover:text-emerald-300 transition-colors">Gérer la pression des grands matchs</h4>
                </a>
                <a href="#" class="group block p-4 rounded-xl bg-slate-900/50 border border-slate-800 hover:border-emerald-500/50 transition-all">
                    <span class="text-xs text-emerald-400 uppercase tracking-wider font-medium">Carrière</span>
                    <h4 class="text-white font-medium mt-2 group-hover:text-emerald-300 transition-colors">Premiers contacts avec un agent</h4>
                </a>
            </div>
        </div>
    </article>
</div>

<script>
    // Simple scroll progress bar
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("progress-bar").style.width = scrolled + "%";
    };
</script>
@endsection
