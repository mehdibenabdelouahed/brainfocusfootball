<header class="py-2 border-b border-slate-800 bg-slate-950 sticky top-0 z-[1000]" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/images/logoBFF.png" alt="Logo Brain Focus Football" class="w-16 h-16 md:w-24 md:h-24 object-contain">
                <div class="leading-tight text-sm hidden sm:block">
                    <p class="font-bold text-[18px] md:text-[28px]">Brain Focus Football</p>
                    <p class="text-[10px] md:text-[14px] text-slate-400">Les champions commencent par l'esprit</p>
                </div>
            </a>
        </div>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('articles.index') }}" class="hover:text-amber-400 {{ request()->routeIs('articles*') ? 'text-amber-400' : '' }}">Nos articles</a>
            <a href="{{ route('talents') }}" class="hover:text-amber-400 {{ request()->routeIs('talents') ? 'text-amber-400' : '' }}">Nos talents</a>
            <a href="{{ route('contact') }}" class="hover:text-amber-400 {{ request()->routeIs('contact') ? 'text-amber-400' : '' }}">Contact</a>
        </nav>

        {{-- Auth Buttons / User Menu --}}
        <div class="flex items-center gap-2 text-xs">
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 transition">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full object-cover">
                        @else
                            <div class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center text-slate-950 font-bold text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="hidden md:inline text-slate-200">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-56 bg-slate-800 border border-amber-500/30 rounded-xl shadow-2xl z-[9999] py-2" x-cloak>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Tableau de bord
                        </a>
                        <a href="{{ route('profile.show', Auth::id()) }}" class="flex items-center gap-2 px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Voir mon profil
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Éditer mon profil
                        </a>
                        @if(Auth::user()->is_admin)
                            <div class="border-t border-slate-700 my-1"></div>
                            <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-amber-400 hover:bg-amber-500/20 transition font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Admin — Articles
                            </a>
                        @endif
                        <div class="border-t border-slate-700 my-1"></div>
                        <a href="{{ route('logout') }}" class="flex items-center gap-2 w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-500/20 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Déconnexion
                        </a>
                    </div>
                </div>
            @else
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition bff-btn-main">
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
