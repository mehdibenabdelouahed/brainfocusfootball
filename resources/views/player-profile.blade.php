@extends('layouts.app')

@section('title', __('profile.talent_gallery_title'))

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    
    {{-- NAVBAR --}}
    @include('partials.navbar')

    <div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        {{-- En-tête --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">
                {{ __('profile.talent_gallery_header') }}
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto">
                {{ __('profile.talent_gallery_subheader') }}
            </p>
        </div>

        {{-- Bandeau de quota pour les recruteurs --}}
        @if(isset($quotaInfo) && $quotaInfo)
            <div class="mb-6 bg-slate-900/60 border rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4
                {{ $quotaInfo['remaining'] === null ? 'border-emerald-500/30' : ($quotaInfo['remaining'] > 5 ? 'border-sky-500/30' : ($quotaInfo['remaining'] > 0 ? 'border-amber-500/30' : 'border-red-500/30')) }}">
                <div class="flex items-center gap-3">
                    @if($quotaInfo['remaining'] === null)
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-emerald-400">{{ __('profile.quota_unlimited', ['plan' => $quotaInfo['plan']]) }}</p>
                        </div>
                    @elseif($quotaInfo['remaining'] > 0)
                        <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">
                                <span class="{{ $quotaInfo['remaining'] > 5 ? 'text-sky-400' : 'text-amber-400' }}">
                                    {{ trans_choice('profile.quota_remaining', $quotaInfo['remaining'], ['remaining' => $quotaInfo['remaining']]) }}
                                </span> 
                                <span class="text-slate-500">{{ __('profile.quota_used_limit', ['used' => $quotaInfo['used'], 'limit' => $quotaInfo['limit']]) }}</span>
                            </p>
                            <p class="text-[10px] text-slate-500">{{ __('profile.quota_plan', ['plan' => $quotaInfo['plan']]) }}</p>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-red-400">{{ __('profile.quota_reached', ['used' => $quotaInfo['used'], 'limit' => $quotaInfo['limit']]) }}</p>
                            <p class="text-[10px] text-slate-500">{{ __('profile.quota_reached_sub', ['plan' => $quotaInfo['plan']]) }}</p>
                        </div>
                    @endif
                </div>
                @if($quotaInfo['remaining'] !== null)
                    <a href="{{ route('pricing') }}" class="px-4 py-2 text-xs font-bold rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 transition whitespace-nowrap active:scale-95">
                        {{ __('profile.increase_quota') }}
                    </a>
                @endif
            </div>
        @endif

        {{-- Filtres --}}
        <div class="bg-slate-900/60 border border-slate-800 rounded-3xl p-6 mb-10 bff-reveal">
            <form action="{{ route('talents') }}" method="GET">
                {{-- Barre de recherche --}}
                <div class="mb-6">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full bg-slate-800/50 border-slate-700 rounded-2xl py-3.5 pl-12 text-white placeholder-slate-500 focus:ring-amber-500 focus:border-amber-500 transition shadow-inner"
                            placeholder="{{ __('profile.search_placeholder') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    {{-- Poste --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('profile.position') }}</label>
                        <select name="position" class="w-full bg-slate-800 border-slate-700 rounded-xl text-slate-200 text-sm focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">{{ __('profile.all_positions') }}</option>
                            @foreach($positions as $pos)
                                <option value="{{ $pos }}" {{ request('position') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Niveau --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('profile.level') }}</label>
                        <select name="level" class="w-full bg-slate-800 border-slate-700 rounded-xl text-slate-200 text-sm focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">{{ __('profile.all_levels') }}</option>
                            @foreach($levels as $lvl)
                                <option value="{{ $lvl }}" {{ request('level') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Catégorie d'âge --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('profile.category_label') }}</label>
                        <select name="age_group" class="w-full bg-slate-800 border-slate-700 rounded-xl text-slate-200 text-sm focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">{{ __('profile.all_categories') }}</option>
                            @foreach($ageGroups as $group)
                                <option value="{{ $group }}" {{ request('age_group') == $group ? 'selected' : '' }}>{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bouton Filtrer --}}
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 rounded-xl transition shadow-lg shadow-amber-500/10 active:scale-95">
                            {{ __('profile.apply_filters') }}
                        </button>
                        @if(request()->anyFilled(['position', 'level', 'age_group', 'search']))
                            <a href="{{ route('talents') }}" class="p-2.5 bg-slate-800 hover:bg-slate-700 text-slate-400 rounded-xl transition" title="{{ __('profile.reset_filters') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Grille de joueurs (Conteneur AJAX) --}}
        <div id="players-container" class="relative min-h-[400px]">
            {{-- Loader --}}
            <div id="loader" class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-20 flex items-center justify-center rounded-3xl opacity-0 pointer-events-none transition-opacity duration-300">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-12 h-12 border-4 border-amber-500/20 border-t-amber-500 rounded-full animate-spin"></div>
                    <p class="text-amber-500 font-bold text-sm uppercase tracking-widest">{{ __('profile.searching') }}</p>
                </div>
            </div>

            <div id="grid-content">
                @include('partials.player-grid')
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.querySelector('form');
    const container = document.getElementById('grid-content');
    const loader = document.getElementById('loader');

    const updateGrid = async (url) => {
        loader.classList.remove('opacity-0', 'pointer-events-none');
        
        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await response.text();
            container.innerHTML = html;
            
            // Scroll en haut de la grille
            document.getElementById('players-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Réattacher les événements de pagination
            attachPaginationLinks();
        } catch (error) {
            console.error('Erreur lors du filtrage:', error);
        } finally {
            loader.classList.add('opacity-0', 'pointer-events-none');
        }
    };

    const attachPaginationLinks = () => {
        document.querySelectorAll('.ajax-pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                updateGrid(this.href);
                // Mettre à jour l'URL sans recharger
                window.history.pushState({}, '', this.href);
            });
        });
    };

    // Déclencher le filtre au changement des selects
    filterForm.querySelectorAll('select').forEach(select => {
        select.addEventListener('change', function() {
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData);
            const url = `${window.location.pathname}?${params.toString()}`;
            
            updateGrid(url);
            window.history.pushState({}, '', url);
        });
    });

    // Recherche textuelle avec debounce
    let timeout = null;
    const searchInput = filterForm.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData);
                const url = `${window.location.pathname}?${params.toString()}`;
                
                updateGrid(url);
                window.history.pushState({}, '', url);
            }, 500); // Attendre 500ms après la frappe
        });
    }

    // Gérer le bouton filtrer (pour le mobile ou confirmation)
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);
        const url = `${window.location.pathname}?${params.toString()}`;
        
        updateGrid(url);
        window.history.pushState({}, '', url);
    });

    attachPaginationLinks();
});
</script>
@endpush
