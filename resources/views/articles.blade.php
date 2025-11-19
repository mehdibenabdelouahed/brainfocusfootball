@extends('layouts.app')

@section('title', 'Articles - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14">
        <h1 class="text-3xl font-bold mb-3">Articles pour comprendre le monde pro</h1>
        <p class="text-sm text-slate-300 mb-8 max-w-2xl">
            Mental, agents, essais, hygiène de vie, réseaux sociaux… 
            Ici tu retrouves tous les contenus pour comprendre ce qui se passe 
            derrière les coulisses du football professionnel.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <article class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                <p class="text-[11px] uppercase text-emerald-400 mb-1">Mental</p>
                <h2 class="font-semibold mb-2 text-sm">Gérer la pression des grands matchs</h2>
                <p class="text-xs text-slate-300 mb-3">
                    Comment réagir quand tu joues devant du monde, quand tu rates, 
                    quand tu sens que le coach ne te fait plus confiance…
                </p>
                <a href="#" class="text-[11px] text-emerald-300">Lire l’article →</a>
            </article>

            <article class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                <p class="text-[11px] uppercase text-emerald-400 mb-1">Carrière</p>
                <h2 class="font-semibold mb-2 text-sm">Premiers contacts avec un agent</h2>
                <p class="text-xs text-slate-300 mb-3">
                    À quel moment parler à un agent, quoi lui envoyer, 
                    comment repérer ceux qui ne sont pas sérieux…
                </p>
                <a href="#" class="text-[11px] text-emerald-300">Lire l’article →</a>
            </article>

            <article class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 hover:border-emerald-400/70 transition">
                <p class="text-[11px] uppercase text-emerald-400 mb-1">Hygiène de vie</p>
                <h2 class="font-semibold mb-2 text-sm">Routine d’un joueur qui veut devenir pro</h2>
                <p class="text-xs text-slate-300 mb-3">
                    Sommeil, alimentation, récupération, réseaux sociaux… 
                    Un exemple de journée type pour progresser vraiment.
                </p>
                <a href="#" class="text-[11px] text-emerald-300">Lire l’article →</a>
            </article>
            <a href="{{ route('articles.nutrition') }}" 
            class="text-[11px] text-emerald-300 hover:text-emerald-400">
              Lire l’article Nutrition →
            </a>
        </div>
    </div>
</div>
@endsection
