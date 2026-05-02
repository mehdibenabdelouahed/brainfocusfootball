@extends('layouts.app')

@section('title', 'Mon Tableau de Bord — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white">
    @include('partials.navbar')

    <main class="max-w-6xl mx-auto px-2 sm:px-4 py-6 sm:py-10">

        {{-- En-tête de bienvenue --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-10">
            <div>
                <p class="text-sm text-amber-400 font-semibold uppercase tracking-widest mb-1">Tableau de bord</p>
                <h1 class="text-2xl sm:text-3xl font-bold">
                    Bonjour, {{ $user->first_name ?? $user->name }} 👋
                </h1>
                <p class="text-slate-400 text-sm mt-1">Prêt à travailler aujourd'hui ?</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @php
                    $unreadMsgCount = Auth::user()->playerConversations()
                        ->with(['messages' => fn($q) => $q->where('sender_id', '!=', Auth::id())->where('is_read', false)])
                        ->get()->sum(fn($conv) => $conv->messages->count());
                @endphp
                <a href="{{ route('messages.index') }}" class="relative px-4 py-2 rounded-full border border-slate-700 hover:border-amber-400 text-sm text-slate-200 hover:text-amber-300 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Messagerie
                    @if($unreadMsgCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-amber-500 text-slate-950 text-[9px] font-black rounded-full flex items-center justify-center">{{ $unreadMsgCount }}</span>
                    @endif
                </a>
                <a href="{{ route('medical.edit') }}" class="px-4 py-2 rounded-full border border-emerald-700/50 hover:border-emerald-400 bg-emerald-950/30 text-sm text-emerald-400 font-medium transition flex items-center gap-2" title="Espace sécurisé AES-256">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Dossier Médical
                </a>
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-full border border-slate-700 hover:border-amber-400 text-sm text-slate-200 hover:text-amber-300 transition">
                    Éditer mon profil
                </a>
                <a href="{{ route('profile.show', $user->id) }}" class="px-4 py-2 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold text-sm transition">
                    Voir mon profil public
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Colonne gauche --}}
            <div class="lg:col-span-1 space-y-6">

                @php
                    $player = $user->player;
                @endphp

                {{-- Card profil --}}
                <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-4 sm:p-6">
                    <div class="flex items-center gap-4 mb-5">
                        @if($player && $player->profile_photo)
                            <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="{{ $player->first_name }}" class="w-16 h-16 rounded-full object-cover border-2 border-amber-500/50">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-slate-950 font-black text-2xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-lg">{{ $player ? $player->first_name . ' ' . $player->last_name : $user->name }}</p>
                            <p class="text-slate-400 text-sm">{{ $player->position ?? 'Poste non renseigné' }}</p>
                            @if($player && $player->current_club)
                                <p class="text-amber-400 text-xs font-semibold">{{ $player->current_club }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Barre de progression --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Complétion du profil</p>
                            <p class="text-sm font-bold {{ $completionPercent >= 70 ? 'text-green-400' : 'text-amber-400' }}">{{ $completionPercent }}%</p>
                        </div>
                        <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-1000 {{ $completionPercent >= 70 ? 'bg-green-500' : 'bg-amber-500' }}"
                                 style="width: {{ $completionPercent }}%"></div>
                        </div>
                        @if($completionPercent < 100)
                            <a href="{{ route('profile.edit') }}" class="text-xs text-amber-400 hover:text-amber-300 mt-2 inline-block">
                                Compléter mon profil →
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Radar de performance --}}
                <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-4 sm:p-6 overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-semibold text-slate-200">Mon Radar</p>
                        <span class="text-[10px] text-amber-500 font-bold uppercase tracking-wider">Performance</span>
                    </div>

                    @php
                        $radarData = [
                            'Mental' => $player->radar_mental ?? 50,
                            'Physique' => $player->radar_physical ?? 50,
                            'Technique' => $player->radar_technical ?? 50,
                            'Vitesse' => $player->radar_speed ?? 50,
                            'Vision' => $player->radar_vision ?? 50,
                            'Social' => $player->radar_social ?? 50,
                        ];
                        $labels = array_keys($radarData);
                        $values = array_values($radarData);
                        $n = count($values);
                        $cx = 80; $cy = 80; $r = 60;
                        $points = [];
                        $gridPoints5 = [];
                        for ($i = 0; $i < $n; $i++) {
                            $angle = (M_PI * 2 / $n) * $i - M_PI / 2;
                            $pct = $values[$i] / 100;
                            $points[] = ($cx + $r * $pct * cos($angle)) . ',' . ($cy + $r * $pct * sin($angle));
                            $gridPoints5[] = ($cx + $r * 0.5 * cos($angle)) . ',' . ($cy + $r * 0.5 * sin($angle));
                        }
                        $polygon = implode(' ', $points);
                        $gridOuter = implode(' ', array_map(fn($i) => ($cx + $r * cos((M_PI * 2 / $n) * $i - M_PI / 2)) . ',' . ($cy + $r * sin((M_PI * 2 / $n) * $i - M_PI / 2)), range(0, $n - 1)));
                        $grid50 = implode(' ', $gridPoints5);
                    @endphp

                    <svg viewBox="0 0 160 160" class="w-full max-w-[240px] mx-auto block overflow-visible">
                        <polygon points="{{ $gridOuter }}" fill="none" stroke="#334155" stroke-width="1"/>
                        <polygon points="{{ $grid50 }}" fill="none" stroke="#1e293b" stroke-width="1" stroke-dasharray="3,3"/>
                        @for($i = 0; $i < $n; $i++)
                            @php $angle = (M_PI * 2 / $n) * $i - M_PI / 2; @endphp
                            <line x1="{{ $cx }}" y1="{{ $cy }}" x2="{{ $cx + $r * cos($angle) }}" y2="{{ $cy + $r * sin($angle) }}" stroke="#334155" stroke-width="1"/>
                            <text x="{{ $cx + ($r + 14) * cos($angle) }}" y="{{ $cy + ($r + 14) * sin($angle) + 4 }}" text-anchor="middle" font-size="8" fill="#94a3b8" font-family="Inter, sans-serif">{{ $labels[$i] }}</text>
                        @endfor
                        <polygon points="{{ $polygon }}" fill="rgba(245,158,11,0.2)" stroke="#f59e0b" stroke-width="1.5" class="bff-animate-radar"/>
                        @foreach($points as $pt)
                            @php [$px, $py] = explode(',', $pt); @endphp
                            <circle cx="{{ $px }}" cy="{{ $py }}" r="2.5" fill="#f59e0b"/>
                        @endforeach
                    </svg>

                    <div class="grid grid-cols-3 gap-2 mt-3">
                        @foreach($radarData as $label => $val)
                            <div class="text-center">
                                <p class="text-[9px] text-slate-500 uppercase">{{ $label }}</p>
                                <p class="text-xs font-bold text-amber-400">{{ $val / 10 }}/10</p>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('profile.edit') }}" class="text-xs text-slate-500 hover:text-amber-400 transition mt-3 block text-center">
                        Modifier mes notes →
                    </a>
                </div>

            </div>

            {{-- Colonne droite --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Audience & Visibilité --}}
                <div class="bg-gradient-to-br from-indigo-900/40 to-slate-900/60 border border-indigo-500/30 rounded-2xl p-5 sm:p-6 relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 text-indigo-500/10">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                    </div>
                    
                    @if(Auth::user()->isPremium())
                    <div class="relative z-10 flex flex-col sm:flex-row gap-6 sm:gap-10">
                        <div>
                            <h2 class="text-sm font-bold text-indigo-300 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                Mon Audience
                            </h2>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl sm:text-5xl font-black text-white">{{ $viewsCount }}</span>
                                <span class="text-sm text-slate-400 font-semibold">vues de profil</span>
                            </div>
                        </div>
                        
                        <div class="hidden sm:block w-px bg-indigo-500/30 self-stretch"></div>
                        
                        <div>
                            <h2 class="text-sm font-bold text-amber-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                Favoris Recruteurs
                            </h2>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl sm:text-5xl font-black text-white">{{ $favoritedCount }}</span>
                                <span class="text-sm text-slate-400 font-semibold">ajouts</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-sm font-bold text-indigo-300 uppercase tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Mon Audience (Premium)
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-400">Découvrez qui consulte votre profil et combien de recruteurs vous ont ajouté à leurs favoris.</p>
                        </div>
                        <a href="{{ route('pricing') }}" class="flex-shrink-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition">
                            Débloquer
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Stats rapides --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-3 sm:p-4 text-center">
                        <p class="text-2xl font-black text-amber-400">{{ $player->matches_played ?? '—' }}</p>
                        <p class="text-xs text-slate-400 mt-1">Matchs</p>
                    </div>
                    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-amber-400">{{ $player->goals_scored ?? '—' }}</p>
                        <p class="text-xs text-slate-400 mt-1">Buts</p>
                    </div>
                    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-amber-400">{{ $player->assists ?? '—' }}</p>
                        <p class="text-xs text-slate-400 mt-1">Passes D.</p>
                    </div>
                    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-amber-400">{{ $completionPercent }}%</p>
                        <p class="text-xs text-slate-400 mt-1">Profil</p>
                    </div>
                </div>

                {{-- Actions rapides --}}
                @if($completionPercent < 100)
                <div class="bg-gradient-to-r from-amber-600/20 to-orange-600/10 border border-amber-500/30 rounded-2xl p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-sm text-amber-300 mb-1">Ton profil est à {{ $completionPercent }}%</p>
                            <p class="text-xs text-slate-400">Un profil complet est 3x plus consulté par les recruteurs. Il te manque quelques informations clés.</p>
                            <a href="{{ route('profile.edit') }}" class="inline-block mt-3 px-4 py-1.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-bold transition">
                                Compléter maintenant →
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Articles recommandés --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-lg">Articles recommandés</h2>
                        <a href="{{ route('articles.index') }}" class="text-xs text-amber-400 hover:text-amber-300">Voir tout →</a>
                    </div>

                    @if($articles->isEmpty())
                        <p class="text-slate-500 text-sm">Aucun article disponible pour l'instant.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($articles as $article)
                                <a href="{{ route('articles.show', $article->slug) }}" class="flex items-center gap-4 bg-slate-900/50 border border-slate-800 hover:border-amber-500/40 rounded-xl p-4 group transition">
                                    @if($article->cover_image)
                                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-slate-800 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[10px] text-amber-500 font-bold uppercase tracking-wider mb-1">{{ $article->category }}</p>
                                        <p class="font-semibold text-sm text-white group-hover:text-amber-300 transition truncate">{{ $article->title }}</p>
                                        <p class="text-xs text-slate-400 mt-1">{{ $article->reading_time }} min de lecture</p>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-600 group-hover:text-amber-400 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>
</div>
@endsection
