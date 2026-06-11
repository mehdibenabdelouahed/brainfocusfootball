<div x-data="{ drawerOpen: false, scrolled: false }"
     @scroll.window="scrolled = window.scrollY > 20"
     class="w-full">

<header class="{{ Request::is(app()->getLocale()) || Request::is(app()->getLocale().'/') ? 'fixed top-0 left-0 w-full z-[1000] py-1 transition-all duration-300' : 'bff-navbar sticky top-0 z-[1000] py-1' }}" 
        @if(Request::is(app()->getLocale()) || Request::is(app()->getLocale().'/')) :class="scrolled ? 'bg-[#0e1626]/95 backdrop-blur-md border-b border-white/5 shadow-lg' : 'bg-transparent border-none'" @endif>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 select-none transition-transform duration-200 hover:scale-[1.02] active:scale-[0.98]">
                <img src="/images/logoBFF.png" alt="Brain Focus Football" class="h-10 md:h-12 w-auto">
                <div class="block">
                    <span class="text-lg sm:text-xl md:text-2xl font-black italic tracking-tighter uppercase leading-none" style="font-family: 'Poppins', sans-serif;">
                        <span class="text-amber-400">BRAIN</span><span class="text-white">FOCUS</span>
                    </span>
                </div>
            </a>
        </div>

        {{-- Right Items (Lang Switcher + Auth + Hamburger) --}}
        <div class="flex items-center gap-4 text-xs">

            {{-- ═══ Language Switcher ═══ --}}
            <div class="relative" x-data="{ langOpen: false }">
                <button @click="langOpen = !langOpen" type="button"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-full border border-white/10 hover:border-[#ffdc21]/40 hover:bg-white/5 transition-all duration-300 select-none text-white/70 hover:text-white">
                    <span class="text-sm">@if(app()->getLocale() === 'fr')🇫🇷@elseif(app()->getLocale() === 'en')🇬🇧@else🇧🇪@endif</span>
                    <span class="hidden sm:inline text-[10px] font-bold uppercase tracking-wider">{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="w-3 h-3 text-white/40 transition-transform duration-300" :class="langOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="langOpen" @click.outside="langOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                     class="absolute right-0 mt-2.5 w-40 bg-[#0e1626] border border-white/10 rounded-xl shadow-2xl z-[9999] p-1.5 overflow-hidden" x-cloak>

                    @php
                        $currentRoute = Route::currentRouteName();
                        $currentParams = Route::current()->parameters();
                    @endphp

                    <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'fr'])) }}"
                       @click="langOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold transition duration-200 {{ app()->getLocale() === 'fr' ? 'bg-[#ffdc21]/10 text-[#ffdc21]' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="text-base">🇫🇷</span>
                        <span>Français</span>
                        @if(app()->getLocale() === 'fr')
                            <svg class="w-3.5 h-3.5 ml-auto text-[#ffdc21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </a>
                    <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'en'])) }}"
                       @click="langOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold transition duration-200 {{ app()->getLocale() === 'en' ? 'bg-[#ffdc21]/10 text-[#ffdc21]' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="text-base">🇬🇧</span>
                        <span>English</span>
                        @if(app()->getLocale() === 'en')
                            <svg class="w-3.5 h-3.5 ml-auto text-[#ffdc21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </a>
                    <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'nl'])) }}"
                       @click="langOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold transition duration-200 {{ app()->getLocale() === 'nl' ? 'bg-[#ffdc21]/10 text-[#ffdc21]' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="text-base">🇧🇪</span>
                        <span>Nederlands</span>
                        @if(app()->getLocale() === 'nl')
                            <svg class="w-3.5 h-3.5 ml-auto text-[#ffdc21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </a>
                </div>
            </div>

            {{-- Auth Buttons / User Menu --}}
            <div class="flex items-center gap-2">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" 
                                class="flex items-center gap-2 px-4 py-2.5 rounded-full border border-transparent hover:border-amber-400/40 hover:bg-white/5 transition-all duration-300 select-none">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-full object-cover border border-white/20">
                            @else
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 text-slate-950 flex items-center justify-center font-black text-[10px] shadow">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="hidden md:inline font-semibold text-white/80" style="font-family: 'Poppins', sans-serif; letter-spacing: 0.05em;">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white/40 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                             class="absolute right-0 mt-2.5 w-60 bg-[#0e1626] rounded-2xl shadow-2xl z-[9999] p-1.5" x-cloak>
                             
                            <div class="px-3.5 py-3 border-b border-white/8 mb-1">
                                <p class="font-bold text-sm text-white">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-white/40 truncate mt-0.5">{{ Auth::user()->email }}</p>
                                @if(Auth::user()->is_admin)
                                    <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-amber-400/10 text-amber-400 border border-amber-400/20">
                                        {{ __('nav.administrator') }}
                                    </span>
                                @elseif(Auth::user()->isRecruiter())
                                    <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-sky-500/10 text-sky-400 border border-sky-500/20">
                                        {{ __('nav.recruiter') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        {{ __('nav.player') }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-white/60 hover:bg-white/5 hover:text-white transition duration-200">
                                <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('nav.dashboard') }}
                            </a>
                            <a href="{{ route('profile.show', Auth::id()) }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-white/60 hover:bg-white/5 hover:text-white transition duration-200">
                                <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('nav.my_profile') }}
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-white/60 hover:bg-white/5 hover:text-white transition duration-200">
                                <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('nav.edit_profile') }}
                            </a>
                            @if(Auth::user()->is_admin)
                                <div class="border-t border-white/8 my-1"></div>
                                <a href="{{ route('admin.articles.index') }}" 
                                   class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-amber-400 hover:bg-amber-500/10 transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    {{ __('nav.admin_articles') }}
                                 </a>
                            @endif
                            <div class="border-t border-white/8 my-1"></div>
                            <a href="{{ route('logout') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition duration-200 w-full text-left">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('nav.logout') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center gap-3">
                        <a href="{{ route('login') }}" 
                           class="px-6 py-2.5 rounded-full border border-white/20 text-white/80 hover:text-[#0e1626] hover:bg-[#ffdc21] hover:border-[#ffdc21] transition duration-300 font-semibold uppercase tracking-wider" style="font-family: 'Poppins', sans-serif; font-size: 0.75rem;">
                            {{ __('nav.login') }}
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-6 py-2.5 rounded-full font-bold bg-[#ffdc21] hover:bg-[#ffe661] text-[#0e1626] transition duration-300 uppercase tracking-wider bff-btn-main" style="font-family: 'Poppins', sans-serif; font-size: 0.75rem;">
                            {{ __('nav.register') }}
                        </a>
                    </div>
                @endauth
            </div>

            {{-- Hamburger Button (Universal) --}}
            <button @click="drawerOpen = true" class="flex flex-col items-end gap-1.5 p-2 text-white/70 hover:text-[#ffdc21] group transition-all duration-300" aria-label="Menu">
                <span class="w-6 h-[2px] bg-current transition-all duration-300"></span>
                <span class="w-4 h-[2px] bg-current transition-all duration-300 group-hover:w-6"></span>
                <span class="w-6 h-[2px] bg-current transition-all duration-300"></span>
            </button>
        </div>
    </div>

</header>

    {{-- Side Drawer Navigation Menu (Slides from the Right) --}}
    <div x-show="drawerOpen" class="fixed inset-0 z-[10000]" x-cloak>
        {{-- Backdrop overlay --}}
        <div x-show="drawerOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="drawerOpen = false" 
             class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>

        {{-- Drawer Panel --}}
        <div x-show="drawerOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed right-0 top-0 bottom-0 w-full sm:w-[440px] bg-white border-l border-slate-100 shadow-2xl z-50 flex flex-col justify-between"
             @click.outside="drawerOpen = false">
             
             {{-- Drawer Content --}}
             <div class="p-8 overflow-y-auto flex-1">
                 {{-- Drawer Header (Close X button + MENU label) --}}
                 <div class="flex flex-col gap-4 pb-6 border-b border-slate-100 mb-6">
                     {{-- Close icon row --}}
                     <div class="flex justify-start">
                         <button @click="drawerOpen = false" class="p-1.5 -ml-1.5 text-slate-400 hover:text-slate-900 transition-colors rounded-full hover:bg-slate-100" aria-label="{{ __('nav.close_menu') }}">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                             </svg>
                         </button>
                     </div>
                     {{-- Menu row --}}
                     <div class="flex items-baseline gap-3">
                         <span class="text-xl font-black uppercase text-slate-950 tracking-wider" style="font-family: 'Poppins', sans-serif;">{{ __('nav.menu') }}</span>
                     </div>
                 </div>

                 {{-- Navigation List --}}
                 <nav class="space-y-1" x-data="{ servicesOpen: false }">
                     {{-- Dropdown block for NOS SERVICES --}}
                     <div>
                         <button @click="servicesOpen = !servicesOpen" 
                                 class="group flex items-center justify-between w-full py-4 border-b border-slate-100 text-base font-extrabold text-slate-900 hover:text-amber-500 transition-all duration-300" 
                                 style="font-family: 'Poppins', sans-serif; letter-spacing: 0.05em;">
                             <span>{{ strtoupper(__('nav.services')) }}</span>
                             <svg class="w-4 h-4 text-slate-300 group-hover:text-amber-500 transition-transform duration-300" :class="servicesOpen ? 'rotate-90 text-amber-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                             </svg>
                         </button>
                         
                         <div x-show="servicesOpen" 
                              x-transition:enter="transition ease-out duration-300"
                              x-transition:enter-start="opacity-0 transform -translate-y-2"
                              x-transition:enter-end="opacity-100 transform translate-y-0"
                              x-transition:leave="transition ease-in duration-200"
                              x-transition:leave-start="opacity-100 transform translate-y-0"
                              x-transition:leave-end="opacity-0 transform -translate-y-2"
                              class="pl-4 border-l border-slate-100 mt-1 space-y-0.5 overflow-hidden" x-cloak>
                             
                             <a href="{{ route('home') }}#nos-services" 
                                @click="drawerOpen = false; $dispatch('go-to-service', 0)"
                                class="block py-2 text-xs font-bold text-slate-500 hover:text-amber-500 transition duration-200 uppercase tracking-widest">
                                {{ __('nav.talent_base') }}
                             </a>
                             <a href="{{ route('home') }}#nos-services" 
                                @click="drawerOpen = false; $dispatch('go-to-service', 1)"
                                class="block py-2 text-xs font-bold text-slate-500 hover:text-amber-500 transition duration-200 uppercase tracking-widest">
                                {{ __('nav.digital_profile') }}
                             </a>
                         </div>
                     </div>
                     
                     <a href="{{ route('articles.index') }}" 
                        @click="drawerOpen = false"
                        class="group flex items-center justify-between py-4 border-b border-slate-100 text-base font-extrabold text-slate-900 hover:text-amber-500 transition-all duration-300" 
                        style="font-family: 'Poppins', sans-serif; letter-spacing: 0.05em;">
                         <span>{{ strtoupper(__('nav.articles')) }}</span>
                         <svg class="w-4 h-4 text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                         </svg>
                     </a>

                     <a href="{{ route('about') }}" 
                        @click="drawerOpen = false"
                        class="group flex items-center justify-between py-4 border-b border-slate-100 text-base font-extrabold text-slate-900 hover:text-amber-500 transition-all duration-300" 
                        style="font-family: 'Poppins', sans-serif; letter-spacing: 0.05em;">
                         <span>{{ strtoupper(__('nav.about')) }}</span>
                         <svg class="w-4 h-4 text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                         </svg>
                     </a>

                     <a href="{{ route('contact') }}" 
                        @click="drawerOpen = false"
                        class="group flex items-center justify-between py-4 border-b border-slate-100 text-base font-extrabold text-slate-900 hover:text-amber-500 transition-all duration-300" 
                        style="font-family: 'Poppins', sans-serif; letter-spacing: 0.05em;">
                         <span>{{ strtoupper(__('nav.contact')) }}</span>
                         <svg class="w-4 h-4 text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                         </svg>
                     </a>
                 </nav>
             </div>

             {{-- Drawer Footer (Auth Buttons for mobile/secondary) --}}
             <div class="p-8 border-t border-slate-100 bg-slate-50/80">
                 @guest
                     <div class="flex flex-col gap-3">
                         <a href="{{ route('login') }}" 
                            @click="drawerOpen = false"
                            class="w-full py-3.5 text-center border border-slate-200 text-slate-800 font-bold uppercase tracking-widest hover:bg-slate-100 transition duration-300 rounded-xl text-xs" 
                            style="font-family: 'Poppins', sans-serif;">
                             {{ __('nav.login') }}
                         </a>
                         <a href="{{ route('register') }}" 
                            @click="drawerOpen = false"
                            class="w-full py-3.5 text-center bg-slate-950 hover:bg-amber-400 text-white hover:text-slate-950 font-bold uppercase tracking-widest transition duration-300 rounded-xl shadow-lg shadow-slate-950/10 text-xs" 
                            style="font-family: 'Poppins', sans-serif;">
                             {{ __('nav.register') }}
                         </a>
                     </div>
                 @else
                     <div class="space-y-4">
                         <div class="flex items-center gap-3 px-1">
                             @if(Auth::user()->profile_photo)
                                 <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                             @else
                                 <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 text-slate-950 flex items-center justify-center font-black text-xs shadow-sm">
                                     {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                 </div>
                             @endif
                             <div>
                                 <p class="font-bold text-xs text-slate-800" style="font-family: 'Poppins', sans-serif;">{{ Auth::user()->name }}</p>
                                 <p class="text-[9px] text-amber-500 uppercase tracking-widest font-black">{{ __('nav.my_account') }}</p>
                             </div>
                         </div>
                         <div class="grid grid-cols-2 gap-2 text-center text-[10px] uppercase font-bold tracking-widest">
                             <a href="{{ route('dashboard') }}" @click="drawerOpen = false" class="py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg text-slate-700 transition">{{ __('nav.dashboard') }}</a>
                             <a href="{{ route('logout') }}" @click="drawerOpen = false" class="py-3 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg text-red-600 transition">{{ __('nav.logout') }}</a>
                         </div>
                     </div>
                 @endguest
             </div>
        </div>
    </div>
</div>
