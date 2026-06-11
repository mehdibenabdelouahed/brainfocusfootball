@extends('layouts.app')

@section('title', __('home.meta_title'))

@section('content')
<div class="min-h-screen flex flex-col text-white" x-data="{ mode: 'joueur' }" style="background-color: var(--bff-bg-dark);">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- TOGGLE SWITCH JOUEUR / RECRUTEUR (Wix style rounded-full) --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="sticky top-[65px] md:top-[73px] z-[999] py-3 -mb-[72px] pointer-events-none bff-sticky-toggle">
        <div class="max-w-7xl mx-auto px-4 flex justify-center">
            <div class="relative inline-flex items-center bff-toggle rounded-full p-1 shadow-2xl shadow-black/80 pointer-events-auto" style="border: 1px solid var(--bff-border);">
                {{-- Sliding indicator --}}
                <div
                    class="absolute top-1 bottom-1 rounded-full shadow-lg transition-all duration-400 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                    :class="mode === 'joueur'
                        ? 'left-1 w-[calc(50%-2px)] bg-[#ffdc21] shadow-yellow-500/30'
                        : 'left-[calc(50%+1px)] w-[calc(50%-2px)] bg-[#ffffff] shadow-white/20'"
                    style="transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);"
                ></div>

                {{-- Bouton Joueur --}}
                <button
                    @click="mode = 'joueur'"
                    class="relative z-10 px-6 sm:px-8 py-2.5 rounded-full text-sm font-bold tracking-wider transition-colors duration-300 flex items-center gap-2 select-none uppercase"
                    :class="mode === 'joueur' ? 'text-[#0e1626]' : 'text-white/40 hover:text-white/70'"
                    style="font-family: 'Poppins', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em;"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ __('home.toggle_player') }}
                </button>

                {{-- Bouton Recruteur --}}
                <button
                    @click="mode = 'recruteur'"
                    class="relative z-10 px-6 sm:px-8 py-2.5 rounded-full text-sm font-bold tracking-wider transition-colors duration-300 flex items-center gap-2 select-none uppercase"
                    :class="mode === 'recruteur' ? 'text-[#0e1626]' : 'text-white/40 hover:text-white/70'"
                    style="font-family: 'Poppins', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em;"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    {{ __('home.toggle_recruiter') }}
                </button>
            </div>
        </div>
    </div>


    <main class="flex-1 min-h-screen text-white">

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- CONTENU JOUEUR                                        --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div x-show="mode === 'joueur'"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
        >
            {{-- ═══════════════════════════════════ --}}
            {{-- HERO JOUEUR — Wix sports style      --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="bff-hero relative">
                {{-- Background Image --}}
                <div class="absolute inset-0 z-0">
                    <img src="/images/home/player-action.png" alt="Background Player Action" class="w-full h-full object-cover">
                </div>
                {{-- Dark blue overlay --}}
                <div class="bff-hero-overlay" style="background: linear-gradient(180deg, rgba(14,22,38,0.4) 0%, rgba(14,22,38,0.7) 40%, rgba(14,22,38,0.9) 75%, var(--bff-bg-dark) 100%);"></div>
                {{-- Light gold glow overlay --}}
                <div class="bff-hero-overlay-warm"></div>

                <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-6 pt-44 sm:pt-32 pb-20 sm:py-20 flex flex-col items-center text-center min-h-screen justify-center bff-hero-content">
                    <div class="bff-animate-slide-up flex flex-col items-center" style="animation-delay: 0.2s;">
                        
                        {{-- Main title — Wix massive style --}}
                        <h1 class="bff-hero-title text-3xl sm:text-6xl lg:text-[5.5rem] xl:text-[6.5rem] mb-6 drop-shadow-2xl font-black uppercase tracking-tight leading-none">
                            <span class="block text-white">{{ __('home.hero_title_1') }}</span>
                            <span class="block text-[#ffdc21] bff-title-highlight">{{ __('home.hero_title_2') }}</span>
                            <span class="block text-white">{{ __('home.hero_title_3') }}</span>
                        </h1>

                        {{-- Subtitle --}}
                        <p class="text-sm sm:text-base max-w-2xl leading-relaxed mb-10 text-[#b2c0d9] font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.hero_subtitle') }}
                        </p>

                        {{-- CTA Buttons --}}
                        <div class="flex flex-col sm:flex-row flex-wrap justify-center items-center gap-4 mb-12 w-full">
                            @auth
                                <a href="{{ route('profile.edit') }}"
                                   class="inline-flex items-center justify-center px-8 py-4 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider transition rounded-full bff-btn-main shadow-lg shadow-yellow-500/20" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.12em;">
                                    {{ __('home.hero_btn_view_profile') }}
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                   class="inline-flex items-center justify-center px-8 py-4 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider transition rounded-full bff-btn-main shadow-lg shadow-yellow-500/20" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.12em;">
                                    {{ __('home.hero_btn_create_profile') }}
                                </a>
                            @endauth
                            <a href="{{ route('articles.index') }}"
                               class="inline-flex items-center justify-center px-8 py-4 border border-white/20 text-white/80 hover:text-[#0e1626] font-semibold uppercase tracking-wider rounded-full bff-btn-outline" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.12em;">
                                {{ __('home.hero_btn_discover_articles') }}
                            </a>
                        </div>

                        {{-- Info banner --}}
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-10 text-xs text-[#b2c0d9] bg-[#121b2d]/60 backdrop-blur-md border border-white/5 px-8 py-4 rounded-xl">
                            <div class="text-center sm:text-left">
                                <span class="block font-bold text-white text-xs mb-0.5 uppercase tracking-wide">{{ __('home.banner_ages_title') }}</span>
                                <span class="text-white/40">{{ __('home.banner_ages_desc') }}</span>
                            </div>
                            <div class="hidden sm:block h-8 w-px bg-white/10"></div>
                            <div class="text-center sm:text-left">
                                <span class="block font-bold text-white text-xs mb-0.5 uppercase tracking-wide">{{ __('home.banner_terrain_title') }}</span>
                                <span class="text-white/40">{{ __('home.banner_terrain_desc') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Scroll Indicator --}}
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 text-white/30 animate-bounce cursor-pointer hover:text-[#ffdc21] transition-colors hidden lg:flex" onclick="document.getElementById('nos-services').scrollIntoView({behavior: 'smooth'})">
                        <span class="text-[9px] uppercase tracking-[0.3em] font-bold" style="font-family: 'Poppins', sans-serif;">{{ __('home.scroll_discover') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- CARROUSEL NOS SERVICES (Full-width slides) --}}
            {{-- ═══════════════════════════════════ --}}
            <section id="nos-services" class="relative bff-reveal"
                x-data="{
                    current: 0,
                    totalSlides: 2,
                    autoplayInterval: null,
                    touchStartX: 0,
                    touchEndX: 0,
                    init() {
                        this.startAutoplay();
                        const urlParams = new URLSearchParams(window.location.search);
                        const serviceIdx = urlParams.get('service');
                        if (serviceIdx !== null) {
                            this.goTo(parseInt(serviceIdx));
                            setTimeout(() => {
                                document.getElementById('nos-services').scrollIntoView({behavior: 'smooth'});
                            }, 500);
                        }
                    },
                    next() {
                        this.current = (this.current + 1) % this.totalSlides;
                    },
                    prev() {
                        this.current = (this.current - 1 + this.totalSlides) % this.totalSlides;
                    },
                    goTo(index) {
                        this.current = index;
                    },
                    startAutoplay() {
                        this.autoplayInterval = setInterval(() => { this.next(); }, 6000);
                    },
                    stopAutoplay() {
                        clearInterval(this.autoplayInterval);
                    },
                    handleTouchStart(e) {
                        this.touchStartX = e.changedTouches[0].screenX;
                    },
                    handleTouchEnd(e) {
                        this.touchEndX = e.changedTouches[0].screenX;
                        const diff = this.touchStartX - this.touchEndX;
                        if (Math.abs(diff) > 50) {
                            diff > 0 ? this.next() : this.prev();
                        }
                    }
                }"
                @mouseenter="stopAutoplay()"
                @mouseleave="startAutoplay()"
                @touchstart="handleTouchStart($event)"
                @touchend="handleTouchEnd($event)"
                @go-to-service.window="goTo($event.detail); document.getElementById('nos-services').scrollIntoView({behavior: 'smooth'})"
            >
                {{-- Slides Container --}}
                <div class="relative w-full h-[75vh] sm:h-[85vh] min-h-[500px] sm:min-h-[600px] max-h-[900px] overflow-hidden">

                    {{-- ===== SLIDE 1 — Base de talents ===== --}}
                    <div class="absolute inset-0 transition-all duration-700 ease-in-out"
                         :class="current === 0 ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-105 z-0'">
                        <img src="/images/home/base-talents.jpg" alt="Base de talents" class="w-full h-full object-cover" style="filter: brightness(0.75) saturate(1.2);">
                        <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(14,22,38,0.92) 0%, rgba(14,22,38,0.7) 45%, rgba(14,22,38,0.3) 100%);"></div>
                        <div class="absolute inset-0 z-10 flex items-center">
                            <div class="max-w-7xl mx-auto px-6 sm:px-10 w-full">
                                <div class="max-w-xl"
                                     x-show="current === 0"
                                     x-transition:enter="transition ease-out duration-700 delay-200"
                                     x-transition:enter-start="opacity-0 translate-y-8"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0 -translate-y-4">

                                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white uppercase leading-none mb-6" style="font-family: 'Saira Condensed', sans-serif;">
                                         {{ __('home.slide1_title') }}<br><span class="text-[#ffdc21]">{{ __('home.slide1_title_highlight') }}</span>
                                    </h2>
                                    <p class="text-sm sm:text-base text-[#b2c0d9] font-light leading-relaxed mb-8 max-w-lg" style="font-family: 'Poppins', sans-serif;">
                                         {{ __('home.slide1_desc') }}
                                    </p>
                                    <a href="{{ route('talents') }}" class="inline-flex items-center gap-3 px-7 py-3.5 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider rounded-full bff-btn-main shadow-lg shadow-yellow-500/20 text-xs" style="font-family: 'Poppins', sans-serif; letter-spacing: 0.1em;">
                                         {{ __('home.slide1_btn') }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SLIDE 2 — Création profil joueur digital ===== --}}
                    <div class="absolute inset-0 transition-all duration-700 ease-in-out"
                         :class="current === 1 ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-105 z-0'">
                        <img src="/images/home/entrainement-cones.jpg" alt="Création profil joueur digital" class="w-full h-full object-cover object-top" style="filter: brightness(0.75) saturate(1.2);">
                        <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(14,22,38,0.92) 0%, rgba(14,22,38,0.7) 45%, rgba(14,22,38,0.3) 100%);"></div>
                        <div class="absolute inset-0 z-10 flex items-center">
                            <div class="max-w-7xl mx-auto px-6 sm:px-10 w-full">
                                <div class="max-w-xl"
                                     x-show="current === 1"
                                     x-transition:enter="transition ease-out duration-700 delay-200"
                                     x-transition:enter-start="opacity-0 translate-y-8"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0 -translate-y-4">

                                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white uppercase leading-none mb-6" style="font-family: 'Saira Condensed', sans-serif;">
                                         {{ __('home.slide2_title') }}<br><span class="text-[#ffdc21]">{{ __('home.slide2_title_highlight') }}</span>
                                    </h2>
                                    <p class="text-sm sm:text-base text-[#b2c0d9] font-light leading-relaxed mb-8 max-w-lg" style="font-family: 'Poppins', sans-serif;">
                                         {{ __('home.slide2_desc') }}
                                    </p>
                                    @auth
                                         <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-3 px-7 py-3.5 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider rounded-full bff-btn-main shadow-lg shadow-yellow-500/20 text-xs" style="font-family: 'Poppins', sans-serif; letter-spacing: 0.1em;">
                                              {{ __('home.slide2_btn_edit') }}
                                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                         </a>
                                    @else
                                         <a href="{{ route('register') }}" class="inline-flex items-center gap-3 px-7 py-3.5 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider rounded-full bff-btn-main shadow-lg shadow-yellow-500/20 text-xs" style="font-family: 'Poppins', sans-serif; letter-spacing: 0.1em;">
                                              {{ __('home.slide2_btn_create') }}
                                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                         </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Navigation Dots --}}
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
                        <template x-for="(slide, index) in totalSlides" :key="index">
                            <button @click="goTo(index)"
                                class="relative transition-all duration-500 rounded-full"
                                :class="current === index
                                    ? 'w-10 h-3 bg-[#ffdc21] shadow-lg shadow-yellow-500/30'
                                    : 'w-3 h-3 bg-white/30 hover:bg-white/60'">
                            </button>
                        </template>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="absolute bottom-0 left-0 right-0 z-20 h-1 bg-white/5">
                        <div class="h-full bg-gradient-to-r from-[#ffdc21] to-[#ffe661] transition-all duration-700 ease-out"
                             :style="'width: ' + ((current + 1) / totalSlides * 100) + '%'"></div>
                    </div>

                </div>
            </section>
            {{-- ═══════════════════════════════════ --}}
            {{-- COMMENT ÇA MARCHE JOUEUR (Wix 3 col cards) --}}
            {{-- ═══════════════════════════════════ --}}
            <section id="joueur-features" class="w-full bg-white py-20 lg:py-28 bff-reveal">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="text-center mb-16">
                        <div class="bff-separator-accent mx-auto mb-6"></div>
                        <h2 class="bff-heading-section text-3xl sm:text-4xl lg:text-5xl mb-4 text-[#0e1626]">{{ __('home.how_it_works_title') }}</h2>
                        <p class="text-sm text-slate-600 max-w-2xl mx-auto font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.how_it_works_subtitle') }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 lg:gap-12 text-sm bff-reveal-stagger">
                        {{-- Pillar 1 --}}
                        <div class="bff-card !bg-slate-50 !border-slate-200/60 overflow-hidden group relative flex flex-col justify-between min-h-[480px] p-8 lg:p-10 rounded-2xl shadow-xl hover:border-amber-400 transition-all duration-500">
                            {{-- Background image with hover zoom --}}
                            <div class="absolute inset-0 z-0 overflow-hidden rounded-2xl">
                                <img src="/images/home/entrainement-cones.jpg" alt="Se former" class="w-full h-full object-cover opacity-[0.03] transition-transform duration-700 ease-out group-hover:scale-105 group-hover:opacity-[0.06]" style="filter: grayscale(100%);">
                                <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                            </div>

                            <div class="relative z-10">
                                {{-- Header --}}
                                <div class="flex items-center gap-3 mb-6"></div>

                                <h3 class="text-2xl lg:text-3xl font-black text-slate-900 uppercase mb-4 tracking-wide" style="font-family: 'Saira Condensed', sans-serif;">
                                    {{ __('home.pillar1_title') }}<br><span class="text-amber-500">{{ __('home.pillar1_title_highlight') }}</span>
                                </h3>
                                
                                <p class="text-slate-600 font-light leading-relaxed mb-8 text-sm sm:text-base">
                                    {{ __('home.pillar1_desc') }}
                                </p>

                                {{-- Benefits list --}}
                                <ul class="space-y-4 mb-10">
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar1_item1_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar1_item1_desc') }}</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar1_item2_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar1_item2_desc') }}</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar1_item3_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar1_item3_desc') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="relative z-10">
                                <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center gap-3 w-full px-6 py-4 bg-slate-900 hover:bg-[#ffdc21] text-white hover:text-[#0e1626] font-bold uppercase tracking-wider rounded-xl transition-all duration-300 border border-transparent hover:scale-[1.02] active:scale-[0.98] text-xs" style="font-family: 'Poppins', sans-serif;">
                                    {{ __('home.pillar1_btn') }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Pillar 2 --}}
                        <div class="bff-card !bg-slate-50 !border-slate-200/60 overflow-hidden group relative flex flex-col justify-between min-h-[480px] p-8 lg:p-10 rounded-2xl shadow-xl hover:border-amber-400 transition-all duration-500">
                            {{-- Background image with hover zoom --}}
                            <div class="absolute inset-0 z-0 overflow-hidden rounded-2xl">
                                <img src="/images/stade.jpg" alt="Se présenter" class="w-full h-full object-cover opacity-[0.03] transition-transform duration-700 ease-out group-hover:scale-105 group-hover:opacity-[0.06]" style="filter: grayscale(100%);">
                                <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                            </div>

                            <div class="relative z-10">
                                {{-- Header --}}
                                <div class="flex items-center gap-3 mb-6"></div>

                                <h3 class="text-2xl lg:text-3xl font-black text-slate-900 uppercase mb-4 tracking-wide" style="font-family: 'Saira Condensed', sans-serif;">
                                    {{ __('home.pillar2_title') }}<br><span class="text-amber-500">{{ __('home.pillar2_title_highlight') }}</span>
                                </h3>
                                
                                <p class="text-slate-600 font-light leading-relaxed mb-8 text-sm sm:text-base">
                                    {{ __('home.pillar2_desc') }}
                                </p>

                                {{-- Benefits list --}}
                                <ul class="space-y-4 mb-10">
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar2_item1_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar2_item1_desc') }}</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar2_item2_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar2_item2_desc') }}</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        <div>
                                            <h4 class="font-bold text-slate-900 uppercase text-xs tracking-wider mb-0.5">{{ __('home.pillar2_item3_title') }}</h4>
                                            <p class="text-slate-500 text-xs font-light">{{ __('home.pillar2_item3_desc') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="relative z-10">
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-3 w-full px-6 py-4 bg-slate-900 hover:bg-[#ffdc21] text-white hover:text-[#0e1626] font-bold uppercase tracking-wider rounded-xl transition-all duration-300 border border-transparent hover:scale-[1.02] active:scale-[0.98] text-xs" style="font-family: 'Poppins', sans-serif;">
                                        {{ __('home.pillar2_btn_edit') }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-3 w-full px-6 py-4 bg-slate-900 hover:bg-[#ffdc21] text-white hover:text-[#0e1626] font-bold uppercase tracking-wider rounded-xl transition-all duration-300 border border-transparent hover:scale-[1.02] active:scale-[0.98] text-xs" style="font-family: 'Poppins', sans-serif;">
                                        {{ __('home.pillar2_btn_create') }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- COMPTEURS DE STATS (Wix style Navy background) --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="relative py-24 lg:py-32 bff-reveal overflow-hidden" style="background: var(--bff-bg-section);">
                <div class="absolute inset-0 z-0">
                    <img src="/images/stadium-bg.jpg" alt="" class="w-full h-full object-cover opacity-10">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#0e1626] via-transparent to-[#0e1626]"></div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-16 text-center">
                        <div>
                            <div class="bff-stat-number text-5xl lg:text-7xl mb-2 bff-counter font-black" data-target="850">0</div>
                            <div class="bff-stat-label tracking-widest uppercase text-xs">{{ __('home.stat_players') }}</div>
                        </div>
                        <div>
                            <div class="bff-stat-number text-5xl lg:text-7xl mb-2 bff-counter font-black" data-target="42">0</div>
                            <div class="bff-stat-label tracking-widest uppercase text-xs">{{ __('home.stat_articles') }}</div>
                        </div>
                        <div>
                            <div class="bff-stat-number text-5xl lg:text-7xl mb-2 bff-counter font-black" data-target="15">0</div>
                            <div class="bff-stat-label tracking-widest uppercase text-xs">{{ __('home.stat_partners') }}</div>
                        </div>
                        <div>
                            <div class="bff-stat-number text-5xl lg:text-7xl mb-2 bff-counter font-black" data-target="100" data-suffix="%">0</div>
                            <div class="bff-stat-label tracking-widest uppercase text-xs">{{ __('home.stat_mental') }}</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- DOSSIERS & ARTICLES (Wix Grid style) --}}
            {{-- ═══════════════════════════════════ --}}


            {{-- ═══════════════════════════════════ --}}
            {{-- BANDEAU DÉFILANT TALENTS (Wix Team style) --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="py-12 overflow-hidden bff-reveal" style="background: var(--bff-bg-section); border-top: 1px solid var(--bff-border); border-bottom: 1px solid var(--bff-border);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 mb-8 flex items-center gap-3 opacity-80">
                    <span class="w-2 h-2 rounded-full bg-[#ffdc21] animate-pulse"></span>
                    <h2 class="text-xs uppercase tracking-widest text-[#ffdc21] font-bold">{{ __('home.marquee_title') }}</h2>
                </div>
                
                <div class="relative flex overflow-hidden group">
                    <div class="flex animate-marquee whitespace-nowrap gap-16 items-center py-2">
                        @forelse ($players->concat($players) as $user)
                            @php $player = $user->player; @endphp
                            @if(!$player) @continue @endif
                            <a href="{{ route('profile.show', $user->id) }}" class="flex flex-col items-center text-center group/item cursor-pointer">
                                <div class="relative w-20 h-20 rounded-full overflow-hidden border-2 border-white/10 transition-all duration-500 group-hover/item:border-[#ffdc21] mb-3">
                                    @if($player->profile_photo)
                                        <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $player->first_name }} {{ $player->last_name }}" class="w-full h-full object-cover grayscale opacity-80 group-hover/item:grayscale-0 group-hover/item:opacity-100 transition-all duration-500">
                                    @else
                                        <div class="w-full h-full bg-[#172237] flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-[11px] leading-tight">
                                    <p class="font-bold text-white group-hover/item:text-[#ffdc21] transition-colors">{{ $player->first_name }} {{ substr($player->last_name, 0, 1) }}.</p>
                                    <p class="text-[9px] text-[#b2c0d9] uppercase tracking-wider font-light mt-0.5">{{ $player->position ?? __('home.marquee_coming_soon') }}</p>
                                </div>
                            </a>
                        @empty
                            @for($i=0; $i<6; $i++)
                                <div class="flex flex-col items-center opacity-30">
                                    <div class="w-20 h-20 rounded-full bg-[#172237] mb-3"></div>
                                    <div class="text-[11px]">
                                        <p class="font-bold text-white/20">Talent BFF</p>
                                        <p class="text-[9px] text-white/10">{{ __('home.marquee_coming_soon') }}</p>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                    
                    {{-- Gradient overlays --}}
                    <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-[#0e1626] to-transparent z-10"></div>
                    <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-[#0e1626] to-transparent z-10"></div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- SECTION PROFIL JOUEUR (Mockup presentation) --}}
            {{-- ═══════════════════════════════════ --}}
            <section id="profil-joueur" class="bff-reveal" style="background: var(--bff-bg-section); border-top: 1px solid var(--bff-border); border-bottom: 1px solid var(--bff-border);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20 lg:py-28 flex flex-col lg:flex-row gap-16 items-center">
                    <div class="flex-1">
                        <div class="bff-separator-accent mb-6"></div>
                        <h2 class="bff-heading-section text-3xl sm:text-4xl lg:text-5xl mb-6 text-white leading-tight">{{ __('home.profile_mockup_title') }}</h2>
                        <p class="text-sm text-[#b2c0d9] mb-8 max-w-xl font-light leading-relaxed" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.profile_mockup_desc') }}
                        </p>

                        <ul class="space-y-4 text-sm text-[#b2c0d9] mb-8 font-light">
                            <li class="flex gap-3 items-center">
                                <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full flex-shrink-0"></span>
                                <span><strong class="text-white font-semibold">{{ __('home.profile_mockup_item1') }}</strong> {{ __('home.profile_mockup_item1_desc') }}</span>
                            </li>
                            <li class="flex gap-3 items-center">
                                <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full flex-shrink-0"></span>
                                <span><strong class="text-white font-semibold">{{ __('home.profile_mockup_item2') }}</strong> {{ __('home.profile_mockup_item2_desc') }}</span>
                            </li>
                            <li class="flex gap-3 items-center">
                                <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full flex-shrink-0"></span>
                                <span><strong class="text-white font-semibold">{{ __('home.profile_mockup_item3') }}</strong> {{ __('home.profile_mockup_item3_desc') }}</span>
                            </li>
                        </ul>

                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ route('profile.edit') }}"
                                   class="px-8 py-3.5 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider rounded-full transition bff-btn-main shadow-lg" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.1em;">
                                    {{ __('home.profile_mockup_btn_edit') }}
                                </a>
                                <a href="{{ route('profile.show', Auth::id()) }}"
                                   class="px-8 py-3.5 border border-white/20 text-white/80 font-semibold uppercase tracking-wider rounded-full bff-btn-outline" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.1em;">
                                    {{ __('home.profile_mockup_btn_view') }}
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                   class="px-8 py-3.5 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider rounded-full transition bff-btn-main shadow-lg" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.1em;">
                                    {{ __('home.profile_mockup_btn_create') }}
                                </a>
                                <a href="{{ route('login') }}"
                                   class="px-8 py-3.5 border border-white/20 text-white/80 font-semibold uppercase tracking-wider rounded-full bff-btn-outline" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.1em;">
                                    {{ __('home.profile_mockup_btn_login') }}
                                </a>
                            @endauth
                        </div>
                    </div>

                     {{-- Profile Preview — Original player mockup --}}
                     <div class="flex-1 w-full animate-fade-in">
                          <div class="bg-slate-950/90 border border-slate-800 rounded-2xl p-4 text-[11px] text-white">
                              <p class="text-slate-400 text-[10px] mb-2">{{ __('home.profile_preview_title') }}</p>
                              <div class="space-y-2">
                                  <div class="flex items-center gap-3">
                                       <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-700">
                                           <img
                                              src="/images/bulle.jpg"
                                              alt="Photo de Mehdi"
                                              class="w-full h-full object-cover"
                                          >
                                      </div>
                                      <div>
                                          <p class="font-semibold text-sm text-white">Mehdi</p>
                                          <p class="text-slate-400 text-[11px]">{{ __('home.profile_preview_position') }}</p>
                                      </div>
                                  </div>
  
                                  <div class="grid grid-cols-2 gap-2 mt-3">
                                      <div class="bg-slate-900 rounded-lg p-2 border border-white/5">
                                          <p class="text-slate-400 text-[10px]">{{ __('home.profile_preview_club') }}</p>
                                          <p class="font-semibold text-white">RSC Anderlecht</p>
                                      </div>
                                      <div class="bg-slate-900 rounded-lg p-2 border border-white/5">
                                          <p class="text-slate-400 text-[10px]">{{ __('home.profile_preview_pos_label') }}</p>
                                          <p class="font-semibold text-white">{{ __('home.profile_preview_pos_val') }}</p>
                                      </div>
                                      <div class="bg-slate-900 rounded-lg p-2 border border-white/5">
                                          <p class="text-slate-400 text-[10px]">{{ __('home.profile_preview_matches') }}</p>
                                          <p class="font-semibold text-white">24</p>
                                      </div>
                                      <div class="bg-slate-900 rounded-lg p-2 border border-white/5">
                                          <p class="text-slate-400 text-[10px]">{{ __('home.profile_preview_goals') }}</p>
                                          <p class="font-semibold text-white">9 / 11</p>
                                      </div>
                                  </div>
  
                                  <div class="mt-3">
                                      <p class="text-slate-400 text-[10px] mb-1">{{ __('home.profile_preview_video') }}</p>
                                      <div class="aspect-video rounded-xl overflow-hidden relative">
                                              <video
                                                  src="/videos/ilian.mp4"
                                                  autoplay
                                                  muted
                                                  loop
                                                  playsinline
                                                  class="absolute inset-0 w-full h-full object-cover bg-gradient-to-tr from-slate-950/30 to-transparent">
                                              </video>
                                          </div>
                                  </div>
  
                                  <div class="mt-3">
                                      <p class="text-slate-400 text-[10px] mb-1">{{ __('home.profile_preview_desc_label') }}</p>
                                      <p class="text-slate-300 text-[11px] leading-relaxed">
                                          {{ __('home.profile_preview_desc_val') }}
                                      </p>
                                  </div>
                              </div>
                          </div>
                     </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- TÉMOIGNAGES (Wix clean block style) --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="bff-reveal">
                {{-- Cinematic photo banner — Passion du football --}}
                <div class="relative w-full h-[50vh] min-h-[350px] max-h-[500px] overflow-hidden mb-0">
                    <img src="/images/home/passion-football.jpg" alt="La passion du football" class="w-full h-full object-cover object-center" style="filter: brightness(0.9) saturate(1.15);">
                    <div class="absolute inset-0" style="background: linear-gradient(180deg, var(--bff-bg-dark) 0%, rgba(14,22,38,0.2) 30%, rgba(14,22,38,0.2) 70%, var(--bff-bg-dark) 100%);"></div>
                    {{-- Centered text overlay --}}
                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <div class="text-center px-4">
                            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white uppercase leading-none mb-4" style="font-family: 'Saira Condensed', sans-serif; text-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                                {{ __('home.testimonial_banner_title') }} <span class="text-[#ffdc21]">{{ __('home.testimonial_banner_highlight') }}</span>
                            </h2>
                            <p class="text-sm text-white/60 font-light max-w-md mx-auto" style="font-family: 'Poppins', sans-serif;">{{ __('home.testimonial_banner_desc') }}</p>
                        </div>
                    </div>
                    {{-- Animated gold line at bottom --}}
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-[#ffdc21] to-transparent"></div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 lg:py-20">

                <div class="grid md:grid-cols-3 gap-8 bff-reveal-stagger">
                    {{-- Testimonial 1 --}}
                    <div class="bff-card p-8 relative flex flex-col justify-between">
                        <p class="text-[#b2c0d9] italic mb-8 text-sm leading-relaxed font-light relative z-10" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.testimonial1_text') }}
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#121b2d] border border-[#ffdc21]/30"></div>
                            <div>
                                <p class="font-bold text-xs text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.testimonial1_author') }}</p>
                                <p class="text-[9px] text-[#ffdc21] uppercase tracking-wider font-semibold">{{ __('home.testimonial1_role') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Testimonial 2 --}}
                    <div class="bff-card p-8 relative flex flex-col justify-between">
                        <p class="text-[#b2c0d9] italic mb-8 text-sm leading-relaxed font-light relative z-10" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.testimonial2_text') }}
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#121b2d] border border-[#ffdc21]/30"></div>
                            <div>
                                <p class="font-bold text-xs text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.testimonial2_author') }}</p>
                                <p class="text-[9px] text-[#ffdc21] uppercase tracking-wider font-semibold">{{ __('home.testimonial2_role') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Testimonial 3 --}}
                    <div class="bff-card p-8 relative flex flex-col justify-between">
                        <p class="text-[#b2c0d9] italic mb-8 text-sm leading-relaxed font-light relative z-10" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.testimonial3_text') }}
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#121b2d] border border-[#ffdc21]/30"></div>
                            <div>
                                <p class="font-bold text-xs text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.testimonial3_author') }}</p>
                                <p class="text-[9px] text-[#ffdc21] uppercase tracking-wider font-semibold">{{ __('home.testimonial3_role') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- FAQ ACCORDION (Wix Clean lines style) --}}
            {{-- ═══════════════════════════════════ --}}
            <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 py-20 lg:py-28 bff-reveal">
                <div class="text-center mb-16">
                    <div class="bff-separator-accent mx-auto mb-6"></div>
                    <h2 class="bff-heading-section text-3xl sm:text-4xl lg:text-5xl mb-4 text-white">{{ __('home.faq_title') }}</h2>
                    <p class="text-sm text-[#b2c0d9] font-light" style="font-family: 'Poppins', sans-serif;">{{ __('home.faq_subtitle') }}</p>
                </div>

                <div class="space-y-0 border-t border-b border-white/10" x-data="{ active: null }">
                    {{-- Q1 --}}
                    <div class="border-b border-white/10 transition-all duration-300">
                        <button 
                            @click="active !== 1 ? active = 1 : active = null" 
                            class="w-full flex items-center justify-between py-6 text-left focus:outline-none"
                        >
                            <span class="font-bold text-sm sm:text-base pr-4 text-white uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">{{ __('home.faq_q1') }}</span>
                            <span class="text-[#ffdc21] font-bold text-xl select-none" x-text="active === 1 ? '—' : '+'"></span>
                        </button>
                        <div 
                            x-show="active === 1" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="pb-6 text-xs sm:text-sm text-[#b2c0d9] leading-relaxed font-light"
                            style="font-family: 'Poppins', sans-serif;"
                        >
                            {{ __('home.faq_a1') }}
                        </div>
                    </div>

                    {{-- Q2 --}}
                    <div class="border-b border-white/10 transition-all duration-300">
                        <button 
                            @click="active !== 2 ? active = 2 : active = null" 
                            class="w-full flex items-center justify-between py-6 text-left focus:outline-none"
                        >
                            <span class="font-bold text-sm sm:text-base pr-4 text-white uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">{{ __('home.faq_q2') }}</span>
                            <span class="text-[#ffdc21] font-bold text-xl select-none" x-text="active === 2 ? '—' : '+'"></span>
                        </button>
                        <div x-show="active === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pb-6 text-xs sm:text-sm text-[#b2c0d9] leading-relaxed font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.faq_a2') }}
                        </div>
                    </div>

                    {{-- Q3 --}}
                    <div class="border-b border-white/10 transition-all duration-300">
                        <button 
                            @click="active !== 3 ? active = 3 : active = null" 
                            class="w-full flex items-center justify-between py-6 text-left focus:outline-none"
                        >
                            <span class="font-bold text-sm sm:text-base pr-4 text-white uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">{{ __('home.faq_q3') }}</span>
                            <span class="text-[#ffdc21] font-bold text-xl select-none" x-text="active === 3 ? '—' : '+'"></span>
                        </button>
                        <div x-show="active === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pb-6 text-xs sm:text-sm text-[#b2c0d9] leading-relaxed font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.faq_a3') }}
                        </div>
                    </div>

                    {{-- Q4 --}}
                    <div class="border-b border-white/10 transition-all duration-300">
                        <button 
                            @click="active !== 4 ? active = 4 : active = null" 
                            class="w-full flex items-center justify-between py-6 text-left focus:outline-none"
                        >
                            <span class="font-bold text-sm sm:text-base pr-4 text-white uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">{{ __('home.faq_q4') }}</span>
                            <span class="text-[#ffdc21] font-bold text-xl select-none" x-text="active === 4 ? '—' : '+'"></span>
                        </button>
                        <div x-show="active === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pb-6 text-xs sm:text-sm text-[#b2c0d9] leading-relaxed font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.faq_a4') }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- CONTENU RECRUTEUR                                     --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div x-show="mode === 'recruteur'"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
        >
            {{-- ═══════════════════════════════════ --}}
            {{-- HERO RECRUTEUR — Wix Navy & White   --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="bff-hero relative">
                <div class="absolute inset-0 z-0">
                    <img src="/images/stade.jpg" alt="Background Stadium" class="w-full h-full object-cover opacity-30">
                </div>
                <div class="absolute inset-0 z-1" style="background: linear-gradient(180deg, rgba(14,22,38,0.4) 0%, rgba(14,22,38,0.8) 45%, rgba(14,22,38,0.95) 75%, var(--bff-bg-dark) 100%);"></div>

                <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-6 pt-32 pb-20 sm:py-20 min-h-screen flex items-center bff-hero-content">
                    <div class="max-w-3xl bff-animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="inline-flex items-center gap-2 px-5 py-2 border border-white/10 text-[#ffdc21] text-xs font-semibold mb-8 uppercase tracking-widest rounded-full" style="font-family: 'Poppins', sans-serif; background: rgba(255,220,33,0.05);">
                            {{ __('home.recruiter_space') }}
                        </div>

                        <h1 class="bff-hero-title text-3xl sm:text-6xl lg:text-[5rem] xl:text-[6rem] mb-6 drop-shadow-2xl font-black uppercase tracking-tight leading-none">
                            <span class="block text-white">{{ __('home.recruiter_hero_1') }}</span>
                            <span class="block text-[#ffdc21] bff-title-highlight-sky">{{ __('home.recruiter_hero_highlight') }}</span>
                        </h1>

                        <p class="text-sm sm:text-base max-w-xl leading-relaxed mb-10 text-[#b2c0d9] font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.recruiter_hero_subtitle') }}
                        </p>

                        <div class="flex flex-col sm:flex-row flex-wrap items-center gap-4">
                            <a href="{{ route('talents') }}"
                               class="inline-flex items-center justify-center px-8 py-4 bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold uppercase tracking-wider transition rounded-full bff-btn-main shadow-lg" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.12em;">
                                {{ __('home.recruiter_hero_btn_explore') }}
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center px-8 py-4 border border-white/20 text-white/80 hover:text-[#0e1626] font-semibold uppercase tracking-wider rounded-full bff-btn-outline" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.12em;">
                                {{ __('home.recruiter_hero_btn_partner') }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- CE QUE BFF OFFRE AUX RECRUTEURS (Wix 3 columns cards) --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="max-w-7xl mx-auto px-4 sm:px-6 py-20 lg:py-28 bff-reveal">
                <div class="text-center mb-16">
                    <div class="bff-separator-accent mx-auto mb-6"></div>
                    <h2 class="bff-heading-section text-3xl sm:text-4xl lg:text-5xl mb-4 text-white">{{ __('home.recruiter_section_title') }}</h2>
                    <p class="text-sm text-[#b2c0d9] max-w-2xl mx-auto font-light" style="font-family: 'Poppins', sans-serif;">
                        {{ __('home.recruiter_section_subtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 text-sm bff-reveal-stagger mb-20">
                    {{-- Service 1 --}}
                    <div class="bff-card overflow-hidden group flex flex-col">
                        <div class="aspect-[16/10] w-full overflow-hidden relative">
                            <img src="/images/articles/roles.png" alt="Filtres" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <h3 class="font-bold text-lg mb-4 text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.recruiter_pillar1_title') }}</h3>
                            <p class="text-[#b2c0d9] font-light leading-relaxed">
                                {{ __('home.recruiter_pillar1_desc') }}
                            </p>
                        </div>
                    </div>

                    {{-- Service 2 --}}
                    <div class="bff-card overflow-hidden group flex flex-col">
                        <div class="aspect-[16/10] w-full overflow-hidden relative">
                            <img src="/images/articles/techniques_tactiques.png" alt="Vidéos" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <h3 class="font-bold text-lg mb-4 text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.recruiter_pillar2_title') }}</h3>
                            <p class="text-[#b2c0d9] font-light leading-relaxed">
                                {{ __('home.recruiter_pillar2_desc') }}
                            </p>
                        </div>
                    </div>

                    {{-- Service 3 --}}
                    <div class="bff-card overflow-hidden group flex flex-col">
                        <div class="aspect-[16/10] w-full overflow-hidden relative">
                            <img src="/images/articles/preparation_physique.png" alt="Radars" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <h3 class="font-bold text-lg mb-4 text-white uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.recruiter_pillar3_title') }}</h3>
                            <p class="text-[#b2c0d9] font-light leading-relaxed">
                                {{ __('home.recruiter_pillar3_desc') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Recruiter Talent preview grid (Wix design circular list) --}}
                <div class="flex flex-col lg:flex-row gap-16 items-center bg-var(--bff-bg-section) p-8 lg:p-12 rounded-2xl border border-white/5">
                    <div class="flex-1">
                        <div class="bff-separator-accent mb-6"></div>
                        <h2 class="bff-heading-section text-2xl sm:text-3xl lg:text-4xl mb-4 text-white">{{ __('home.recruiter_mockup_title') }}</h2>
                        <p class="text-sm text-[#b2c0d9] mb-6 font-light leading-relaxed" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.recruiter_mockup_desc') }}
                        </p>
                        <a href="{{ route('talents') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#ffdc21] hover:text-white transition-colors uppercase tracking-wider">
                            {{ __('home.recruiter_mockup_btn') }} →
                        </a>
                    </div>

                    {{-- Preview List --}}
                    <div class="flex-1 w-full space-y-4">
                        @foreach($players->take(4) as $user)
                            @php $player = $user->player; @endphp
                            @if(!$player) @continue @endif
                            <a href="{{ route('profile.show', $user->id) }}" class="flex items-center gap-4 p-4 bg-[#0e1626]/80 rounded-xl border border-white/5 hover:border-[#ffdc21]/30 transition group">
                                <div class="w-12 h-12 rounded-full overflow-hidden border border-white/10 flex-shrink-0">
                                    @if($player->profile_photo)
                                        <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $player->first_name }} {{ $player->last_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#172237] flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm text-white group-hover:text-[#ffdc21] transition uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">{{ $player->first_name }} {{ substr($player->last_name, 0, 1) }}.</p>
                                    <p class="text-xs text-[#b2c0d9] font-light truncate">{{ $player->position ?? __('home.toggle_player') }} {{ $player->current_club ? '• ' . $player->current_club : '' }}</p>
                                </div>
                                <svg class="w-5 h-5 text-white/20 group-hover:text-[#ffdc21] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endforeach

                        @if($players->count() === 0)
                            @for($i=0; $i<3; $i++)
                                <div class="flex items-center gap-4 p-4 bg-[#0e1626]/40 rounded-xl border border-white/5 opacity-40">
                                    <div class="w-12 h-12 rounded-full bg-[#172237] flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <div class="h-3 bg-white/10 rounded w-24 mb-2"></div>
                                        <div class="h-2.5 bg-white/5 rounded w-16"></div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </section>

            {{-- ═══════════════════════════════════ --}}
            {{-- TARIFS RECRUTEUR (Wix minimalist grids) --}}
            {{-- ═══════════════════════════════════ --}}
            <section class="py-20 lg:py-28 bff-reveal" style="background: var(--bff-bg-section); border-top: 1px solid var(--bff-border); border-bottom: 1px solid var(--bff-border);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="text-center mb-16">
                        <div class="bff-separator-accent mx-auto mb-6"></div>
                        <h2 class="bff-heading-section text-3xl sm:text-4xl lg:text-5xl mb-4 text-white">{{ __('home.pricing_title') }}</h2>
                        <p class="text-sm text-[#b2c0d9] max-w-xl mx-auto font-light" style="font-family: 'Poppins', sans-serif;">
                            {{ __('home.pricing_subtitle') }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto items-start">
                        {{-- FREE --}}
                        <div class="bff-card p-6 flex flex-col group bg-[#0e1626]">
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-white/50 mb-2 uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.plan_free_name') }}</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">0€</span>
                                    <span class="text-white/30 text-xs">{{ __('home.pricing_per_month') }}</span>
                                </div>
                                <p class="text-xs text-[#b2c0d9]/40 mt-2 font-light">{{ __('home.plan_free_desc') }}</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8 text-xs font-light text-[#b2c0d9]">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_free_item1') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_free_item2') }}</span>
                                </div>
                                <div class="flex items-start gap-3 opacity-40">
                                    <svg class="w-4 h-4 text-white/20 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    <span class="line-through">{{ __('home.plan_free_item3') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'GRATUIT']) }}" class="w-full py-2.5 text-center border border-white/10 hover:border-white text-white/80 font-bold transition rounded-full uppercase tracking-wider text-[10px]" style="font-family: 'Poppins', sans-serif;">{{ __('home.pricing_choose') }}</a>
                        </div>

                        {{-- STANDARD --}}
                        <div class="bff-card p-6 flex flex-col group bg-[#0e1626]">
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-[#ffdc21] mb-2 uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.plan_standard_name') }}</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">29€</span>
                                    <span class="text-white/30 text-xs">{{ __('home.pricing_per_month') }}</span>
                                </div>
                                <p class="text-xs text-[#b2c0d9]/40 mt-2 font-light">{{ __('home.plan_standard_desc') }}</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8 text-xs font-light text-[#b2c0d9]">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_standard_item1') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_standard_item2') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_standard_item3') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'STANDARD']) }}" class="w-full py-2.5 text-center bg-white/5 border border-white/5 hover:bg-white/10 text-white font-bold transition rounded-full uppercase tracking-wider text-[10px]" style="font-family: 'Poppins', sans-serif;">{{ __('home.pricing_choose') }}</a>
                        </div>

                        {{-- PRO --}}
                        <div class="bff-card p-6 flex flex-col group relative bg-[#0e1626]" style="border: 2px solid var(--bff-accent);">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#ffdc21] text-[#0e1626] text-[8px] font-black px-4 py-1 rounded-full uppercase tracking-widest">
                                {{ __('common.popular') }}
                            </div>
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-[#ffdc21] mb-2 uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.plan_pro_name') }}</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">79€</span>
                                    <span class="text-white/30 text-xs">{{ __('home.pricing_per_month') }}</span>
                                </div>
                                <p class="text-xs text-[#b2c0d9]/40 mt-2 font-light">{{ __('home.plan_pro_desc') }}</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8 text-xs font-light text-[#b2c0d9]">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-[#ffdc21] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-white font-semibold">{{ __('home.plan_pro_item1') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-[#ffdc21] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-white font-semibold">{{ __('home.plan_pro_item2') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-[#ffdc21] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_pro_item3') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'PRO']) }}" class="w-full py-2.5 text-center bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] font-bold transition rounded-full uppercase tracking-wider text-[10px]" style="font-family: 'Poppins', sans-serif;">{{ __('home.pricing_choose') }}</a>
                        </div>

                        {{-- ACADÉMIE --}}
                        <div class="bff-card p-6 flex flex-col group bg-[#0e1626]">
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-white/50 mb-2 uppercase" style="font-family: 'Poppins', sans-serif;">{{ __('home.plan_academy_name') }}</h3>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">199€</span>
                                    <span class="text-white/30 text-xs">{{ __('home.pricing_per_month') }}</span>
                                </div>
                                <p class="text-xs text-[#b2c0d9]/40 mt-2 font-light">{{ __('home.plan_academy_desc') }}</p>
                            </div>
                            <div class="flex-1 space-y-3 mb-8 text-xs font-light text-[#b2c0d9]">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_academy_item1') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_academy_item2') }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ __('home.plan_academy_item3') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout', ['plan' => 'ACADEMIE']) }}" class="w-full py-2.5 text-center border border-white/10 hover:border-white text-white/80 font-bold transition rounded-full uppercase tracking-wider text-[10px]" style="font-family: 'Poppins', sans-serif;">{{ __('home.pricing_contact') }}</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- CONTRASTE BLANCHE SECTION (Formulaire / Newsletter)   --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <section class="w-full bg-[#ffffff] text-[#0e1626] py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 mb-3 bg-[#ffdc21]/20 px-3.5 py-1.5 rounded-full text-[#ccab00] font-bold text-xs uppercase tracking-wide">
                        {{ __('home.newsletter_badge') }}
                    </div>
                    <h2 class="text-3xl font-extrabold mb-4 uppercase tracking-tight" style="font-family: 'Poppins', sans-serif;">{{ __('home.newsletter_title') }}</h2>
                    <p class="text-[#475569] text-sm leading-relaxed mb-4 font-light" style="font-family: 'Poppins', sans-serif;">
                        {{ __('home.newsletter_subtitle') }}
                    </p>
                    <p class="text-[#94a3b8] text-xs">{{ __('home.newsletter_lock') }}</p>
                </div>

                <div class="w-full lg:w-96">
                    @if(session('newsletter_success'))
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center">
                            <div class="text-2xl mb-2">🎉</div>
                            <p class="font-bold text-emerald-800 text-sm mb-1">{{ __('home.newsletter_success_title') }}</p>
                            <p class="text-xs text-slate-500">{{ __('home.newsletter_success_desc') }}</p>
                        </div>
                    @elseif(session('newsletter_message'))
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                            <p class="text-xs text-yellow-800">{{ session('newsletter_message') }}</p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="space-y-4">
                            @csrf
                            <div>
                                <input type="text" name="name" placeholder="{{ __('home.newsletter_placeholder_name') }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#ffdc21] transition text-xs font-light" style="font-family: 'Poppins', sans-serif;">
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="{{ __('home.newsletter_placeholder_email') }}" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#ffdc21] transition text-xs font-light" style="font-family: 'Poppins', sans-serif;">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full py-3.5 bg-[#0e1626] hover:bg-[#1d2a44] text-white font-bold text-xs rounded-full transition shadow-xl uppercase tracking-wider" style="font-family: 'Poppins', sans-serif;">
                                {{ __('home.newsletter_btn') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>


</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- ANIMATION DES COMPTEURS ---
        const counters = document.querySelectorAll('.bff-counter');
        const speed = 200;

        const animateCounters = () => {
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText.replace('%', '').replace('+', '');
                    const suffix = counter.getAttribute('data-suffix') || '';
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc) + suffix;
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };
                updateCount();
            });
        };

        // Lancer l'animation quand la section devient visible
        const counterEl = document.querySelector('.bff-counter');
        if (counterEl) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = counterEl.parentElement.parentElement.parentElement.parentElement;
            observer.observe(statsSection);
        }
    });
</script>
@endpush
