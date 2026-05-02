@extends('layouts.app')

@section('title', 'Espace Tuteur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white px-4 py-12">
    <div class="max-w-5xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Espace Tuteur Légal</h1>
            <p class="text-slate-400">Gérez le profil et les autorisations de votre enfant mineur.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-xl p-4">
                <p class="text-green-400 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @php
            $guardianRecord = $user->guardian;
            $child = $guardianRecord ? $guardianRecord->player : null;
            $childUser = $child ? $child->user : null;
        @endphp

        @if($child && $childUser)
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        @if($child->profile_photo)
                            <img src="{{ asset('storage/' . $child->profile_photo) }}" alt="Photo de {{ $childUser->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-amber-500">
                        @else
                            <div class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center text-amber-500 font-bold text-xl border-2 border-slate-700">
                                {{ substr($childUser->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h2 class="text-xl font-bold">{{ $child->first_name ?? $childUser->name }} {{ $child->last_name }}</h2>
                            <p class="text-slate-400 text-sm">{{ $child->position ?? 'Joueur' }} • {{ $child->current_club ?? 'Sans club' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                        <a href="{{ route('medical.edit') }}" class="px-4 py-2 rounded-lg border border-emerald-700/50 hover:border-emerald-400 bg-emerald-950/30 text-sm text-emerald-400 font-semibold transition flex items-center gap-2" title="Gérer le dossier médical de votre enfant (Chiffré AES-256)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Dossier Médical
                        </a>
                        <a href="{{ route('profile.show', $childUser->id) }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm font-semibold transition border border-slate-700">
                            Voir le profil public
                        </a>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Consentement et Sécurité (RGPD)
                    </h3>
                    
                    @if(!$guardianRecord->consent_given)
                        <div class="bg-amber-500/10 border border-amber-500/30 rounded-xl p-5 mb-6">
                            <h4 class="text-amber-400 font-bold mb-2">Action requise : Autorisation parentale</h4>
                            <p class="text-sm text-slate-300 mb-4 leading-relaxed">
                                Conformément à notre politique de protection des mineurs et au RGPD, vous devez explicitement autoriser la création du profil public de votre enfant et le traitement de ses données sportives. Sans cette autorisation, le profil de votre enfant sera invisible pour les recruteurs.
                            </p>
                            
                            <form action="{{ route('guardian.approve') }}" method="POST">
                                @csrf
                                <div class="flex items-start gap-3 mb-4">
                                    <input type="checkbox" id="consent" name="consent" required class="mt-1 w-4 h-4 rounded border-slate-600 text-amber-500 focus:ring-amber-500 bg-slate-900">
                                    <label for="consent" class="text-sm text-slate-200">
                                        J'accepte les Conditions Générales d'Utilisation et j'autorise Brain Focus Football à stocker et afficher les données sportives de mon enfant ({{ $childUser->name }}) à des fins de recrutement.
                                    </label>
                                </div>
                                <button type="submit" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                                    Donner mon consentement
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-5 mb-6 flex items-start gap-4">
                            <div class="bg-green-500/20 p-2 rounded-full mt-1">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-green-400 font-bold mb-1">Consentement accordé</h4>
                                <p class="text-sm text-slate-300">
                                    Vous avez donné votre autorisation le {{ $guardianRecord->consent_date ? $guardianRecord->consent_date->format('d/m/Y à H:i') : 'Récemment' }}. Le profil de votre enfant peut désormais être publié.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Statistiques rapides de l'enfant --}}
                @if($child->matches_played || $child->goals_scored || $child->assists)
                    <div class="mt-8 pt-8 border-t border-slate-800">
                        <h3 class="text-lg font-bold mb-4">Aperçu sportif ({{ $child->season ?? 'Saison en cours' }})</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                <p class="text-2xl font-bold text-amber-400">{{ $child->matches_played ?? 0 }}</p>
                                <p class="text-slate-400 text-xs mt-1">Matchs</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                <p class="text-2xl font-bold text-amber-400">{{ $child->goals_scored ?? 0 }}</p>
                                <p class="text-slate-400 text-xs mt-1">Buts</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                <p class="text-2xl font-bold text-amber-400">{{ $child->assists ?? 0 }}</p>
                                <p class="text-slate-400 text-xs mt-1">Passes D.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8 text-center">
                <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <h2 class="text-xl font-bold mb-2">Aucun joueur associé</h2>
                <p class="text-slate-400">Il semble que votre compte ne soit lié à aucun profil de joueur pour le moment.</p>
            </div>
        @endif

    </div>
</div>
@endsection
