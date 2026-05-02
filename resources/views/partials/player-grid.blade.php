{{-- Grille de joueurs --}}
@if($players->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($players as $user)
            @php $player = $user->player; @endphp
            @if(!$player) @continue @endif
            <div class="group bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/10">
                {{-- Photo de profil --}}
                <div class="aspect-[4/3] overflow-hidden relative bg-slate-800">
                    @if($player->profile_photo)
                        <img src="{{ asset('storage/' . $player->profile_photo) }}" 
                             alt="{{ $player->first_name }} {{ $player->last_name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-800 text-slate-600">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Badge Position --}}
                    @if($player->position)
                        <div class="absolute top-3 right-3 bg-slate-950/80 backdrop-blur-sm border border-slate-700 px-3 py-1 rounded-full">
                            <span class="text-xs font-bold text-amber-400">{{ $player->position }}</span>
                        </div>
                    @endif
                </div>

                {{-- Informations --}}
                <div class="p-5">
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-amber-400 transition-colors">
                        {{ $player->first_name }} {{ $player->last_name }}
                    </h3>
                    
                    <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-8a2 2 0 012-2h6.5l1 1H21l-3 6H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                        <span>{{ $player->current_club ?? 'Sans club' }}</span>
                    </div>

                    {{-- Stats rapides --}}
                    <div class="grid grid-cols-3 gap-2 mb-5 py-3 border-y border-slate-800">
                        <div class="text-center">
                            <span class="block text-xs text-slate-500">Âge</span>
                            <span class="font-semibold text-slate-300">
                                {{ $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->age : '-' }}
                            </span>
                        </div>
                        <div class="text-center border-l border-slate-800">
                            <span class="block text-xs text-slate-500">Pied</span>
                            <span class="font-semibold text-slate-300">
                                {{ $player->dominant_foot ? substr($player->dominant_foot, 0, 1) : '-' }}
                            </span>
                        </div>
                        <div class="text-center border-l border-slate-800">
                            <span class="block text-xs text-slate-500">Taille</span>
                            <span class="font-semibold text-slate-300">
                                {{ $player->height_cm ? $player->height_cm . 'cm' : '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex gap-2">
                        <a href="{{ route('profile.show', $user->id) }}" 
                           class="flex-1 py-2.5 text-center rounded-xl bg-slate-800 hover:bg-amber-500 text-slate-300 hover:text-slate-950 font-semibold transition-all duration-300">
                            Voir le profil
                        </a>
                        <button @click="$dispatch('toggle-compare', { id: {{ $user->id }}, name: '{{ $player->first_name }} {{ $player->last_name }}', photo: '{{ $player->profile_photo ? asset('storage/' . $player->profile_photo) : '' }}' })"
                                :class="isInCompare({{ $user->id }}) ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-400 hover:bg-slate-700'"
                                class="p-2.5 rounded-xl transition-all duration-300 group/comp"
                                title="Comparer ce joueur">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </button>

                        {{-- Bouton Favori (uniquement pour les recruteurs) --}}
                        @auth
                            @if(auth()->user()->isRecruiter() && auth()->user()->recruiter)
                                @php
                                    $isFav = auth()->user()->recruiter->favoritePlayers->contains($player->id);
                                @endphp
                                <button 
                                    onclick="toggleFavorite(this, {{ $player->id }})"
                                    data-player-id="{{ $player->id }}"
                                    data-is-fav="{{ $isFav ? '1' : '0' }}"
                                    class="p-2.5 rounded-xl transition-all duration-300 {{ $isFav ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-400 hover:bg-amber-500/20 hover:text-amber-400' }}"
                                    title="{{ $isFav ? 'Retirer des favoris' : 'Ajouter aux favoris' }}">
                                    <svg class="w-5 h-5" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Script JS pour le toggle favoris --}}
    @once
    @push('scripts')
    <script>
        function toggleFavorite(btn, playerId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const isFav = btn.dataset.isFav === '1';
            
            fetch(`/favorites/toggle`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ player: playerId })
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    if (res.status === 403 && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert(data.message || 'Une erreur est survenue.');
                    }
                    throw new Error('Erreur');
                }
                return data;
            })
            .then(data => {
                const newIsFav = data.status === 'added';
                btn.dataset.isFav = newIsFav ? '1' : '0';
                btn.title = newIsFav ? 'Retirer des favoris' : 'Ajouter aux favoris';
                
                const svg = btn.querySelector('svg');
                if (newIsFav) {
                    btn.classList.remove('bg-slate-800', 'text-slate-400', 'hover:bg-amber-500/20', 'hover:text-amber-400');
                    btn.classList.add('bg-amber-500', 'text-slate-950');
                    svg.setAttribute('fill', 'currentColor');
                } else {
                    btn.classList.remove('bg-amber-500', 'text-slate-950');
                    btn.classList.add('bg-slate-800', 'text-slate-400', 'hover:bg-amber-500/20', 'hover:text-amber-400');
                    svg.setAttribute('fill', 'none');
                }
                
                // Toast notification
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl font-semibold text-sm shadow-xl transition-all ' + (newIsFav ? 'bg-amber-500 text-slate-950' : 'bg-slate-700 text-white');
                toast.textContent = data.message;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            })
            .catch(() => {});
        }
    </script>
    @endpush
    @endonce

    {{-- Pagination --}}
    <div class="mt-12 ajax-pagination">
        {{ $players->links() }}
    </div>

@else
    {{-- État vide --}}
    <div class="text-center py-20 bg-slate-900/30 rounded-3xl border border-slate-800 border-dashed">
        <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Aucun joueur trouvé</h3>
        <p class="text-slate-400 mb-6">Essayez d'ajuster vos filtres pour voir plus de profils.</p>
        <a href="{{ route('talents') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold transition">
            Réinitialiser les filtres
        </a>
    </div>
@endif
