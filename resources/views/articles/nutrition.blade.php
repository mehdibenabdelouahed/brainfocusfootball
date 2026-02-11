@extends('layouts.app')

@section('title', 'Nutrition du Footballeur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-300 font-sans selection:bg-amber-500/30">

    {{-- GOOGLE FONTS LOADING --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&family=Inter:wght@300;400;600&display=swap');
        .font-oswald { font-family: 'Oswald', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="/images/articles/alimentation.png" alt="Nutrition Football" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/80 to-slate-950"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-transparent to-slate-950"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-12">
            <div class="inline-block mb-4 px-3 py-1 rounded-full border border-amber-500/50 bg-amber-500/10 backdrop-blur-sm">
                <span class="text-amber-400 font-oswald tracking-widest text-sm uppercase">Performance & Santé</span>
            </div>
            <h1 class="font-oswald text-5xl md:text-7xl font-bold text-white mb-6 uppercase tracking-tight leading-none drop-shadow-2xl">
                Nutrition <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-yellow-400 to-amber-600">du Pro</span>
            </h1>
            <p class="font-inter text-lg md:text-xl text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Le guide ultime pour alimenter ta machine, exploser tes records et récupérer comme un champion.
            </p>
        </div>
    </div>


    <div class="max-w-4xl mx-auto px-4 pb-24 relative z-20 -mt-20">

        {{-- MEDIA PLAYERS (Glassmorphism Cards) --}}
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            
            {{-- AUDIO PLAYER --}}
            <div class="group relative bg-slate-900/60 backdrop-blur-md border border-slate-800 hover:border-amber-500/50 rounded-2xl p-6 transition-all duration-300 hover:shadow-[0_0_30px_-10px_rgba(245,158,11,0.3)]">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center text-slate-950 shadow-lg shadow-amber-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-oswald text-xl uppercase text-white tracking-wide">Podcast Audio</h3>
                                <p class="font-inter text-xs text-amber-400 font-medium tracking-wider">ÉCOUTE IMMERSIVE • 15 MIN</p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <span class="animate-pulse w-2 h-2 rounded-full bg-red-500 block"></span>
                        </div>
                    </div>
                    <audio controls class="w-full h-10 rounded-lg accent-amber-500 contrast-125">
                        <source src="/audio/Le_carburant_invisible_de_la_performance_footballistique.m4a" type="audio/mp4">
                        Votre navigateur ne supporte pas l'élément audio.
                    </audio>
                </div>
            </div>

            {{-- VIDEO PLAYER --}}
            <div class="group relative bg-slate-900/60 backdrop-blur-md border border-slate-800 hover:border-amber-500/50 rounded-2xl p-6 transition-all duration-300 hover:shadow-[0_0_30px_-10px_rgba(245,158,11,0.3)]">
                <div class="absolute inset-0 bg-gradient-to-bl from-amber-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-oswald text-xl uppercase text-white tracking-wide flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Version Vidéo
                        </h3>
                    </div>
                    <div class="aspect-video bg-black rounded-lg overflow-hidden relative shadow-2xl border border-slate-800/50">
                        <video controls class="w-full h-full object-cover">
                            <source src="/videos/Nutrition_pour_Footballeurs.mp4" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                    </div>
                </div>
            </div>

        </div>

        {{-- ARTICLE CONTENT --}}
        <div class="prose prose-lg prose-invert max-w-none font-inter leading-8">
            
            {{-- Intro Paragraph --}}
            <p class="text-xl text-slate-200 mb-12 border-l-4 border-amber-500 pl-6 italic font-light">
                "Ton corps est ton outil de travail. Si tu mets du carburant de mauvaise qualité dans une Ferrari, elle roulera comme une Twingo."
            </p>

            <h2 class="font-oswald text-3xl text-white uppercase tracking-wide mb-6 flex items-center gap-3">
                <span class="text-amber-500 text-4xl">01.</span> Les Fondations
            </h2>
            <p class="mb-8">
                Un footballeur parcourt <span class="text-amber-400 font-semibold">10 à 12 km par match</span> et réalise 30 à 50 actions explosives. 
                Cela représente entre 1100 et 1500 kcal dépensées. Vider ses réserves = baisse de régime.
            </p>

            <h2 class="font-oswald text-3xl text-white uppercase tracking-wide mb-6 mt-16 flex items-center gap-3">
                <span class="text-amber-500 text-4xl">02.</span> Le Carburant
            </h2>

            <div class="grid md:grid-cols-3 gap-6 my-10 not-prose">
                {{-- Card Glucides --}}
                <div class="bg-slate-900 border border-slate-800 p-6 rounded-xl hover:border-amber-500/30 transition">
                    <h4 class="font-oswald text-amber-400 text-xl uppercase mb-2">Glucides</h4>
                    <p class="text-sm text-slate-400 mb-2">L'énergie pure.</p>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• Pâtes / Riz</li>
                        <li>• Fruits</li>
                        <li>• Avoine</li>
                    </ul>
                </div>
                 {{-- Card Protéines --}}
                 <div class="bg-slate-900 border border-slate-800 p-6 rounded-xl hover:border-amber-500/30 transition">
                    <h4 class="font-oswald text-amber-400 text-xl uppercase mb-2">Protéines</h4>
                    <p class="text-sm text-slate-400 mb-2">La construction.</p>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• Poulet / Poisson</li>
                        <li>• Œufs</li>
                        <li>• Légumineuses</li>
                    </ul>
                </div>
                 {{-- Card Lipides --}}
                 <div class="bg-slate-900 border border-slate-800 p-6 rounded-xl hover:border-amber-500/30 transition">
                    <h4 class="font-oswald text-amber-400 text-xl uppercase mb-2">Lipides</h4>
                    <p class="text-sm text-slate-400 mb-2">L'endurance.</p>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• Avocat</li>
                        <li>• Noix / Amandes</li>
                        <li>• Huile d'olive</li>
                    </ul>
                </div>
            </div>

            <h3 class="font-oswald text-2xl text-white uppercase mt-10 mb-4">L'Hydratation : Le Facteur X</h3>
            <p>
                Une perte de <span class="text-amber-400 font-bold">2% d’eau</span> = <span class="text-red-400 font-bold">-20% de performance</span>. 
                L’hydratation n'est pas une option, c'est une compétence tactique.
            </p>
            <ul class="list-none pl-0 space-y-3 mt-6">
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span><strong>Avant match :</strong> 500ml (3h avant) + 300ml (30min avant)</span>
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span><strong>Mi-temps :</strong> 400-500ml (Isotonique recommandé)</span>
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span><strong>Après match :</strong> Récupérer 150% du poids perdu</span>
                </li>
            </ul>

            <h2 class="font-oswald text-3xl text-white uppercase tracking-wide mb-6 mt-16 flex items-center gap-3">
                <span class="text-amber-500 text-4xl">03.</span> Jour de Match
            </h2>
            
            <div class="relative pl-8 border-l border-slate-800 space-y-8 my-10">
                <div class="relative">
                    <span class="absolute -left-[37px] top-1 w-4 h-4 rounded-full bg-amber-500 ring-4 ring-slate-950"></span>
                    <h4 class="font-oswald text-xl text-white mb-1">H-4 : Le dernier grand repas</h4>
                    <p class="text-sm text-slate-400">Riz blanc, Dinde, Légumes cuits. Facile à digérer.</p>
                </div>
                <div class="relative">
                    <span class="absolute -left-[37px] top-1 w-4 h-4 rounded-full bg-slate-800 ring-4 ring-slate-950 border border-amber-500/50"></span>
                    <h4 class="font-oswald text-xl text-white mb-1">H-1.5 : La collation</h4>
                    <p class="text-sm text-slate-400">Banane, Compote ou Barre de céréales.</p>
                </div>
                 <div class="relative">
                    <span class="absolute -left-[37px] top-1 w-4 h-4 rounded-full bg-amber-500 ring-4 ring-slate-950"></span>
                    <h4 class="font-oswald text-xl text-white mb-1">Mi-temps</h4>
                    <p class="text-sm text-slate-400">Boisson glucidique, Gel ou Pâte de fruit.</p>
                </div>
            </div>

            <div class="mt-16 bg-gradient-to-r from-amber-500/10 to-transparent border-l-4 border-amber-500 p-8 rounded-r-xl">
                <h3 class="font-oswald text-2xl text-white uppercase mb-2">Le mot de la fin</h3>
                <p class="text-slate-300 italic">
                    "La nutrition ne te fera pas gagner le match à elle seule, mais une mauvaise nutrition te le fera perdre à coup sûr."
                </p>
            </div>

        </div>

    </div>
</div>
@endsection
