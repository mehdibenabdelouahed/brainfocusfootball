@extends('layouts.app')

@section('title', 'Nos Talents - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    
    {{-- NAVBAR --}}
    <header class="py-2 border-b border-slate-800 bg-slate-950 sticky top-0 z-[1000]">
        <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="/images/logoBFF.png" alt="Logo Brain Focus Football" class="w-14 h-14 object-contain">
                    <div class="leading-tight text-sm">
                        <p class="font-semibold text-[23px]">Brain Focus Football</p>
                        <p class="text-[12px] text-slate-400">Les champions commencent par l'esprit</p>
                    </div>
                </a>
            </div>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('articles.index') }}" class="hover:text-amber-400">Nos articles</a>
                <a href="{{ route('player.profile') }}" class="hover:text-amber-400 text-amber-400">Nos talents</a>
                <a href="{{ route('contact') }}" class="hover:text-amber-400">Contact</a>
            </nav>

            {{-- Auth Buttons / User Menu --}}
            <div class="flex items-center gap-2 text-xs">
                @auth
                    {{-- Menu utilisateur connecté --}}
                    <div class="relative">
                        <button id="userMenuButton" type="button" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 transition">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full object-cover">
                            @else
                                <div class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center text-slate-950 font-bold text-xs">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-slate-200">{{ Auth::user()->name }}</span>
                            <svg id="userMenuIcon" class="w-4 h-4 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        {{-- Dropdown menu --}}
                        <div id="userMenuDropdown" class="hidden absolute right-0 mt-2 w-56 bg-slate-800 border-2 border-amber-500/50 rounded-xl shadow-2xl" style="z-index: 9999;">
                            <div class="py-2">
                                <a href="{{ route('profile.show', Auth::id()) }}" class="block px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                                    Voir mon profil
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                                    Éditer mon profil
                                </a>
                                @if(!Auth::user()->profile_completed)
                                    <a href="{{ route('profile.create') }}" class="block px-4 py-3 text-sm text-amber-300 hover:bg-amber-500/20 transition font-semibold">
                                        Compléter mon profil
                                    </a>
                                @endif
                                <div class="border-t border-slate-600 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-500/20 transition font-semibold">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Menu dropdown toggle
                        document.addEventListener('DOMContentLoaded', function() {
                            const menuButton = document.getElementById('userMenuButton');
                            const menuDropdown = document.getElementById('userMenuDropdown');
                            const menuIcon = document.getElementById('userMenuIcon');

                            if (menuButton && menuDropdown) {
                                // Toggle menu on button click
                                menuButton.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    menuDropdown.classList.toggle('hidden');
                                    menuIcon.classList.toggle('rotate-180');
                                });

                                // Close menu when clicking outside
                                document.addEventListener('click', function(e) {
                                    if (!menuButton.contains(e.target) && !menuDropdown.contains(e.target)) {
                                        menuDropdown.classList.add('hidden');
                                        menuIcon.classList.remove('rotate-180');
                                    }
                                });
                            }
                        });
                    </script>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-3 py-1.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition bff-btn-main">
                        Créer un profil
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        {{-- En-tête --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">
                Nos Talents
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto">
                Découvrez les joueurs qui font confiance à Brain Focus Football pour développer leur carrière.
            </p>
        </div>

        {{-- Grille de joueurs --}}
        @if($players->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($players as $player)
                    <div class="group bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/10">
                        {{-- Photo de profil --}}
                        <div class="aspect-[4/3] overflow-hidden relative bg-slate-800">
                            @if($player->profile_photo)
                                <img src="{{ asset('storage/' . $player->profile_photo) }}" 
                                     alt="{{ $player->first_name }} {{ $player->last_name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-800 text-slate-600">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Badge Position --}}
                            @if($player->position)
                                <div class="absolute top-3 right-3 bg-slate-950/80 backdrop-blur-sm border border-slate-700 px-3 py-1 rounded-full">
                                    <span class="text-xs font-bold text-amber-400">{{ $player->position }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Informations --}}
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-white mb-1 group-hover:text-amber-400 transition-colors">
                                {{ $player->first_name }} {{ $player->last_name }}
                            </h3>
                            
                            <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-8a2 2 0 012-2h6.5l1 1H21l-3 6H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                </svg>
                                <span>{{ $player->current_club ?? 'Sans club' }}</span>
                            </div>

                            {{-- Stats rapides --}}
                            <div class="grid grid-cols-3 gap-2 mb-5 py-3 border-y border-slate-800">
                                <div class="text-center">
                                    <span class="block text-xs text-slate-500">Âge</span>
                                    <span class="font-semibold text-slate-300">
                                        {{ $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->age : '-' }}
                                    </span>
                                </div>
                                <div class="text-center border-l border-slate-800">
                                    <span class="block text-xs text-slate-500">Pied</span>
                                    <span class="font-semibold text-slate-300">
                                        {{ $player->preferred_foot ? substr($player->preferred_foot, 0, 1) : '-' }}
                                    </span>
                                </div>
                                <div class="text-center border-l border-slate-800">
                                    <span class="block text-xs text-slate-500">Taille</span>
                                    <span class="font-semibold text-slate-300">
                                        {{ $player->height ? $player->height . 'cm' : '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Bouton --}}
                            <a href="{{ route('profile.show', $player->id) }}" 
                               class="block w-full py-2.5 text-center rounded-xl bg-slate-800 hover:bg-amber-500 text-slate-300 hover:text-slate-950 font-semibold transition-all duration-300">
                                Voir le profil
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $players->links() }}
            </div>

        @else
            {{-- État vide --}}
            <div class="text-center py-20 bg-slate-900/30 rounded-3xl border border-slate-800 border-dashed">
                <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Aucun joueur trouvé</h3>
                <p class="text-slate-400 mb-6">Soyez le premier à créer votre profil !</p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                    Créer mon profil
                </a>
            </div>
        @endif
    </div>
    </div>
</div>
@endsection
