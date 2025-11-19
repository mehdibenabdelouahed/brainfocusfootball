@extends('layouts.app')

@section('title', 'Comment ça marche - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14">
        <h1 class="text-3xl font-bold mb-3">Comment fonctionne Brain Focus Football ?</h1>
        <p class="text-sm text-slate-300 mb-8 max-w-2xl">
            Brain Focus Football n’est pas une appli magique qui te promet de devenir pro.
            C’est un outil sérieux pour t’aider à comprendre le monde pro, structurer ta carrière,
            et te présenter proprement aux bonnes personnes.
        </p>

        <div class="grid md:grid-cols-3 gap-6 text-sm">
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-xs uppercase text-emerald-400 mb-1">1. Tu apprends</p>
                <p class="text-slate-200 mb-1 font-semibold">Articles & contenu</p>
                <p class="text-slate-300 text-xs">
                    Tu commences par lire des contenus sur le mental, la carrière, les agents,
                    les réseaux sociaux, l’hygiène de vie…
                </p>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-xs uppercase text-emerald-400 mb-1">2. Tu structure</p>
                <p class="text-slate-200 mb-1 font-semibold">Objectifs & routine</p>
                <p class="text-slate-300 text-xs">
                    Tu définis où tu veux aller, en combien de temps, et ce que tu dois faire 
                    chaque semaine pour progresser.
                </p>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-xs uppercase text-emerald-400 mb-1">3. Tu te présentes</p>
                <p class="text-slate-200 mb-1 font-semibold">Profil joueur</p>
                <p class="text-slate-300 text-xs">
                    Tu construis un profil propre, avec tes infos, tes stats et tes vidéos, 
                    prêt à être envoyé à un coach ou un agent.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
