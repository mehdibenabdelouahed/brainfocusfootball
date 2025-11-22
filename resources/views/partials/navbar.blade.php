<header class="py-2 border-b border-slate-800 bg-slate-950/80 backdrop-blur fixed w-full top-0 z-[1000]">
    <div class="max-w-6xl mx-auto px-4 py-2 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/images/logoBFF.png" alt="Logo Brain Focus Football" class="w-14 h-14 object-contain">
                <div class="leading-tight text-sm">
                    <p class="font-semibold text-[23px]">Brain Focus Football</p>
                    <p class="text-[12px] text-slate-400">Les champions commencent par l'esprit</p>
                </div>
            </a>
        </div>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('articles.index') }}" class="hover:text-amber-400 {{ request()->routeIs('articles.*') ? 'text-amber-400' : '' }}">Nos articles</a>
            <a href="{{ route('player.profile') }}" class="hover:text-amber-400 {{ request()->routeIs('player.profile') ? 'text-amber-400' : '' }}">Nos talents</a>
            <a href="{{ route('contact') }}" class="hover:text-amber-400 {{ request()->routeIs('contact') ? 'text-amber-400' : '' }}">Contact</a>
        </nav>

        {{-- Auth Buttons / User Menu --}}
        <div class="flex items-center gap-2 text-xs">
            @auth
                {{-- Menu utilisateur connecté (Alpine.js) --}}
                <div class="relative isolate z-[10000]" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false" type="button" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 transition">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full object-cover">
                        @else
                            <div class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center text-slate-950 font-bold text-xs">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="text-slate-200">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    {{-- Dropdown menu --}}
                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-slate-900 backdrop-blur-md border-2 border-amber-500/50 rounded-xl shadow-2xl z-[9999]">
                        <div class="py-2">
                            <a href="{{ route('profile.show', Auth::id()) }}" class="block px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                                Voir mon profil
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-white hover:bg-amber-500/20 hover:text-amber-300 transition">
                                Éditer mon profil
                            </a>
                            @if(!Auth::user()->profile_completed)
                                <a href="{{ route('profile.create') }}" class="block px-4 py-3 text-sm text-amber-300 hover:bg-amber-500/20 transition font-semibold">
                                    Compléter mon profil
                                </a>
                            @endif
                            <div class="border-t border-slate-600 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-500/20 transition font-semibold">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-3 py-1.5 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="px-3 py-1.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition bff-btn-main">
                    Créer un profil
                </a>
            @endauth
        </div>
    </div>
</header>
