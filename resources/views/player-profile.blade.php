@extends('layouts.app')

@section('title', 'Profil joueur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14">
        <h1 class="text-3xl font-bold mb-3">Ton profil joueur</h1>
        <p class="text-sm text-slate-300 mb-8 max-w-2xl">
            Cette page sera, plus tard, l’endroit où chaque joueur pourra gérer son profil :
            infos, vidéos, stats, objectifs, lien à partager aux clubs et agents.
            Pour l’instant, on garde une version statique pour le design.
        </p>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5">
                <h2 class="text-lg font-semibold mb-3">Infos principales</h2>
                <ul class="space-y-2 text-sm text-slate-200">
                    <li><strong>Nom affiché :</strong> Champion_10</li>
                    <li><strong>Nom complet :</strong> Mehdi</li>
                    <li><strong>Poste :</strong> Ailier droit</li>
                    <li><strong>Club :</strong> U19 – Division nationale</li>
                    <li><strong>Objectif :</strong> Signer un premier contrat pro</li>
                </ul>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5">
                <h2 class="text-lg font-semibold mb-3">Vidéo mise en avant</h2>
                <div class="aspect-video rounded-xl overflow-hidden relative">
                    <video
                        src="/videos/highlight.mp4"
                        autoplay
                        muted
                        loop
                        playsinline
                        class="absolute inset-0 w-full h-full object-cover">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-tr from-slate-950/20 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
