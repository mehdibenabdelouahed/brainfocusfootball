@extends('layouts.app')

@section('title', 'Comparateur de Talents - BFF')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20">
    @include('partials.navbar')

    <div class="max-w-7xl mx-auto px-4 py-12">
        {{-- En-tête --}}
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-4xl font-black mb-2 bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">
                    Comparateur de Talents
                </h1>
                <p class="text-slate-400">Analyse comparative des performances mentales et techniques.</p>
            </div>
            <a href="{{ route('talents') }}" class="px-6 py-3 bg-slate-900 border border-slate-800 rounded-xl hover:bg-slate-800 transition text-sm font-bold">
                ← Retour à la galerie
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-{{ $players->count() }} gap-8">
            @foreach($players as $player)
                <div class="bg-slate-900/40 border border-slate-800 rounded-3xl p-6 relative overflow-hidden">
                    {{-- Overlay dégradé --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 blur-3xl rounded-full -mr-16 -mt-16"></div>
                    
                    {{-- Infos Joueur --}}
                    <div class="flex flex-col items-center text-center mb-8">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-amber-500/30 mb-4 shadow-xl">
                            @if($player->profile_photo)
                                <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center text-3xl font-black text-amber-500">
                                    {{ substr($player->first_name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold mb-1">{{ $player->first_name }} {{ $player->last_name }}</h2>
                        <p class="text-amber-500 font-bold text-sm uppercase tracking-widest">{{ $player->position }}</p>
                        <p class="text-slate-500 text-xs mt-1">{{ $player->current_club ?? 'Sans club' }}</p>
                    </div>

                    {{-- Radar --}}
                    <div class="mb-10 flex justify-center">
                        <div class="relative w-64 h-64">
                            <svg viewBox="0 0 100 100" class="w-full h-full">
                                {{-- Background Grid --}}
                                @for($i = 1; $i <= 5; $i++)
                                    @php 
                                        $r = $i * 8; // 5 steps up to 40
                                        $gridPts = [];
                                        for ($j = 0; $j < 6; $j++) {
                                            $a = (M_PI * 2 / 6) * $j - M_PI / 2;
                                            $gridPts[] = (50 + $r * cos($a)) . ',' . (50 + $r * sin($a));
                                        }
                                        $gridPoints = implode(' ', $gridPts);
                                    @endphp
                                    <polygon points="{{ $gridPoints }}" 
                                        fill="none" stroke="rgba(148, 163, 184, 0.15)" stroke-width="0.5" />
                                @endfor
                                
                                {{-- Axis lines --}}
                                @for($j = 0; $j < 6; $j++)
                                    @php $a = (M_PI * 2 / 6) * $j - M_PI / 2; @endphp
                                    <line x1="50" y1="50" x2="{{ 50 + 40 * cos($a) }}" y2="{{ 50 + 40 * sin($a) }}" stroke="rgba(148, 163, 184, 0.1)" stroke-width="0.5" />
                                @endfor
                                
                                {{-- Data Polygon --}}
                                @php
                                    $values = array_values($player->radar_data);
                                    $n = count($values);
                                    $cx = 50; $cy = 50; $maxR = 40;
                                    $pts = [];
                                    for ($i = 0; $i < $n; $i++) {
                                        $angle = (M_PI * 2 / $n) * $i - M_PI / 2;
                                        $pct = $values[$i] / 100;
                                        $pts[] = ($cx + $maxR * $pct * cos($angle)) . ',' . ($cy + $maxR * $pct * sin($angle));
                                    }
                                    $polygonPoints = implode(' ', $pts);
                                @endphp
                                <polygon points="{{ $polygonPoints }}" 
                                    fill="rgba(245, 158, 11, 0.3)" 
                                    stroke="#f59e0b" 
                                    stroke-width="1.5"
                                    class="bff-animate-radar" />
                            </svg>
                            
                            {{-- Labels --}}
                            <div class="absolute inset-0 pointer-events-none text-[7px] font-black text-slate-400">
                                <span class="absolute top-0 left-1/2 -translate-x-1/2 text-amber-500 uppercase tracking-widest">Mental</span>
                                <span class="absolute top-1/4 right-0 translate-x-2 uppercase">Physique</span>
                                <span class="absolute bottom-1/4 right-0 translate-x-2 uppercase">Technique</span>
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 uppercase">Vision</span>
                                <span class="absolute bottom-1/4 left-0 -translate-x-2 uppercase">Vitesse</span>
                                <span class="absolute top-1/4 left-0 -translate-x-2 uppercase">Social</span>
                            </div>
                        </div>
                    </div>

                    {{-- Stats détaillées --}}
                    <div class="space-y-4">
                        @foreach(['mental' => 'Mental', 'physique' => 'Physique', 'technique' => 'Technique', 'vitesse' => 'Vitesse', 'vision' => 'Vision', 'social' => 'Social'] as $key => $label)
                            <div>
                                <div class="flex justify-between items-end mb-1">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">{{ $label }}</span>
                                    <span class="text-xs font-black text-amber-500">{{ $player->{'radar_'.$key} ?? 0 }}/10</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-500 transition-all duration-1000" style="width: {{ ($player->{'radar_'.$key} ?? 0) * 10 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Stats Physiques --}}
                    <div class="mt-8 pt-8 border-t border-slate-800 grid grid-cols-2 gap-4">
                        <div class="bg-slate-800/30 p-3 rounded-xl text-center">
                            <span class="block text-[10px] text-slate-500 uppercase mb-1">Âge</span>
                            <span class="font-bold">{{ $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->age : '-' }} ans</span>
                        </div>
                        <div class="bg-slate-800/30 p-3 rounded-xl text-center">
                            <span class="block text-[10px] text-slate-500 uppercase mb-1">Taille</span>
                            <span class="font-bold">{{ $player->height ?? '-' }} cm</span>
                        </div>
                        <div class="bg-slate-800/30 p-3 rounded-xl text-center">
                            <span class="block text-[10px] text-slate-500 uppercase mb-1">Pied</span>
                            <span class="font-bold">{{ $player->preferred_foot ?? '-' }}</span>
                        </div>
                        <div class="bg-slate-800/30 p-3 rounded-xl text-center">
                            <span class="block text-[10px] text-slate-500 uppercase mb-1">Poids</span>
                            <span class="font-bold">{{ $player->weight ?? '-' }} kg</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('profile.show', $player->id) }}" class="block w-full py-3 text-center rounded-xl bg-slate-800 hover:bg-slate-700 transition text-sm font-bold">
                            Voir le profil complet
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
