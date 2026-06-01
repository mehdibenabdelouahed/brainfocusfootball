@extends('layouts.app')

@section('title', 'Tarifs & Abonnements — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20" x-data="{ tab: '{{ Auth::check() && Auth::user()->isPlayer() ? 'joueur' : 'recruteur' }}' }">
    @include('partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Choisissez le plan qui <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-600">vous ressemble</span></h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">Que vous soyez joueur ou recruteur, Brain Focus Football a la formule adaptée à vos ambitions.</p>
            
            {{-- Toggle Recruteur / Joueur --}}
            <div class="mt-8 flex justify-center">
                <div class="bg-slate-900 border border-slate-800 p-1 rounded-xl inline-flex relative z-10">
                    <button @click="tab = 'recruteur'"
                        :class="tab === 'recruteur' ? 'bg-amber-500 text-slate-950' : 'text-slate-400 hover:text-white'"
                        class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300">
                        Pour les Recruteurs
                    </button>
                    <button @click="tab = 'joueur'"
                        :class="tab === 'joueur' ? 'bg-amber-500 text-slate-950' : 'text-slate-400 hover:text-white'"
                        class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300">
                        Pour les Joueurs
                    </button>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- Tarifs RECRUTEURS                         --}}
        {{-- ══════════════════════════════════════════ --}}
        <div x-show="tab === 'recruteur'"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

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

            {{-- Comparaison rapide Recruteurs --}}
            <div class="mt-16 max-w-5xl mx-auto">
                <h3 class="text-center text-lg font-bold mb-8 text-slate-300">Comparaison détaillée des offres Recruteur</h3>
                <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden overflow-x-auto">
                    <table class="w-full text-sm min-w-[750px]">
                        <thead>
                            <tr class="border-b border-slate-800">
                                <th class="text-left py-4 px-6 text-slate-400 font-medium">Fonctionnalité</th>
                                <th class="text-center py-4 px-4 text-slate-300 font-bold">Gratuit</th>
                                <th class="text-center py-4 px-4 text-amber-200 font-bold">Standard</th>
                                <th class="text-center py-4 px-4 text-amber-400 font-black bg-amber-500/5">PRO</th>
                                <th class="text-center py-4 px-4 text-indigo-400 font-bold">Académie</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Recherche de profils</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">Basique</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">Avancée (Radar)</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">Avancée (Radar)</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Avancée (Radar)</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Consultation de profils</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">5 / mois</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">50 / mois</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">Illimitée</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Illimitée</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Demandes de contact direct</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">10 / mois</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">Illimitées</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Illimitées</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Accès stats physiques & radars</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">Limité</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">Oui (si accord)</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Oui (si accord)</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Shortlists & Favoris</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Export PDF / CSV</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Membres de l'équipe (scouts)</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">1 scout</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">1 scout</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">1 scout</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Multi (jusqu'à 5)</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Dashboard Équipe</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Support client & API</td>
                                <td class="text-center py-3.5 px-4 text-slate-500 text-xs">Standard</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">Standard</td>
                                <td class="text-center py-3.5 px-4 text-amber-200 text-xs bg-amber-500/5">Prioritaire</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">Support Dédié + API</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CTA final recruteur --}}
            <div class="mt-12 text-center">
                <p class="text-slate-500 text-sm mb-4">Vous avez des besoins spécifiques pour votre club ou agence ?</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Demander une démo personnalisée
                </a>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- Tarifs JOUEURS                            --}}
        {{-- ══════════════════════════════════════════ --}}
        <div x-show="tab === 'joueur'" x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto items-start">

                {{-- JOUEUR GRATUIT --}}
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8 flex flex-col hover:border-slate-700 transition relative">
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-4">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Joueur
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Gratuit</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-black text-white">0€</span>
                            <span class="text-slate-500 text-sm">pour toujours</span>
                        </div>
                        <p class="text-sm text-slate-400 mt-3">Tout ce qu'il faut pour te lancer et te faire repérer.</p>
                    </div>

                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">Profil joueur complet</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Photo, vidéo, stats, bio, radar de compétences</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">Visibilité dans la galerie</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Ton profil visible par les recruteurs inscrits</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">Lien de partage public</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Envoie ton profil directement aux clubs et agents</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">Messagerie interne</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Réponds aux recruteurs qui te contactent</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">Accès aux articles</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Mental, nutrition, carrière, entourage…</p>
                            </div>
                        </div>

                        {{-- Fonctionnalités exclues --}}
                        <div class="pt-2 border-t border-slate-800/50 space-y-3">
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">Analytiques d'audience</span>
                            </div>
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">Badge Premium</span>
                            </div>
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">Mise en avant prioritaire</span>
                            </div>
                        </div>
                    </div>

                    @if(Auth::check() && Auth::user()->isPlayer() && !Auth::user()->isPremium())
                        <button disabled class="w-full py-3.5 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">Plan Actuel</button>
                    @elseif(Auth::check())
                        <span class="w-full py-3.5 text-center rounded-xl border border-slate-700 text-slate-400 font-bold">Inclus par défaut</span>
                    @else
                        <a href="{{ route('register') }}" class="w-full py-3.5 text-center rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 font-bold transition">Créer mon profil gratuitement</a>
                    @endif
                </div>

                {{-- JOUEUR PREMIUM --}}
                <div class="relative">
                    {{-- Glow effect --}}
                    <div class="absolute -inset-1 bg-gradient-to-tr from-amber-500/30 via-amber-600/20 to-orange-500/30 rounded-3xl blur-xl opacity-60"></div>

                    <div class="relative bg-gradient-to-b from-amber-900/30 to-slate-900 border-2 border-amber-500 rounded-2xl p-8 flex flex-col shadow-2xl shadow-amber-900/20">
                        {{-- Badge --}}
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-950 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest flex items-center gap-1.5 shadow-lg shadow-amber-500/30">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            Recommandé
                        </div>

                        <div class="mb-8">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-[10px] font-bold uppercase tracking-widest mb-4">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                Profil Premium
                            </div>
                            <h3 class="text-2xl font-black text-amber-400 mb-2">Premium</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-black text-white">4,99€</span>
                                <span class="text-amber-500/60 text-sm">/ mois</span>
                            </div>
                            <p class="text-sm text-amber-200/80 mt-3">Maximise ta visibilité et prends le contrôle de ta carrière.</p>
                        </div>

                        <div class="flex-1 space-y-4 mb-8">
                            {{-- Inclus du plan gratuit --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">Tout le plan Gratuit inclus</span>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Profil, galerie, messagerie, articles…</p>
                                </div>
                            </div>

                            <div class="h-px bg-slate-800/60 my-2"></div>

                            {{-- Fonctionnalités Premium --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">Analytiques d'audience</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">Vois qui consulte ton profil : nombre de vues, recruteurs intéressés, favoris reçus</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold flex items-center gap-2">
                                        Badge Premium
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 border border-amber-500/30 text-amber-400 text-[9px] font-black uppercase">
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            PRO
                                        </span>
                                    </span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">Distingue-toi des autres joueurs avec un badge visible sur ton profil et dans la galerie</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">Mise en avant prioritaire</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">Ton profil apparaît en haut des résultats de recherche des recruteurs</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">Contenu exclusif</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">Articles avancés, coaching mental, exercices de préparation pro</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">Vidéos supplémentaires</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">Ajoute jusqu'à 5 vidéos secondaires à ton profil</p>
                                </div>
                            </div>
                        </div>

                        @if(Auth::check() && Auth::user()->isPlayer() && Auth::user()->isPremium())
                            <button disabled class="w-full py-3.5 rounded-xl bg-amber-500 text-slate-950 font-black cursor-not-allowed">Plan Actuel ★</button>
                        @else
                            <a href="{{ route('checkout', ['plan' => 'PREMIUM']) }}" class="w-full py-3.5 text-center rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black transition shadow-lg shadow-amber-500/20 active:scale-[0.98]">
                                Passer Premium — 4,99€/mois
                            </a>
                        @endif

                        {{-- Garantie --}}
                        <p class="text-center text-[10px] text-amber-200/40 mt-4 flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Sans engagement · Annulable à tout moment
                        </p>
                    </div>
                </div>

            </div>

            {{-- Comparaison rapide --}}
            <div class="mt-16 max-w-4xl mx-auto">
                <h3 class="text-center text-lg font-bold mb-8 text-slate-300">Comparaison détaillée</h3>
                <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-800">
                                <th class="text-left py-4 px-6 text-slate-400 font-medium">Fonctionnalité</th>
                                <th class="text-center py-4 px-4 text-slate-300 font-bold">Gratuit</th>
                                <th class="text-center py-4 px-4">
                                    <span class="text-amber-400 font-black">Premium</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Profil joueur complet</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Visibilité dans la galerie</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">Prioritaire ★</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Lien de partage public</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Messagerie interne</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Vidéo principale</td>
                                <td class="text-center py-3.5 px-4"><span class="text-slate-400 text-xs">1 vidéo</span></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">1 + 5 secondaires</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">Accès aux articles</td>
                                <td class="text-center py-3.5 px-4"><span class="text-slate-400 text-xs">Standards</span></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">Standards + Exclusifs</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Analytiques d'audience</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Badge Premium</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Mise en avant prioritaire</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">Contenu exclusif</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CTA final joueur --}}
            <div class="mt-12 text-center">
                <p class="text-slate-500 text-sm mb-4">Tu as une question sur nos offres joueurs ?</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Contacte-nous
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
