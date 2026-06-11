@extends('layouts.app')

@section('title', __('about.meta_title'))

@section('content')
<div class="min-h-screen bg-[#0e1626] text-white flex flex-col">
    
    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- Wrapper with père-fils background covering Hero + Story --}}
    <div class="relative overflow-hidden">
        {{-- Background image père-fils covering both sections --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="/images/home/père-fils.jpg" alt="" class="w-full h-full object-cover" style="filter: brightness(0.75) saturate(0.9); object-position: center 65%; transform: scale(1.5);">
        </div>
        {{-- Overlay gradient for readability --}}
        <div class="absolute inset-0 z-0" style="background: linear-gradient(180deg, rgba(14,22,38,0.8) 0%, rgba(14,22,38,0.6) 30%, rgba(14,22,38,0.5) 60%, rgba(14,22,38,0.35) 100%);"></div>

    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden flex items-center justify-center z-10">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-400/5 rounded-full blur-[100px] z-0"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-amber-400/5 rounded-full blur-[100px] z-0"></div>
        
        <div class="relative max-w-5xl mx-auto px-6 text-center z-10">
            <span class="text-[11px] font-black uppercase text-amber-400 tracking-[0.3em] mb-4 block" style="font-family: 'Poppins', sans-serif;">{{ __('about.our_vision') }}</span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black uppercase tracking-tight mb-6 leading-none" style="font-family: 'Poppins', sans-serif;">
                {!! __('about.story_title', ['brand' => '<span class="text-amber-400">Brain Focus</span> Football']) !!}
            </h1>
            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto font-light leading-relaxed" style="font-family: 'Poppins', sans-serif;">
                {{ __('about.hero_desc') }}
            </p>
        </div>
    </section>

    {{-- Story Section --}}
    <section class="py-16 md:py-24 relative z-10">
        
        <div class="relative z-10 mx-auto px-6" style="max-width: 1280px; padding-left: 18%; padding-right: 22%;">
            <div class="space-y-6">
                    <h2 class="text-2xl md:text-3xl font-black uppercase text-white tracking-wide" style="font-family: 'Poppins', sans-serif;">
                        {!! __('about.why_title', ['brand' => '<span class="text-amber-400">Brain Focus Football</span>']) !!}
                    </h2>
                    <p class="text-slate-200 font-light leading-relaxed text-sm sm:text-base">
                        {{ __('about.why_p1') }}
                    </p>
                    <p class="text-slate-200 font-light leading-relaxed text-sm sm:text-base">
                        {!! __('about.why_p2', ['brand' => '<strong>Brain Focus Football</strong>']) !!}
                    </p>
            </div>
        </div>
    </section>
    </div> {{-- End wrapper père-fils background --}}

    {{-- Team Section --}}
    <section class="py-16 md:py-24 bg-white border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black uppercase text-slate-900 tracking-wide" style="font-family: 'Poppins', sans-serif;">
                    {{ __('about.team_title') }}
                </h2>
                <p class="text-slate-500 text-sm max-w-xl mx-auto mt-2 font-light">
                    {{ __('about.team_desc') }}
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Team Member 1 - Abdallah --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Abdallah Bridi</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_founder') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.abdallah_desc') }}
                    </p>
                </div>

                {{-- Team Member 2 - Iliass --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Iliass Maayoufi</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_cofounder') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.iliass_desc') }}
                    </p>
                </div>

                {{-- Team Member 3 - Mehdi --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Mehdi Benabdelouahed</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_developer') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.mehdi_desc') }}
                    </p>
                </div>

                {{-- Team Member 4 - Lilia --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Lilia Bridi</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_community_manager') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.lilia_desc') }}
                    </p>
                </div>

                {{-- Team Member 5 - Camellia --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Camellia Bridi</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_community_manager') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.camellia_desc') }}
                    </p>
                </div>

                {{-- Team Member 6 - Leïsa --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center text-center shadow-lg hover:translate-y-[-4px] hover:border-amber-400 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-transform duration-300 select-none">
                        <span class="text-slate-950 font-black text-[9px] uppercase tracking-wider italic" style="font-family: 'Poppins', sans-serif;">brain<span class="text-white">focus</span></span>
                    </div>
                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-wide" style="font-family: 'Poppins', sans-serif;">Leïsa Chouaten</h3>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest mt-1 block">{{ __('about.role_project_manager') }}</span>
                    <p class="text-slate-500 text-xs mt-4 leading-relaxed font-light">
                        {{ __('about.leisa_desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer/CTA Section --}}
    <section class="py-16 md:py-24 bg-slate-50 border-t border-slate-200 flex-1 flex flex-col justify-center">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-black uppercase text-slate-900 mb-6" style="font-family: 'Poppins', sans-serif;">
                {{ __('about.cta_title') }}
            </h2>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3.5 bg-slate-900 hover:bg-amber-400 text-white hover:text-slate-950 font-bold uppercase tracking-wider rounded-full bff-btn-main shadow-lg text-xs transition duration-300">
                    {{ __('about.cta_join') }}
                </a>
                <a href="{{ route('contact') }}" class="px-8 py-3.5 border border-slate-300 hover:border-amber-400 text-slate-700 font-bold uppercase tracking-wider rounded-full hover:bg-amber-50 text-xs transition duration-300">
                    {{ __('about.cta_contact') }}
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
