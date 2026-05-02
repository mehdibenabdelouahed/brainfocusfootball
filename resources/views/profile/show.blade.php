@extends('layouts.app')

@section('title', $user->name . ' - Profil Joueur')

@section('meta')
    @php $player = $user->player; @endphp
    <meta name="description" content="Découvrez le profil de {{ $player?->first_name ?? $user->name }}, {{ $player?->position }} sur Brain Focus Football.">
    <meta property="og:title" content="{{ $player?->first_name ?? $user->name }} - Profil Joueur | BFF">
    <meta property="og:description" content="{{ $player?->position }} • {{ $player?->current_club ?? 'Sans club' }} • {{ $player?->level }}">
    <meta property="og:image" content="{{ $player?->profile_photo ? asset('storage/' . $player->profile_photo) : asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="profile">
@endsection

@section('content')
@php $player = $user->player; @endphp
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
                        @if($player?->profile_photo)
                            <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-2xl object-cover border-2 border-amber-500/50">
                        @else
                            <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-bold text-5xl border-2 border-amber-500/50">
                                {{ substr($player?->first_name ?? $user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    {{-- Infos principales --}}
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $player?->first_name ?? $user->name }} {{ $player?->last_name }}</h1>
                        @if($player?->position)
                            <p class="text-amber-400 text-lg mb-3">{{ $player->position }}</p>
                        @endif
                        @if($player?->current_club || $player?->level)
                            <p class="text-slate-300 mb-4">
                                @if($player?->current_club){{ $player->current_club }}@endif
                                @if($player?->current_club && $player?->level) • @endif
                                @if($player?->level){{ $player->level }}@endif
                            </p>
                        @endif

                        {{-- Bouton "Contacter" pour les Recruteurs --}}
                        @auth
                            @if(Auth::user()->isRecruiter())
                                <div class="mt-4">
                                    @php
                                        $canContact = Auth::user()->canContactPlayer();
                                        $plan = Auth::user()->recruiterPlan();
                                        $existingConv = \App\Models\Conversation::where('recruiter_id', Auth::id())->where('player_id', $user->id)->first();
                                    @endphp
                                    
                                    @if($existingConv)
                                        <a href="{{ route('messages.show', $existingConv->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500/20 hover:bg-amber-500 text-amber-400 hover:text-slate-950 border border-amber-500/40 rounded-xl font-bold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                            Voir la conversation
                                        </a>
                                    @elseif($canContact)
                                        <form action="{{ route('messages.initiate', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-slate-950 rounded-xl font-bold text-sm transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                Contacter ce joueur
                                            </button>
                                        </form>
                                    @elseif($plan === 'GRATUIT')
                                        <a href="{{ route('pricing') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-400 rounded-xl font-semibold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                            S'abonner pour contacter
                                        </a>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 border border-slate-700 text-slate-500 rounded-xl font-semibold text-sm cursor-not-allowed" title="Quota mensuel atteint (10 contacts pour Standard)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                            Quota mensuel atteint
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endauth

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
                    @if($player?->date_of_birth)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Âge</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($player->date_of_birth)->age }} ans</p>
                        </div>
                    @endif
                    @if($player?->height_cm)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Taille</p>
                            <p class="font-semibold">{{ $player->height_cm }} cm</p>
                        </div>
                    @endif
                    @if($player?->weight_kg)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Poids</p>
                            <p class="font-semibold">{{ $player->weight_kg }} kg</p>
                        </div>
                    @endif
                    @if($player?->dominant_foot)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Pied fort</p>
                            <p class="font-semibold">{{ $player->dominant_foot }}</p>
                        </div>
                    @endif
                    @if($player?->jersey_number)
                        <div class="bg-slate-800/50 rounded-xl p-4">
                            <p class="text-slate-400 text-xs mb-1">Numéro</p>
                            <p class="font-semibold">{{ $player->jersey_number }}</p>
                        </div>
                    @endif
                </div>

                {{-- Statistiques --}}
                @if($player?->season || $player?->matches_played || $player?->goals_scored || $player?->assists)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-4">Statistiques {{ $player->season }}</h2>
                        <div class="grid grid-cols-3 gap-4">
                            @if($player?->matches_played)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $player->matches_played }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Matchs</p>
                                </div>
                            @endif
                            @if($player?->goals_scored)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $player->goals_scored }}</p>
                                    <p class="text-slate-400 text-sm mt-1">Buts</p>
                                </div>
                            @endif
                            @if($player?->assists)
                                <div class="bg-slate-800/50 rounded-xl p-4 text-center">
                                    <p class="text-3xl font-bold text-amber-400">{{ $player->assists }}</p>
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
                                    $values = $player ? [
                                        $player->radar_mental ?? 5,
                                        $player->radar_physique ?? 5,
                                        $player->radar_technique ?? 5,
                                        $player->radar_vitesse ?? 5,
                                        $player->radar_vision ?? 5,
                                        $player->radar_social ?? 5
                                    ] : [5, 5, 5, 5, 5, 5];
                                    $n = count($values);
                                    $cx = 50; $cy = 50; $maxR = 40;
                                    $pts = [];
                                    for ($i = 0; $i < $n; $i++) {
                                        $angle = (M_PI * 2 / $n) * $i - M_PI / 2;
                                        $pct = ($values[$i] * 10) / 100;
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
                                        <span class="text-sm font-black text-amber-500">{{ $player?->{'radar_'.$key} ?? 0 }}/10</span>
                                    </div>
                                    <div class="h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500" style="width: {{ ($player?->{'radar_'.$key} ?? 0) * 10 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($player?->bio)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">À propos</h2>
                        <p class="text-slate-300 leading-relaxed">{{ $player->bio }}</p>
                    </div>
                @endif

                {{-- Vidéo principale --}}
                @if($player?->main_video_file || $player?->main_video_url)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-amber-400 mb-3">Vidéo principale</h2>
                        <div class="aspect-video rounded-xl overflow-hidden bg-slate-800">
                            @if($player?->main_video_file)
                                <video controls class="w-full h-full object-contain bg-black">
                                    <source src="{{ asset('storage/' . $player->main_video_file) }}">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            @elseif($player?->main_video_url)
                                @if(str_contains($player->main_video_url, 'youtube.com') || str_contains($player->main_video_url, 'youtu.be'))
                                    @php
                                        $videoId = null;
                                        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $player->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        } elseif (preg_match('/youtu\.be\/([^?]+)/', $player->main_video_url, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    @if($videoId)
                                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                @else
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ $player->main_video_url }}" type="video/mp4">
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
