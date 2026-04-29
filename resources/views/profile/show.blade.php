@extends('layouts.app')

@section('title', $user->name . ' - Profil Joueur')

@section('meta')
    <meta name="description" content="Découvrez le profil de {{ $user->name }}, {{ $user->position }} sur Brain Focus Football.">
    <meta property="og:title" content="{{ $user->name }} - Profil Joueur | BFF">
    <meta property="og:description" content="{{ $user->position }} • {{ $user->current_club ?? 'Sans club' }} • {{ $user->level }}">
    <meta property="og:image" content="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="profile">
@endsection

@section('content')
<div class="min-h-screen bg-slate-950 text-white px-2 sm:px-4 py-8 sm:py-12">
    <div class="max-w-4xl mx-auto">
        {{-- Bouton retour --}}


        {{-- Carte profil principal --}}
        <div class="relative mb-8">
            <div class="absolute -inset-1 bg-gradient-to-tr from-amber-500/30 via-sky-500/20 to-purple-500/30 rounded-3xl blur-xl opacity-50"></div>
            
            <div class="relative bg-slate-900/95 border border-slate-700/70 rounded-3xl p-4 sm:p-8 shadow-2xl">
                {{-- En-tête avec photo et infos principales --}}
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    {{-- Photo de profil --}}
                    <div class="flex-shrink-0">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-2xl object-cover border-2 border-amber-500/50">
                        @else
                            <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-bold text-5xl border-2 border-amber-500/50">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    {{-- Infos principales --}}
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $user->first_name ?? $user->name }} {{ $user->last_name }}</h1>
                        @if($user->position)
                            <p class="text-amber-400 text-lg mb-3">{{ $user->position }}</p>
                        @endif
                        @if($user->current_club || $user->level)
                            <p class="text-slate-300 mb-4">
                                @if($user->current_club){{ $user->current_club }}@endif
                                @if($user->current_club && $user->level) • @endif
                                @if($user->level){{ $user->level }}@endif
                            </p>
                        @endif

                        {{-- Partage du profil --}}
                        <div class="mt-6 pt-6 border-t border-slate-800/50">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Partager ce profil</p>
                            <div class="flex flex-wrap gap-2">
                                <button onclick="copyProfileLink()" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-800 hover:bg-amber-500 hover:text-slate-950 transition text-xs font-semibold group relative">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                    <span id="copy-text">Copier le lien</span>
                                </button>
                                <a href="https://wa.me/?text={{ urlencode('Découvre le profil de ' . $user->name . ' sur Brain Focus Football : ' . url()->current()) }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-green-600/10 text-green-400 hover:bg-green-600 hover:text-white transition text-xs font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informations détaillées --}}
                <div class="grid md:grid-cols-4 gap-4 mb-8">
                    @if($user->date_of_birth)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Âge</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($user->date_of_birth)->age }} ans</p>
                        </div>
                    @endif
                    @if($user->height)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Taille</p>
                            <p class="font-semibold">{{ $user->height }} cm</p>
                        </div>
                    @endif
                    @if($user->weight)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Poids</p>
                            <p class="font-semibold">{{ $user->weight }} kg</p>
                        </div>
                    @endif
                    @if($user->preferred_foot)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Pied fort</p>
                            <p class="font-semibold">{{ $user->preferred_foot }}</p>
                        </div>
                    @endif
                    @if($user->jersey_number)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Numéro</p>
                            <p class="font-semibold">{{ $user->jersey_number }}</p>
                        </div>
                    @endif
                </div>

                {{-- Statistiques --}}
                @if($user->season || $user->matches_played || $user->goals_scored || $user->assists)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-4">Statistiques {{ $user->season }}</h2>
                        <div class="grid grid-cols-3 gap-4">
                            @if($user->matches_played)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->matches_played }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Matchs</p>
                                </div>
                            @endif
                            @if($user->goals_scored)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->goals_scored }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Buts</p>
                                </div>
                            @endif
                            @if($user->assists)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $user->assists }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Passes D.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Radar de Performance --}}
                <div class="mb-8 bg-slate-800/30 rounded-2xl p-4 sm:p-6 border border-slate-700/50 overflow-hidden">
                    <h2 class="text-xl font-bold text-amber-400 mb-6">Radar de Performance</h2>
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative w-48 h-48 flex-shrink-0">
                            <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow-xl">
                                {{-- Background Grid --}}
                                @for($i = 1; $i <= 5; $i++)
                                    @php 
                                        $r = $i * 8; 
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
                                    $values = array_values($user->radar_data);
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
                                
                                {{-- Data Points --}}
                                @foreach($pts as $point)
                                    <circle cx="{{ explode(',', $point)[0] }}" cy="{{ explode(',', $point)[1] }}" r="1.5" fill="#f59e0b" />
                                @endforeach
                            </svg>
                            
                            {{-- Labels --}}
                            <div class="absolute inset-0 pointer-events-none text-[8px] font-black text-slate-400">
                                <span class="absolute top-0 left-1/2 -translate-x-1/2 text-amber-500 uppercase tracking-widest">Mental</span>
                                <span class="absolute top-1/4 right-0 translate-x-2 uppercase">Physique</span>
                                <span class="absolute bottom-1/4 right-0 translate-x-2 uppercase">Technique</span>
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 uppercase">Vision</span>
                                <span class="absolute bottom-1/4 left-0 -translate-x-2 uppercase">Vitesse</span>
                                <span class="absolute top-1/4 left-0 -translate-x-2 uppercase">Social</span>
                            </div>
                        </div>

                        <div class="flex-1 grid grid-cols-2 gap-x-6 gap-y-4">
                            @foreach(['mental' => 'Mental', 'physique' => 'Physique', 'technique' => 'Technique', 'vitesse' => 'Vitesse', 'vision' => 'Vision', 'social' => 'Social'] as $key => $label)
                                <div class="flex flex-col">
                                    <div class="flex justify-between items-end mb-1">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $label }}</span>
                                        <span class="text-sm font-black text-amber-500">{{ $user->{'radar_'.$key} ?? 0 }}/10</span>
                                    </div>
                                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500" style="width: {{ ($user->{'radar_'.$key} ?? 0) * 10 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($user->bio)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">À propos</h2>
                        <p class="text-slate-300 leading-relaxed">{{ $user->bio }}</p>
                    </div>
                @endif

                {{-- Vidéo principale --}}
                @if($user->main_video_file || $user->main_video_url)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">Vidéo principale</h2>
                        <div class="aspect-video rounded-xl overflow-hidden bg-slate-800">
                            @if($user->main_video_file)
                                <video controls class="w-full h-full object-contain bg-black">
                                    <source src="{{ asset('storage/' . $user->main_video_file) }}">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            @elseif($user->main_video_url)
                                @if(str_contains($user->main_video_url, 'youtube.com') || str_contains($user->main_video_url, 'youtu.be'))
                                    @php
                                        $videoId = null;
                                        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $user->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        } elseif (preg_match('/youtu\.be\/([^?]+)/', $user->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    @if($videoId)
                                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                @else
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ $user->main_video_url }}" type="video/mp4">
                                    </video>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Objectifs --}}
                @if($user->goals && count($user->goals) > 0)
                    <div>
                        <h2 class="text-xl font-bold text-amber-400 mb-3">Objectifs</h2>
                        <ul class="space-y-2">
                            @foreach($user->goals as $goal)
                                <li class="flex items-center gap-2 text-slate-300">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    {{ $goal }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bouton d'édition si c'est le propriétaire --}}
        @auth
            @if(Auth::id() === $user->id)
                <div class="text-center">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Éditer mon profil
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyProfileLink() {
    const url = window.location.href;
    const textElement = document.getElementById('copy-text');
    const originalText = textElement.innerText;

    navigator.clipboard.writeText(url).then(() => {
        textElement.innerText = 'Lien copié !';
        textElement.parentElement.classList.remove('bg-slate-800');
        textElement.parentElement.classList.add('bg-amber-500', 'text-slate-950');
        
        setTimeout(() => {
            textElement.innerText = originalText;
            textElement.parentElement.classList.add('bg-slate-800');
            textElement.parentElement.classList.remove('bg-amber-500', 'text-slate-950');
        }, 2000);
    }).catch(err => {
        console.error('Erreur lors de la copie :', err);
    });
}
</script>
@endpush
