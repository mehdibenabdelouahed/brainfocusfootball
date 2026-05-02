@extends('layouts.app')

@section('title', 'Dashboard Recruteur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-16">
    
    {{-- Hero Section --}}
    <div class="relative pt-28 pb-16 overflow-hidden border-b border-slate-800/60">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950/60 via-slate-950 to-slate-950"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-64 bg-indigo-500/10 rounded-full blur-[120px]"></div>
        <div class="container relative mx-auto px-4 max-w-7xl">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="inline-block px-3 py-1 rounded-full bg-indigo-500/15 text-indigo-400 text-xs font-bold border border-indigo-500/25 mb-4 uppercase tracking-wider">
                        Espace Recruteur Pro
                    </span>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-3">
                        Bonjour, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">{{ $user->name }}</span> 👋
                    </h1>
                    <p class="text-slate-400 text-lg max-w-2xl">Votre centre de commandement pour découvrir, analyser et suivre les meilleurs talents du football.</p>
                </div>
                <div class="flex gap-3 flex-shrink-0">
                    @php
                        $unreadMsgCount = Auth::user()->recruiterConversations()
                            ->with(['messages' => fn($q) => $q->where('sender_id', '!=', Auth::id())->where('is_read', false)])
                            ->get()->sum(fn($conv) => $conv->messages->count());
                    @endphp
                    <a href="{{ route('messages.index') }}" class="relative px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Messagerie
                        @if($unreadMsgCount > 0)
                            <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] bg-amber-500 text-slate-950 text-[9px] font-black rounded-full flex items-center justify-center px-1">{{ $unreadMsgCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('talents') }}" class="px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Voir tous les talents
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-7xl py-10 space-y-10">

        {{-- Recherche Avancée --}}
        <div class="bg-slate-900/70 backdrop-blur-md rounded-3xl border border-slate-700/50 p-8 shadow-2xl">
            <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                <div class="p-2 bg-indigo-500/15 rounded-xl text-indigo-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                Recherche & Filtres Avancés
            </h2>
            
            <form action="{{ route('talents') }}" method="GET">
                {{-- Ligne 1: critères de base --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">Nom / Club</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ex: Mohamed, AS Monaco..." 
                               class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">Poste</label>
                        <select name="position" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition">
                            <option value="">Tous les postes</option>
                            @foreach(['Gardien', 'Défenseur', 'Milieu', 'Attaquant'] as $pos)
                                <option value="{{ $pos }}" {{ request('position') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">Catégorie d'âge</label>
                        <select name="age_group" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition">
                            <option value="">Toutes les catégories</option>
                            @foreach(['U15', 'U17', 'U19', 'Senior'] as $g)
                                <option value="{{ $g }}" {{ request('age_group') == $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">Niveau</label>
                        <select name="level" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition">
                            <option value="">Tous les niveaux</option>
                            @foreach(['Régional', 'National', 'Élite', 'Académie'] as $l)
                                <option value="{{ $l }}" {{ request('level') == $l ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Ligne 2: scores radar --}}
                <div class="border-t border-slate-800 pt-6 mb-6">
                    <p class="text-xs font-bold text-slate-400 mb-4 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Scores Radar Minimum (Recherche Avancée)
                    </p>
                    
                    @if(in_array(Auth::user()->recruiterPlan(), ['STANDARD', 'PRO', 'ACADEMIE']))
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                            @foreach([
                                ['param' => 'mental_min', 'label' => 'Mental'],
                                ['param' => 'physical_min', 'label' => 'Physique'],
                                ['param' => 'technical_min', 'label' => 'Technique'],
                                ['param' => 'speed_min', 'label' => 'Vitesse'],
                                ['param' => 'vision_min', 'label' => 'Vision'],
                                ['param' => 'social_min', 'label' => 'Social'],
                            ] as $field)
                                <div>
                                    <label class="block text-xs text-slate-500 mb-2">{{ $field['label'] }} min</label>
                                    <div class="relative">
                                        <input type="number" name="{{ $field['param'] }}" min="0" max="100" value="{{ request($field['param']) }}"
                                               placeholder="0"
                                               class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition pr-10">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs font-bold">/100</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div>
                                <h3 class="text-white font-bold mb-1">Débloquez la recherche par Radar</h3>
                                <p class="text-sm text-slate-400">Passez au plan Standard ou Pro pour trouver des joueurs selon leurs notes techniques, physiques ou mentales.</p>
                            </div>
                            <a href="{{ route('pricing') }}" class="shrink-0 px-6 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-600 text-white text-sm font-bold rounded-lg transition">
                                Voir les Tarifs
                            </a>
                        </div>
                    @endif
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Rechercher
                    </button>
                    <a href="{{ route('talents') }}" class="px-8 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold transition">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        {{-- Mes Favoris --}}
        @php
            $favorites = $user->recruiter ? $user->recruiter->favoritePlayers()->with('user')->get() : collect();
        @endphp

        <div class="bg-slate-900/70 backdrop-blur-md rounded-3xl border border-slate-700/50 p-8 shadow-2xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold flex items-center gap-3">
                    <div class="p-2 bg-amber-500/15 rounded-xl text-amber-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    Mes Joueurs en Favori
                    <span class="px-2.5 py-1 bg-amber-500/15 text-amber-400 text-sm font-bold rounded-full">{{ $favorites->count() }}</span>
                </h2>
                @if($favorites->count() > 0)
                    <a href="{{ route('talents') }}" class="text-sm text-slate-400 hover:text-white transition">Voir tous les talents →</a>
                @endif
            </div>

            @if($favorites->isEmpty())
                <div class="text-center py-12 border-2 border-dashed border-slate-800 rounded-2xl">
                    <svg class="w-12 h-12 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    <p class="text-slate-400 font-medium mb-2">Aucun favori pour l'instant</p>
                    <p class="text-slate-500 text-sm mb-6">Naviguez dans la galerie des talents et cliquez sur ⭐ pour sauvegarder un joueur ici.</p>
                    <a href="{{ route('talents') }}" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold transition inline-block">
                        Découvrir les talents →
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($favorites as $favPlayer)
                        @php $favUser = $favPlayer->user; @endphp
                        @if(!$favUser) @continue @endif
                        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden hover:border-amber-500/40 transition group">
                            <div class="aspect-[3/2] relative overflow-hidden bg-slate-800">
                                @if($favPlayer->profile_photo)
                                    <img src="{{ asset('storage/' . $favPlayer->profile_photo) }}" alt="{{ $favPlayer->first_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-700 to-slate-800 text-amber-400 font-black text-4xl">
                                        {{ strtoupper(substr($favPlayer->first_name ?? 'J', 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 bg-amber-500 text-slate-950 text-[10px] font-black px-2 py-1 rounded-full">
                                    ⭐ Favori
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="font-bold text-white mb-1">{{ $favPlayer->first_name }} {{ $favPlayer->last_name }}</p>
                                <p class="text-xs text-slate-400 mb-3">{{ $favPlayer->position ?? 'N/A' }} • {{ $favPlayer->current_club ?? 'Sans club' }}</p>
                                <a href="{{ route('profile.show', $favUser->id) }}" class="block w-full text-center py-2 rounded-xl bg-slate-700 hover:bg-amber-500 hover:text-slate-950 text-sm font-semibold text-slate-300 transition">
                                    Voir le profil
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Stats Rapides --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-900/70 border border-slate-700/50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-black text-indigo-400 mb-1">{{ $favorites->count() }}</p>
                <p class="text-slate-400">Talents en favori</p>
            </div>
            <div class="bg-slate-900/70 border border-slate-700/50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-black text-amber-400 mb-1">{{ $user->recruiter->subscription_tier ?? 'FREE' }}</p>
                <p class="text-slate-400">Plan actuel</p>
            </div>
            <div class="bg-gradient-to-br from-indigo-900/50 to-slate-900/70 border border-indigo-500/30 rounded-2xl p-6 flex flex-col justify-center items-center text-center">
                <p class="text-sm text-indigo-300 font-semibold mb-2">Accès complet</p>
                <p class="text-slate-400 text-sm">Galerie + Filtres Radar + Favoris + Notifications</p>
            </div>
        </div>

    </div>
</div>
@endsection
