@extends('layouts.app')

@section('title', 'Créer un compte - Brain Focus Football')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-950 text-white px-4 py-12">
    <div class="w-full max-w-2xl">
        {{-- Bouton retour à l'accueil --}}
        <a href="{{ route('home') }}" class="absolute top-6 left-6 flex items-center gap-2 px-4 py-2 rounded-full border border-slate-700 hover:border-amber-400 text-slate-200 hover:text-amber-300 transition group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-sm font-medium">Accueil</span>
        </a>

        {{-- Logo et titre --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                <img src="/images/logoBFF.png" alt="Logo Brain Focus Football" class="w-16 h-16 object-contain">

        {{-- Carte d'inscription --}}
        <div class="relative">
            {{-- Glow effect --}}
            <div class="absolute -inset-1 bg-gradient-to-tr from-amber-500/30 via-sky-500/20 to-purple-500/30 rounded-2xl blur-xl opacity-50"></div>
            
            <div class="relative bg-slate-900/95 border border-slate-700/70 rounded-2xl p-8 shadow-2xl">
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
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    {{-- Section 1: Informations de compte --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-amber-400 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">1</span>
                            Informations de compte
                        </h3>

                        {{-- Nom d'utilisateur --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                                Nom d'utilisateur <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                placeholder="Ex: Mehdi_BFF"
                            >
                            <p class="mt-1 text-xs text-slate-400">Ce nom sera visible publiquement</p>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                Adresse email <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                placeholder="ton.email@exemple.com"
                            >
                        </div>

                        {{-- Mot de passe --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                    Mot de passe <span class="text-red-400">*</span>
                                </label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                    placeholder="••••••••"
                                >
                                <p class="mt-1 text-xs text-slate-400">Min. 8 caractères</p>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                                    Confirmer le mot de passe <span class="text-red-400">*</span>
                                </label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    required
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                    placeholder="••••••••"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Séparateur --}}
                    <div class="border-t border-slate-700"></div>

                    {{-- Section 2: Informations de base --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-amber-400 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">2</span>
                            Informations de base (optionnel)
                        </h3>
                        <p class="text-xs text-slate-400">Tu pourras compléter ton profil après l'inscription</p>

                        {{-- Prénom et Nom --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Prénom
                                </label>
                                <input 
                                    type="text" 
                                    id="first_name" 
                                    name="first_name" 
                                    value="{{ old('first_name') }}"
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                    placeholder="Mehdi"
                                >
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Nom
                                </label>
                                <input 
                                    type="text" 
                                    id="last_name" 
                                    name="last_name" 
                                    value="{{ old('last_name') }}"
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                    placeholder="Ben Abdelouahed"
                                >
                            </div>
                        </div>

                        {{-- Date de naissance et Poste --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-slate-300 mb-2">
                                    Date de naissance
                                </label>
                                <input 
                                    type="date" 
                                    id="date_of_birth" 
                                    name="date_of_birth" 
                                    value="{{ old('date_of_birth') }}"
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                >
                            </div>
                            <div>
                                <label for="position" class="block text-sm font-medium text-slate-300 mb-2">
                                    Poste
                                </label>
                                <input 
                                    type="text" 
                                    id="position" 
                                    name="position" 
                                    value="{{ old('position') }}"
                                    class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                    placeholder="Ex: Ailier droit, Meneur de jeu"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Bouton d'inscription --}}
                    <button 
                        type="submit"
                        class="w-full px-6 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-lg shadow-lg shadow-amber-500/30 transition transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Créer mon compte
                    </button>

                    <p class="text-xs text-slate-400 text-center">
                        En créant un compte, tu acceptes nos conditions d'utilisation et notre politique de confidentialité.
                    </p>
                </form>

                {{-- Séparateur --}}
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-slate-900 text-slate-400">Déjà un compte ?</span>
                    </div>
                </div>

                {{-- Lien vers connexion --}}
                <a 
                    href="{{ route('login') }}"
                    class="block w-full px-6 py-3 rounded-xl border border-slate-600 hover:border-amber-400 text-center text-slate-200 hover:text-amber-300 font-semibold transition"
                >
                    Se connecter
                </a>
            </div>
        </div>

        {{-- Retour à l'accueil --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-amber-300 transition">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
