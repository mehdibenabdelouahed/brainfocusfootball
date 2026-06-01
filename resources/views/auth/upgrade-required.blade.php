@extends('layouts.app')

@section('title', 'Mise à niveau requise — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white flex items-center justify-center px-4">
    <div class="max-w-lg w-full text-center">
        {{-- Icône upgrade --}}
        <div class="relative mx-auto w-24 h-24 mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/20 to-sky-500/20 rounded-full blur-xl animate-pulse"></div>
            <div class="relative w-24 h-24 bg-slate-900 border-2 border-amber-500/50 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl sm:text-4xl font-black mb-4">
            Passez au <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-600">niveau supérieur</span>
        </h1>
        <p class="text-slate-400 text-sm sm:text-base mb-4 max-w-md mx-auto leading-relaxed">
            Cette fonctionnalité nécessite un abonnement supérieur à votre plan actuel.
        </p>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6 text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @auth
            @php
                $plan = Auth::user()->recruiterPlan();
                $planColors = [
                    'GRATUIT' => 'text-slate-400',
                    'STANDARD' => 'text-sky-400',
                    'PRO' => 'text-amber-400',
                    'ACADEMIE' => 'text-indigo-400',
                ];
            @endphp
            <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 mb-8 inline-block">
                <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Votre plan actuel</p>
                <p class="text-lg font-black {{ $planColors[$plan] ?? 'text-slate-300' }}">{{ $plan }}</p>
            </div>
        @endauth

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('pricing') }}" 
               class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition shadow-lg shadow-amber-500/20 active:scale-95">
                Voir les tarifs
            </a>
            <a href="{{ url()->previous() }}" 
               class="px-6 py-3 rounded-xl bg-slate-900 border border-slate-700 hover:border-amber-500/50 text-slate-300 hover:text-white font-bold text-sm transition">
                Retour
            </a>
        </div>

        {{-- Features du plan supérieur --}}
        <div class="mt-12 bg-slate-900/30 border border-slate-800 rounded-2xl p-6 text-left">
            <h3 class="text-sm font-bold text-amber-400 uppercase tracking-widest mb-4">Ce que vous débloquez</h3>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm text-slate-300">Consultation illimitée de profils joueurs</span>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm text-slate-300">Recherche avancée avec filtres Radar</span>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm text-slate-300">Contact direct avec les joueurs</span>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm text-slate-300">Comparateur de talents & Shortlists</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
