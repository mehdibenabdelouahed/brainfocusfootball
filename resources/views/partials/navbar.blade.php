<header class="py-2 border-b border-slate-800 bg-slate-950 sticky top-0 z-[1000]" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-black italic tracking-tighter uppercase select-none transition-transform duration-200 hover:scale-[1.02] active:scale-[0.98] inline-block">
                <span class="text-amber-500">BRAIN</span><span class="text-white">FOCUS</span>
            </a>
        </div>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-wide">
            <a href="{{ route('articles.index') }}" 
               class="relative py-1 text-slate-300 hover:text-white transition duration-300 group {{ request()->routeIs('articles*') ? 'text-amber-400 font-bold' : '' }}">
                Nos articles
                <span class="absolute bottom-0 left-0 w-full h-[2px] transform origin-left transition-transform duration-300 bg-gradient-to-r from-amber-500 to-amber-400 {{ request()->routeIs('articles*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
            <a href="{{ route('talents') }}" 
               class="relative py-1 text-slate-300 hover:text-white transition duration-300 group {{ request()->routeIs('talents') ? 'text-amber-400 font-bold' : '' }}">
                Nos talents
                <span class="absolute bottom-0 left-0 w-full h-[2px] transform origin-left transition-transform duration-300 bg-gradient-to-r from-amber-500 to-amber-400 {{ request()->routeIs('talents') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
            <a href="{{ route('contact') }}" 
               class="relative py-1 text-slate-300 hover:text-white transition duration-300 group {{ request()->routeIs('contact') ? 'text-amber-400 font-bold' : '' }}">
                Contact
                <span class="absolute bottom-0 left-0 w-full h-[2px] transform origin-left transition-transform duration-300 bg-gradient-to-r from-amber-500 to-amber-400 {{ request()->routeIs('contact') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
        </nav>

        {{-- Auth Buttons / User Menu --}}
        <div class="flex items-center gap-2 text-xs">
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" 
                            class="flex items-center gap-2 px-3.5 py-2 rounded-full bg-slate-900/80 border border-slate-800 hover:border-amber-500/40 hover:bg-slate-800/80 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-300 select-none">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full object-cover">
                        @else
                            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 text-slate-950 flex items-center justify-center font-black text-[10px] shadow">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="hidden md:inline font-bold text-slate-300">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                         class="absolute right-0 mt-2.5 w-60 bg-slate-900/95 backdrop-blur-md border border-slate-800/80 rounded-2xl shadow-2xl z-[9999] p-1.5" x-cloak>
                         
                        <div class="px-3.5 py-3 border-b border-slate-800/60 mb-1">
                            <p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            @if(Auth::user()->is_admin)
                                <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                    Administrateur
                                </span>
                            @elseif(Auth::user()->isRecruiter())
                                <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-sky-500/10 text-sky-400 border border-sky-500/20">
                                    Recruteur
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 rounded-full text-[9px] font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    Joueur
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-800/60 hover:text-white transition duration-200">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Tableau de bord
                        </a>
                        <a href="{{ route('profile.show', Auth::id()) }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-800/60 hover:text-white transition duration-200">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Voir mon profil
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-800/60 hover:text-white transition duration-200">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Éditer mon profil
                        </a>
                        @if(Auth::user()->is_admin)
                            <div class="border-t border-slate-800/60 my-1"></div>
                            <a href="{{ route('admin.articles.index') }}" 
                               class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-amber-400 hover:bg-amber-500/10 transition duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Admin — Articles
                            </a>
                        @endif
                        <div class="border-t border-slate-800/60 my-1"></div>
                        <a href="{{ route('logout') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition duration-200 w-full text-left">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Déconnexion
                        </a>
                    </div>
                </div>
            @else
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 rounded-full border border-slate-700 text-slate-200 hover:text-amber-300 hover:border-amber-400/60 transition duration-300 font-bold">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 rounded-full font-black bg-amber-500 hover:bg-amber-400 shadow-md shadow-amber-500/20 text-slate-950 transition duration-300">
                        Créer un profil
                    </a>
                </div>
            @endauth

            {{-- Hamburger Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-400 hover:text-amber-400 transition" aria-label="Menu">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.outside="mobileMenuOpen = false"
         class="md:hidden bg-slate-900 border-t border-slate-800 px-4 py-6 space-y-4"
         x-cloak>
        <a href="{{ route('articles.index') }}" class="block text-lg font-bold text-slate-200 hover:text-amber-400 transition">Nos articles</a>
        <a href="{{ route('talents') }}" class="block text-lg font-bold text-slate-200 hover:text-amber-400 transition">Nos talents</a>
        <a href="{{ route('contact') }}" class="block text-lg font-bold text-slate-200 hover:text-amber-400 transition">Contact</a>
        
        @guest
            <div class="pt-6 border-t border-slate-800 flex flex-col gap-3">
                <a href="{{ route('login') }}" class="w-full py-4 text-center rounded-2xl border border-slate-700 text-slate-200 font-bold hover:border-amber-500 transition">Connexion</a>
                <a href="{{ route('register') }}" class="w-full py-4 text-center rounded-2xl bg-amber-500 text-slate-950 font-black shadow-lg shadow-amber-500/20">Créer un profil</a>
            </div>
        @endguest

        @auth
            <div class="pt-6 border-t border-slate-800 space-y-4">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Mon Compte</p>
                <a href="{{ route('dashboard') }}" class="block text-base text-slate-300 hover:text-amber-400 transition px-1">Tableau de bord</a>
                <a href="{{ route('profile.show', Auth::id()) }}" class="block text-base text-slate-300 hover:text-amber-400 transition px-1">Voir mon profil</a>
                <a href="{{ route('profile.edit') }}" class="block text-base text-slate-300 hover:text-amber-400 transition px-1">Éditer mon profil</a>
                <a href="{{ route('logout') }}" class="w-full py-3 text-left px-1 text-red-400 font-bold block">
                    Déconnexion
                </a>
            </div>
        @endauth
    </div>
</header>
