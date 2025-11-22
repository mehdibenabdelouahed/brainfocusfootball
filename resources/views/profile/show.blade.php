@extends('layouts.app')

@section('title', $user->name . ' - Profil Joueur')

@section('content')
<div class="min-h-screen bg-slate-950 text-white px-4 py-12">
    <div class="max-w-4xl mx-auto">
        {{-- Bouton retour --}}
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-amber-300 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Retour à l'accueil
            </a>
        </div>

        {{-- Carte profil principal --}}
        <div class="relative mb-8">
            <div class="absolute -inset-1 bg-gradient-to-tr from-amber-500/30 via-sky-500/20 to-purple-500/30 rounded-3xl blur-xl opacity-50"></div>
            
            <div class="relative bg-slate-900/95 border border-slate-700/70 rounded-3xl p-8 shadow-2xl">
                {{-- En-tête avec photo et infos principales --}}
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    {{-- Photo de profil --}}
                    <div class="flex-shrink-0">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-2xl object-cover border-2 border-amber-500/50">
                        @else
                            <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-bold text-5xl border-2 border-amber-500/50">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    {{-- Infos principales --}}
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $user->first_name ?? $user->name }} {{ $user->last_name }}</h1>
                        @if($user->position)
                            <p class="text-amber-400 text-lg mb-3">{{ $user->position }}</p>
                        @endif
                        @if($user->current_club || $user->level)
                            <p class="text-slate-300 mb-4">
                                @if($user->current_club){{ $user->current_club }}@endif
                                @if($user->current_club && $user->level) • @endif
                                @if($user->level){{ $user->level }}@endif
                            </p>
                        @endif

                        {{-- Réseaux sociaux --}}
                        @if($user->instagram_url || $user->tiktok_url || $user->youtube_url)
                            <div class="flex gap-3">
                                @if($user->instagram_url)
                                    <a href="{{ $user->instagram_url }}" target="_blank" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm transition">
                                        Instagram
                                    </a>
                                @endif
                                @if($user->tiktok_url)
                                    <a href="{{ $user->tiktok_url }}" target="_blank" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm transition">
                                        TikTok
                                    </a>
                                @endif
                                @if($user->youtube_url)
                                    <a href="{{ $user->youtube_url }}" target="_blank" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm transition">
                                        YouTube
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Informations détaillées --}}
                <div class="grid md:grid-cols-4 gap-4 mb-8">
                    @if($user->date_of_birth)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Âge</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($user->date_of_birth)->age }} ans</p>
                        </div>
                    @endif
                    @if($user->height)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Taille</p>
                            <p class="font-semibold">{{ $user->height }} cm</p>
                        </div>
                    @endif
                    @if($user->weight)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Poids</p>
                            <p class="font-semibold">{{ $user->weight }} kg</p>
                        </div>
                    @endif
                    @if($user->preferred_foot)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Pied fort</p>
                            <p class="font-semibold">{{ $user->preferred_foot }}</p>
                        </div>
                    @endif
                    @if($user->jersey_number)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Numéro</p>
                            <p class="font-semibold">{{ $user->jersey_number }}</p>
                        </div>
                    @endif
                </div>

                {{-- Statistiques --}}
                @if($user->season || $user->matches_played || $user->goals_scored || $user->assists)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-4">Statistiques {{ $user->season }}</h2>
                        <div class="grid grid-cols-3 gap-4">
                            @if($user->matches_played)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->matches_played }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Matchs</p>
                                </div>
                            @endif
                            @if($user->goals_scored)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->goals_scored }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Buts</p>
                                </div>
                            @endif
                            @if($user->assists)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->assists }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Passes D.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Bio --}}
                @if($user->bio)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">À propos</h2>
                        <p class="text-slate-300 leading-relaxed">{{ $user->bio }}</p>
                    </div>
                @endif

                {{-- Vidéo principale --}}
                @if($user->main_video_file || $user->main_video_url)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">Vidéo principale</h2>
                        <div class="aspect-video rounded-xl overflow-hidden bg-slate-800">
                            @if($user->main_video_file)
                                <video controls class="w-full h-full object-contain bg-black">
                                    <source src="{{ asset('storage/' . $user->main_video_file) }}">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            @elseif($user->main_video_url)
                                @if(str_contains($user->main_video_url, 'youtube.com') || str_contains($user->main_video_url, 'youtu.be'))
                                    @php
                                        $videoId = null;
                                        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $user->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        } elseif (preg_match('/youtu\.be\/([^?]+)/', $user->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    @if($videoId)
                                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                @else
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ $user->main_video_url }}" type="video/mp4">
                                    </video>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Objectifs --}}
                @if($user->goals && count($user->goals) > 0)
                    <div>
                        <h2 class="text-xl font-bold text-amber-400 mb-3">Objectifs</h2>
                        <ul class="space-y-2">
                            @foreach($user->goals as $goal)
                                <li class="flex items-center gap-2 text-slate-300">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    {{ $goal }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bouton d'édition si c'est le propriétaire --}}
        @auth
            @if(Auth::id() === $user->id)
                <div class="text-center">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Éditer mon profil
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection
