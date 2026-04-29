<section class="max-w-4xl mx-auto px-4 py-12 bff-reveal">
    <div class="relative bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 border border-slate-700/60 rounded-3xl p-8 md:p-10 overflow-hidden">
        {{-- Glow décoratif --}}
        <div class="absolute -top-20 -right-20 w-60 h-60 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-8">
            {{-- Texte --}}
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <p class="text-xs text-amber-400 font-bold uppercase tracking-widest">Newsletter hebdomadaire</p>
                </div>
                <h2 class="text-2xl md:text-3xl font-black mb-3">
                    1 conseil par semaine<br>
                    <span class="text-amber-400">pour avancer dans ta carrière</span>
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed mb-2">
                    Mental, nutrition, recrutement, coaching… Reçois chaque semaine ce que les pros savent et que personne ne t'a dit.
                </p>
                <p class="text-slate-500 text-xs">🚀 Zéro spam. Désinscription en un clic.</p>
            </div>

            {{-- Formulaire --}}
            <div class="w-full md:w-80 flex-shrink-0">
                @if(session('newsletter_success'))
                    <div class="bg-green-500/15 border border-green-500/30 rounded-2xl p-6 text-center">
                        <div class="text-3xl mb-2">🎉</div>
                        <p class="font-bold text-green-300 mb-1">Tu es inscrit(e) !</p>
                        <p class="text-xs text-slate-400">Vérifie ta boîte email pour le message de bienvenue.</p>
                    </div>
                @elseif(session('newsletter_message'))
                    <div class="bg-amber-500/10 border border-amber-500/30 rounded-2xl p-6 text-center">
                        <p class="text-sm text-amber-300">{{ session('newsletter_message') }}</p>
                    </div>
                @else
                    <form method="POST" action="{{ route('newsletter.subscribe') }}" class="space-y-3">
                        @csrf
                        <div>
                            <input type="text" name="name" placeholder="Ton prénom (optionnel)"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition text-sm">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="ton@email.com" required
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition text-sm">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition shadow-lg shadow-amber-500/20">
                            Je m'abonne gratuitement →
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>
