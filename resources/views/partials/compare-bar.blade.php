{{-- Barre de comparaison flottante --}}
<div x-show="players.length > 0" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-2xl"
     x-cloak>
    
    <div class="bg-slate-900/90 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-4 shadow-2xl flex items-center justify-between gap-4">
        <div class="flex items-center gap-4 overflow-x-auto no-scrollbar py-1">
            <template x-for="p in players" :key="p.id">
                <div class="relative flex-shrink-0 group">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-amber-500 shadow-lg shadow-amber-500/20">
                        <img :src="p.photo || '/images/default-avatar.png'" class="w-full h-full object-cover">
                    </div>
                    <button @click="remove(p.id)" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] shadow-lg hover:bg-red-600 transition-colors">
                        ✕
                    </button>
                    <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-slate-800 text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap" x-text="p.name"></div>
                </div>
            </template>
            
            <div x-show="players.length < 2" class="flex items-center gap-3 text-slate-500 pl-2">
                <div class="w-12 h-12 rounded-full border-2 border-dashed border-slate-700 flex items-center justify-center text-xl">+</div>
                <p class="text-xs font-medium">Ajoute un 2ème joueur pour comparer</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button x-show="players.length >= 2" 
                    @click="compareNow()"
                    class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-black px-6 py-3 rounded-xl transition shadow-lg shadow-amber-500/30 whitespace-nowrap text-sm uppercase tracking-wider">
                Comparer
            </button>
            <button @click="clear()" class="text-slate-400 hover:text-white transition p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    </div>
</div>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
