@extends('layouts.app')

@section('title', __('pricing.meta_title'))

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20" x-data="{ tab: '{{ Auth::check() && Auth::user()->isPlayer() ? 'joueur' : 'recruteur' }}' }">
    @include('partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black mb-4">{!! __('pricing.header') !!}</h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">{{ __('pricing.subheader') }}</p>
            
            {{-- Toggle Recruteur / Joueur --}}
            <div class="mt-8 flex justify-center">
                <div class="bg-slate-900 border border-slate-800 p-1 rounded-xl inline-flex relative z-10">
                    <button @click="tab = 'recruteur'"
                        :class="tab === 'recruteur' ? 'bg-amber-500 text-slate-950' : 'text-slate-400 hover:text-white'"
                        class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300">
                        {{ __('pricing.tab_recruiters') }}
                    </button>
                    <button @click="tab = 'joueur'"
                        :class="tab === 'joueur' ? 'bg-amber-500 text-slate-950' : 'text-slate-400 hover:text-white'"
                        class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300">
                        {{ __('pricing.tab_players') }}
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
                        <h3 class="text-xl font-bold text-slate-300 mb-2">{{ __('pricing.free') }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-white">0€</span>
                            <span class="text-slate-500 text-sm">{{ __('pricing.per_month') }}</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">{{ __('pricing.free_tagline_recruiter') }}</p>
                    </div>
                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_basic_search') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_consultation_5_monthly') }}</span></div>
                        <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_direct_contact') }}</span></div>
                        <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_radar_search') }}</span></div>
                    </div>
                    @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'GRATUIT')
                        <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">{{ __('pricing.current_plan') }}</button>
                    @else
                        <a href="{{ route('checkout', ['plan' => 'GRATUIT']) }}" class="w-full py-3 text-center rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 font-bold transition">{{ __('pricing.choose_plan') }}</a>
                    @endif
                </div>

                {{-- STANDARD --}}
                <div class="bg-slate-900 border border-slate-700 hover:border-amber-500/50 rounded-2xl p-6 flex flex-col transition relative group">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-amber-200 mb-2">{{ __('pricing.standard') }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-white">29€</span>
                            <span class="text-slate-500 text-sm">{{ __('pricing.per_month') }}</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">{{ __('pricing.standard_tagline_recruiter') }}</p>
                    </div>
                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_radar_search') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_consultation_50_monthly') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_10_contacts_monthly') }}</span></div>
                        <div class="flex items-start gap-3 opacity-50"><svg class="w-5 h-5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg><span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_favorite_alerts') }}</span></div>
                    </div>
                    @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'STANDARD')
                        <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">{{ __('pricing.current_plan') }}</button>
                    @else
                        <a href="{{ route('checkout', ['plan' => 'STANDARD']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white group-hover:bg-amber-600 font-bold transition">{{ __('pricing.choose_standard') }}</a>
                    @endif
                </div>

                {{-- PRO --}}
                <div class="bg-gradient-to-b from-amber-900/40 to-slate-900 border-2 border-amber-500 rounded-2xl p-6 flex flex-col relative scale-105 z-10 shadow-2xl shadow-amber-900/20">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-amber-500 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                        {{ __('pricing.most_popular') }}
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-black text-amber-400 mb-2">{{ __('pricing.pro') }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-black text-white">79€</span>
                            <span class="text-amber-500/50 text-sm">{{ __('pricing.per_month') }}</span>
                        </div>
                        <p class="text-xs text-amber-200 mt-2">{{ __('pricing.pro_tagline_recruiter') }}</p>
                    </div>
                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">{{ __('pricing.feature_unlimited_profiles_contacts') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">{{ __('pricing.feature_physical_stats_access') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">{{ __('pricing.feature_shortlists_favorites') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm font-semibold text-white">{{ __('pricing.feature_export') }}</span></div>
                    </div>
                    @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'PRO')
                        <button disabled class="w-full py-3 rounded-xl bg-amber-500 text-slate-950 font-black cursor-not-allowed">{{ __('pricing.current_plan') }}</button>
                    @else
                        <a href="{{ route('checkout', ['plan' => 'PRO']) }}" class="w-full py-3 text-center rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black transition">{{ __('pricing.upgrade_pro') }}</a>
                    @endif
                </div>

                {{-- ACADÉMIE --}}
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col hover:border-indigo-500 transition relative">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-indigo-400 mb-2">{{ __('pricing.academy') }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-white">199€</span>
                            <span class="text-slate-500 text-sm">{{ __('pricing.per_month') }}</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">{{ __('pricing.academy_tagline_recruiter') }}</p>
                    </div>
                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_pro_included') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_multi_user') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_team_dashboard') }}</span></div>
                        <div class="flex items-start gap-3"><svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm text-slate-300">{{ __('pricing.feature_dedicated_support_api') }}</span></div>
                    </div>
                    @if(Auth::check() && Auth::user()->isRecruiter() && Auth::user()->recruiterPlan() === 'ACADEMIE')
                        <button disabled class="w-full py-3 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">{{ __('pricing.current_plan') }}</button>
                    @else
                        <a href="{{ route('checkout', ['plan' => 'ACADEMIE']) }}" class="w-full py-3 text-center rounded-xl bg-slate-800 text-white hover:bg-indigo-600 font-bold transition">{{ __('pricing.contact_sales') }}</a>
                    @endif
                </div>

            </div>

            {{-- Comparaison rapide Recruteurs --}}
            <div class="mt-16 max-w-5xl mx-auto">
                <h3 class="text-center text-lg font-bold mb-8 text-slate-300">{{ __('pricing.detailed_comparison_recruiter') }}</h3>
                <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden overflow-x-auto">
                    <table class="w-full text-sm min-w-[750px]">
                        <thead>
                            <tr class="border-b border-slate-800">
                                <th class="text-left py-4 px-6 text-slate-400 font-medium">{{ __('pricing.feature_label') }}</th>
                                <th class="text-center py-4 px-4 text-slate-300 font-bold">{{ __('pricing.free') }}</th>
                                <th class="text-center py-4 px-4 text-amber-200 font-bold">{{ __('pricing.standard') }}</th>
                                <th class="text-center py-4 px-4 text-amber-400 font-black bg-amber-500/5">{{ __('pricing.pro') }}</th>
                                <th class="text-center py-4 px-4 text-indigo-400 font-bold">{{ __('pricing.academy') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.search_profiles') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">{{ __('pricing.val_basic') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">{{ __('pricing.val_advanced') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">{{ __('pricing.val_advanced') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_advanced') }}</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.view_profiles') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">{{ __('pricing.val_5_monthly') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">{{ __('pricing.val_50_monthly') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">{{ __('pricing.val_unlimited') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_unlimited') }}</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.direct_contact_requests') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">{{ __('pricing.val_10_monthly') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">{{ __('pricing.val_unlimited_plural') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_unlimited_plural') }}</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.physical_stats_radars_access') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">{{ __('pricing.val_limited') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">{{ __('pricing.val_yes_agreement') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_yes_agreement') }}</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_shortlists_favorites') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_export') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.team_members') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">{{ __('pricing.val_1_scout') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-300 text-xs">{{ __('pricing.val_1_scout') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-400 font-bold text-xs bg-amber-500/5">{{ __('pricing.val_1_scout') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_multi_5') }}</td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_team_dashboard') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4 bg-amber-500/5"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.support_api') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-500 text-xs">{{ __('pricing.val_standard') }}</td>
                                <td class="text-center py-3.5 px-4 text-slate-400 text-xs">{{ __('pricing.val_standard') }}</td>
                                <td class="text-center py-3.5 px-4 text-amber-200 text-xs bg-amber-500/5">{{ __('pricing.val_priority') }}</td>
                                <td class="text-center py-3.5 px-4 text-indigo-400 font-bold text-xs">{{ __('pricing.val_dedicated_api') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CTA final recruteur --}}
            <div class="mt-12 text-center">
                <p class="text-slate-500 text-sm mb-4">{{ __('pricing.custom_needs') }}</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    {{ __('pricing.request_custom_demo') }}
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
                            {{ __('pricing.tab_players') }}
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ __('pricing.free') }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-black text-white">0€</span>
                            <span class="text-slate-500 text-sm">{{ __('pricing.forever') }}</span>
                        </div>
                        <p class="text-sm text-slate-400 mt-3">{{ __('pricing.free_tagline_player') }}</p>
                    </div>

                    <div class="flex-1 space-y-4 mb-8">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">{{ __('pricing.feature_full_player_profile') }}</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_profile_sub') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">{{ __('pricing.feature_gallery_visibility') }}</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_gallery_sub') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">{{ __('pricing.feature_public_share_link') }}</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_share_sub') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">{{ __('pricing.feature_internal_messaging') }}</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_messaging_sub') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <span class="text-sm text-white font-medium">{{ __('pricing.feature_articles_access') }}</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_articles_sub') }}</p>
                            </div>
                        </div>

                        {{-- Fonctionnalités exclues --}}
                        <div class="pt-2 border-t border-slate-800/50 space-y-3">
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_audience_analytics') }}</span>
                            </div>
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_premium_badge') }}</span>
                            </div>
                            <div class="flex items-start gap-3 opacity-50">
                                <svg class="w-5 h-5 text-slate-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-slate-500 line-through">{{ __('pricing.feature_priority_placement') }}</span>
                            </div>
                        </div>
                    </div>

                    @if(Auth::check() && Auth::user()->isPlayer() && !Auth::user()->isPremium())
                        <button disabled class="w-full py-3.5 rounded-xl bg-slate-800 text-slate-500 font-bold cursor-not-allowed">{{ __('pricing.current_plan') }}</button>
                    @elseif(Auth::check())
                        <span class="w-full py-3.5 text-center rounded-xl border border-slate-700 text-slate-400 font-bold">{{ __('pricing.included_by_default') }}</span>
                    @else
                        <a href="{{ route('register') }}" class="w-full py-3.5 text-center rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 font-bold transition">{{ __('pricing.create_free_profile') }}</a>
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
                            {{ __('pricing.recommended') }}
                        </div>

                        <div class="mb-8">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-[10px] font-bold uppercase tracking-widest mb-4">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                {{ __('pricing.feature_premium_badge') }}
                            </div>
                            <h3 class="text-2xl font-black text-amber-400 mb-2">{{ __('pricing.premium') }}</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-black text-white">4,99€</span>
                                <span class="text-amber-500/60 text-sm">{{ __('pricing.per_month') }}</span>
                            </div>
                            <p class="text-sm text-amber-200/80 mt-3">{{ __('pricing.premium_tagline_player') }}</p>
                        </div>

                        <div class="flex-1 space-y-4 mb-8">
                            {{-- Inclus du plan gratuit --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">{{ __('pricing.feature_free_included') }}</span>
                                    <p class="text-[11px] text-slate-500 mt-0.5">{{ __('pricing.feature_free_included_sub') }}</p>
                                </div>
                            </div>

                            <div class="h-px bg-slate-800/60 my-2"></div>

                            {{-- Fonctionnalités Premium --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">{{ __('pricing.feature_audience_analytics') }}</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">{{ __('pricing.feature_audience_analytics_sub') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold flex items-center gap-2">
                                        {{ __('pricing.feature_premium_badge') }}
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 border border-amber-500/30 text-amber-400 text-[9px] font-black uppercase">
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            PRO
                                        </span>
                                    </span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">{{ __('pricing.feature_premium_badge_sub') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">{{ __('pricing.feature_priority_placement') }}</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">{{ __('pricing.feature_priority_placement_sub') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">{{ __('pricing.feature_exclusive_content') }}</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">{{ __('pricing.feature_exclusive_content_sub') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <div>
                                    <span class="text-sm text-white font-semibold">{{ __('pricing.feature_additional_videos') }}</span>
                                    <p class="text-[11px] text-amber-200/60 mt-0.5">{{ __('pricing.feature_additional_videos_sub') }}</p>
                                </div>
                            </div>
                        </div>

                        @if(Auth::check() && Auth::user()->isPlayer() && Auth::user()->isPremium())
                            <button disabled class="w-full py-3.5 rounded-xl bg-amber-500 text-slate-950 font-black cursor-not-allowed">{{ __('pricing.current_plan_premium') }}</button>
                        @else
                            <a href="{{ route('checkout', ['plan' => 'PREMIUM']) }}" class="w-full py-3.5 text-center rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black transition shadow-lg shadow-amber-500/20 active:scale-[0.98]">
                                {{ __('pricing.upgrade_premium') }}
                            </a>
                        @endif

                        {{-- Garantie --}}
                        <p class="text-center text-[10px] text-amber-200/40 mt-4 flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            {{ __('pricing.cancel_anytime') }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- Comparaison rapide --}}
            <div class="mt-16 max-w-4xl mx-auto">
                <h3 class="text-center text-lg font-bold mb-8 text-slate-300">{{ __('pricing.detailed_comparison') }}</h3>
                <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-800">
                                <th class="text-left py-4 px-6 text-slate-400 font-medium">{{ __('pricing.feature_label') }}</th>
                                <th class="text-center py-4 px-4 text-slate-300 font-bold">{{ __('pricing.free') }}</th>
                                <th class="text-center py-4 px-4">
                                    <span class="text-amber-400 font-black">{{ __('pricing.premium') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_full_player_profile') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_gallery_visibility') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">{{ __('pricing.val_priority') }} ★</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_public_share_link') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_internal_messaging') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_additional_videos') }}</td>
                                <td class="text-center py-3.5 px-4"><span class="text-slate-400 text-xs">{{ __('pricing.val_1_video') }}</span></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">{{ __('pricing.val_videos_additional') }}</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-3.5 px-6 text-slate-300">{{ __('pricing.feature_articles_access') }}</td>
                                <td class="text-center py-3.5 px-4"><span class="text-slate-400 text-xs">{{ __('pricing.val_standards') }}</span></td>
                                <td class="text-center py-3.5 px-4"><span class="text-amber-400 font-bold text-xs">{{ __('pricing.val_standards_excl') }}</span></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_audience_analytics') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_premium_badge') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_priority_placement') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                            <tr class="hover:bg-slate-800/20 transition bg-amber-500/5">
                                <td class="py-3.5 px-6 text-slate-300 font-medium">{{ __('pricing.feature_exclusive_content') }}</td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></td>
                                <td class="text-center py-3.5 px-4"><svg class="w-5 h-5 text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CTA final joueur --}}
            <div class="mt-12 text-center">
                <p class="text-slate-500 text-sm mb-4">{{ __('pricing.custom_needs') }}</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    {{ __('pricing.request_custom_demo') }}
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
