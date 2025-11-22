@extends('layouts.app')

@section('title', 'Éditer mon profil - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white px-4 py-12 relative">
    {{-- Bouton retour à l'accueil --}}
    <a href="{{ route('home') }}" class="absolute top-6 left-6 flex items-center gap-2 px-4 py-2 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition group z-10">
        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="text-sm font-medium">Accueil</span>
    </a>

    <div class="max-w-4xl mx-auto">
        {{-- En-tête --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2">Éditer mon profil joueur</h1>
            <p class="text-slate-400 text-sm">Mets à jour tes informations pour rester visible auprès des clubs et agents</p>
        </div>

        {{-- Message de succès --}}
        @if (session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-xl p-4">
                <p class="text-green-400 text-sm">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Erreurs de validation --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/50 rounded-xl p-4">
                <p class="text-red-400 text-sm font-semibold mb-2">Erreurs dans le formulaire</p>
                <ul class="text-red-300 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Section 1: Informations personnelles --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">1</span>
                    Informations personnelles
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-slate-300 mb-2">Prénom</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Mehdi">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-slate-300 mb-2">Nom</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Ben Abdelouahed">
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-slate-300 mb-2">Date de naissance</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', Auth::user()->date_of_birth?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">Téléphone</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="+33 6 12 34 56 78">
                    </div>
                    <div class="md:col-span-2">
                        <label for="profile_photo" class="block text-sm font-medium text-slate-300 mb-2">Photo de profil</label>
                        @if(Auth::user()->profile_photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Photo actuelle" class="w-20 h-20 rounded-full object-cover border-2 border-amber-500">
                                <p class="text-xs text-slate-400 mt-1">Photo actuelle</p>
                            </div>
                        @endif
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                        <p class="mt-1 text-xs text-slate-400">Format: JPG, PNG. Max 2MB. Laisse vide pour garder la photo actuelle.</p>
                    </div>
                </div>
            </div>

            {{-- Section 2: Informations sportives --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">2</span>
                    Informations sportives
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="position" class="block text-sm font-medium text-slate-300 mb-2">Poste</label>
                        <input type="text" id="position" name="position" value="{{ old('position', Auth::user()->position) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Ex: Ailier droit, Meneur de jeu">
                    </div>
                    <div>
                        <label for="preferred_foot" class="block text-sm font-medium text-slate-300 mb-2">Pied fort</label>
                        <select id="preferred_foot" name="preferred_foot"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                            <option value="">Sélectionner...</option>
                            <option value="Droit" {{ old('preferred_foot', Auth::user()->preferred_foot) == 'Droit' ? 'selected' : '' }}>Droit</option>
                            <option value="Gauche" {{ old('preferred_foot', Auth::user()->preferred_foot) == 'Gauche' ? 'selected' : '' }}>Gauche</option>
                            <option value="Ambidextre" {{ old('preferred_foot', Auth::user()->preferred_foot) == 'Ambidextre' ? 'selected' : '' }}>Ambidextre</option>
                        </select>
                    </div>
                    <div>
                        <label for="height" class="block text-sm font-medium text-slate-300 mb-2">Taille (cm)</label>
                        <input type="number" id="height" name="height" value="{{ old('height', Auth::user()->height) }}" min="100" max="250"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="175">
                    </div>
                    <div>
                        <label for="weight" class="block text-sm font-medium text-slate-300 mb-2">Poids (kg)</label>
                        <input type="number" id="weight" name="weight" value="{{ old('weight', Auth::user()->weight) }}" min="30" max="150"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="70">
                    </div>
                    <div>
                        <label for="current_club" class="block text-sm font-medium text-slate-300 mb-2">Club actuel</label>
                        <input type="text" id="current_club" name="current_club" value="{{ old('current_club', Auth::user()->current_club) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Ex: RSC Anderlecht">
                    </div>
                    <div>
                        <label for="level" class="block text-sm font-medium text-slate-300 mb-2">Niveau</label>
                        <input type="text" id="level" name="level" value="{{ old('level', Auth::user()->level) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Ex: U19 Élite, Senior Amateur">
                    </div>
                    <div>
                        <label for="jersey_number" class="block text-sm font-medium text-slate-300 mb-2">Numéro de maillot</label>
                        <input type="number" id="jersey_number" name="jersey_number" value="{{ old('jersey_number', Auth::user()->jersey_number) }}" min="1" max="99"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="10">
                    </div>
                </div>
            </div>

            {{-- Section 3: Médias --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">3</span>
                    Médias
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="main_video_url" class="block text-sm font-medium text-slate-300 mb-2">Vidéo principale (URL)</label>
                        <input type="url" id="main_video_url" name="main_video_url" value="{{ old('main_video_url', Auth::user()->main_video_url) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="https://youtube.com/watch?v=...">
                        <p class="mt-1 text-xs text-slate-400">YouTube, Vimeo, ou lien direct vers ta vidéo</p>
                    </div>

                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-700"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-3 bg-slate-900 text-slate-400">OU</span>
                        </div>
                    </div>

                    <div>
                        <label for="main_video_file" class="block text-sm font-medium text-slate-300 mb-2">Télécharger une vidéo (MP4, MOV)</label>
                        @if(Auth::user()->main_video_file)
                            <div class="mb-2 p-2 bg-slate-800 rounded-lg border border-slate-700 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs text-slate-300">Vidéo actuelle téléchargée</span>
                            </div>
                        @endif
                        <input type="file" id="main_video_file" name="main_video_file" accept="video/mp4,video/quicktime,video/x-msvideo"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                        <p class="mt-1 text-xs text-slate-400">Max 50MB. Si une vidéo est téléchargée, elle sera prioritaire sur l'URL.</p>
                    </div>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-slate-300 mb-2">Description / Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Décris ton style de jeu, tes points forts, ton parcours...">{{ old('bio', Auth::user()->bio) }}</textarea>
                        <p class="mt-1 text-xs text-slate-400">Max 1000 caractères</p>
                    </div>
                </div>
            </div>

            {{-- Section 4: Statistiques --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">4</span>
                    Statistiques
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="season" class="block text-sm font-medium text-slate-300 mb-2">Saison</label>
                        <input type="text" id="season" name="season" value="{{ old('season', Auth::user()->season ?? '2024/25') }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="2024/25">
                    </div>
                    <div>
                        <label for="matches_played" class="block text-sm font-medium text-slate-300 mb-2">Matchs joués</label>
                        <input type="number" id="matches_played" name="matches_played" value="{{ old('matches_played', Auth::user()->matches_played) }}" min="0"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="24">
                    </div>
                    <div>
                        <label for="goals_scored" class="block text-sm font-medium text-slate-300 mb-2">Buts</label>
                        <input type="number" id="goals_scored" name="goals_scored" value="{{ old('goals_scored', Auth::user()->goals_scored) }}" min="0"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="9">
                    </div>
                    <div>
                        <label for="assists" class="block text-sm font-medium text-slate-300 mb-2">Passes décisives</label>
                        <input type="number" id="assists" name="assists" value="{{ old('assists', Auth::user()->assists) }}" min="0"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="11">
                    </div>
                </div>
            </div>

            {{-- Section 5: Réseaux sociaux --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-amber-400 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">5</span>
                    Réseaux sociaux
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="instagram_url" class="block text-sm font-medium text-slate-300 mb-2">Instagram</label>
                        <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', Auth::user()->instagram_url) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="https://instagram.com/ton_compte">
                    </div>
                    <div>
                        <label for="tiktok_url" class="block text-sm font-medium text-slate-300 mb-2">TikTok</label>
                        <input type="url" id="tiktok_url" name="tiktok_url" value="{{ old('tiktok_url', Auth::user()->tiktok_url) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="https://tiktok.com/@ton_compte">
                    </div>
                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-slate-300 mb-2">YouTube</label>
                        <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', Auth::user()->youtube_url) }}"
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="https://youtube.com/@ton_compte">
                    </div>
                </div>
            </div>

            {{-- Visibilité du profil --}}
            <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-white mb-1">Profil public</h3>
                        <p class="text-sm text-slate-400">Ton profil sera visible par tous (clubs, agents, etc.)</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_public" value="1" {{ old('is_public', Auth::user()->is_public ?? true) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-amber-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>
            </div>

            {{-- Boutons d'action --}}
            <div class="flex gap-4">
                <button type="submit"
                    class="flex-1 px-6 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-lg shadow-lg shadow-amber-500/30 transition transform hover:scale-[1.02] active:scale-[0.98]">
                    💾 Enregistrer les modifications
                </button>
                <a href="{{ route('profile.show', Auth::id()) }}"
                    class="px-6 py-4 rounded-xl border border-slate-600 hover:border-amber-400 text-slate-200 hover:text-amber-300 font-semibold transition text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
