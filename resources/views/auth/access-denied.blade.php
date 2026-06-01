@extends('layouts.app')

@section('title', 'Accès refusé — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white flex items-center justify-center px-4">
    <div class="max-w-lg w-full text-center">
        {{-- Icône verrou animé --}}
        <div class="relative mx-auto w-24 h-24 mb-8">
            <div class="absolute inset-0 bg-amber-500/20 rounded-full blur-xl animate-pulse"></div>
            <div class="relative w-24 h-24 bg-slate-900 border-2 border-amber-500/50 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl sm:text-4xl font-black mb-4">
            Accès <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-600">réservé</span>
        </h1>
        <p class="text-slate-400 text-sm sm:text-base mb-8 max-w-md mx-auto leading-relaxed">
            Cette page est réservée aux utilisateurs connectés. 
            Inscrivez-vous gratuitement ou connectez-vous pour accéder à notre galerie de talents, 
            aux profils complets et bien plus encore.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('register') }}" 
               class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition shadow-lg shadow-amber-500/20 active:scale-95">
                Créer un compte gratuit
            </a>
            <a href="{{ route('login') }}" 
               class="px-6 py-3 rounded-xl bg-slate-900 border border-slate-700 hover:border-amber-500/50 text-slate-300 hover:text-white font-bold text-sm transition">
                J'ai déjà un compte
            </a>
        </div>

        {{-- Retour accueil --}}
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 text-xs mt-8 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection
