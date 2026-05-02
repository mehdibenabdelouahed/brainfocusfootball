@extends('layouts.app')

@section('title', 'Tarifs & Abonnements — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20">
    @include('partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Investissez dans <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-600">votre futur</span></h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">Découvrez des outils exclusifs pour analyser vos performances ou détecter les meilleurs talents de demain.</p>
            
            <div class="mt-8 flex justify-center">
                <div class="bg-slate-900 border border-slate-800 p-1 rounded-xl inline-flex relative z-10">
                    <button class="px-6 py-2 rounded-lg text-sm font-bold bg-amber-500 text-slate-950 transition">Pour les Recruteurs</button>
                    <button class="px-6 py-2 rounded-lg text-sm font-semibold text-slate-400 hover:text-white transition">Pour les Joueurs</button>
                </div>
            </div>
        </div>

        {{-- Tarifs RECRUTEURS --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            
            {{-- GRATUIT --}}
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col hover:border-slate-700 transition">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-slate-300 mb-2">Gratuit</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-white">0€</span>
                        <span class="text-slate-500 text-sm">/ mois</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Idéal pour découvrir la plateforme.</p>
                </div>
                <div class="flex-1 space-y-4 mb-8">
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Recherche basique</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Consultation 5 profils/mois</span></div>
                    <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">Contact direct</span></div>
                    <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">Recherche avancée (Radar)</span></div>
                </div>
                @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'GRATUIT')
                    <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">Plan Actuel</button>
                @else
                    <a href="{{ route('checkout', ['plan' => 'GRATUIT']) }}" class="w-full py-3 text-center rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 font-bold transition">Choisir ce plan</a>
                @endif
            </div>

            {{-- STANDARD --}}
            <div class="bg-slate-900 border border-slate-700 hover:border-amber-500/50 rounded-2xl p-6 flex flex-col transition relative group">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-amber-200 mb-2">Standard</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-white">29€</span>
                        <span class="text-slate-500 text-sm">/ mois</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Pour les agents indépendants.</p>
                </div>
                <div class="flex-1 space-y-4 mb-8">
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Recherche avancée (Radar)</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Consultation 50 profils/mois</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">10 demandes contact/mois</span></div>
                    <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">Alertes Favoris</span></div>
                </div>
                @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'STANDARD')
                    <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">Plan Actuel</button>
                @else
                    <a href="{{ route('checkout', ['plan' => 'STANDARD']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white group-hover:bg-amber-600 font-bold transition">Choisir Standard</a>
                @endif
            </div>

            {{-- PRO --}}
            <div class="bg-gradient-to-b from-amber-900/40 to-slate-900 border-2 border-amber-500 rounded-2xl p-6 flex flex-col relative scale-105 z-10 shadow-2xl shadow-amber-900/20">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-amber-500 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                    Le plus populaire
                </div>
                <div class="mb-6">
                    <h3 class="text-xl font-black text-amber-400 mb-2">PRO</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl font-black text-white">79€</span>
                        <span class="text-amber-500/50 text-sm">/ mois</span>
                    </div>
                    <p class="text-xs text-amber-200 mt-2">Le standard des clubs professionnels.</p>
                </div>
                <div class="flex-1 space-y-4 mb-8">
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">Profils & Contacts illimités</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">Accès Stats physiques (si accord)</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">Shortlists & Favoris</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">Export CSV/PDF</span></div>
                </div>
                @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'PRO')
                    <button disabled class="w-full py-3 rounded-xl bg-amber-500 text-slate-950 font-black cursor-not-allowed">Plan Actuel</button>
                @else
                    <a href="{{ route('checkout', ['plan' => 'PRO']) }}" class="w-full py-3 text-center rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black transition">Passer PRO</a>
                @endif
            </div>

            {{-- ACADÉMIE --}}
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col hover:border-indigo-500 transition relative">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-indigo-400 mb-2">Académie</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-white">199€</span>
                        <span class="text-slate-500 text-sm">/ mois</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Pour les staffs techniques complets.</p>
                </div>
                <div class="flex-1 space-y-4 mb-8">
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Fonctionnalités PRO incluses</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Multi-utilisateurs (5 scouts)</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Dashboard Équipe</span></div>
                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">Support Prioritaire & API</span></div>
                </div>
                @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'ACADEMIE')
                    <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">Plan Actuel</button>
                @else
                    <a href="{{ route('checkout', ['plan' => 'ACADEMIE']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white hover:bg-indigo-600 font-bold transition">Contacter les Ventes</a>
                @endif
            </div>

        </div>

        {{-- Tarifs JOUEURS --}}
        <div class="mt-20 max-w-3xl mx-auto hidden" id="playerPricing">
            {{-- TODO: Javascript to toggle visibility between Recruiter and Player plans --}}
        </div>

    </div>
</div>
@endsection
