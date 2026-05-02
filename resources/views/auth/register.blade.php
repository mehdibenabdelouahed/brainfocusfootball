@extends('layouts.app')

@section('title', 'Créer un compte - Brain Focus Football')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-950 text-white px-4 py-12">
    <div class="w-full max-w-2xl">
        {{-- Bouton retour à l'accueil --}}


        {{-- Logo et titre --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                <img src="/images/logoBFF.png" alt="Logo Brain Focus Football" class="w-16 h-16 object-contain">
            </a>
            <h1 class="text-2xl font-bold">Rejoins la détection</h1>
            <p class="text-slate-400 text-sm mt-1">Crée ton profil joueur en 2 minutes</p>
        </div>
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
                <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registerForm">
                    @csrf

                    {{-- Section 1: Rôle --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-amber-400 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">1</span>
                            Ton profil
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="player" class="peer sr-only" checked onchange="toggleRoleFields()">
                                <div class="p-4 rounded-xl border border-slate-700 bg-slate-800/50 hover:bg-slate-800 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition text-center">
                                    <span class="block text-white font-semibold">Joueur</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="recruiter" class="peer sr-only" onchange="toggleRoleFields()">
                                <div class="p-4 rounded-xl border border-slate-700 bg-slate-800/50 hover:bg-slate-800 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition text-center">
                                    <span class="block text-white font-semibold">Recruteur</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Séparateur --}}
                    <div class="border-t border-slate-700"></div>

                    {{-- Section 2: Informations de connexion --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-amber-400 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">2</span>
                            Informations de compte
                        </h3>

                        {{-- Nom d'utilisateur --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                                Nom d'utilisateur (Pseudo) <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="Ex: Mehdi_BFF">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                Adresse email <span class="text-red-400">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="ton.email@exemple.com">
                        </div>

                        {{-- Mot de passe --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Mot de passe <span class="text-red-400">*</span></label>
                                <input type="password" id="password" name="password" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="••••••••">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirmer le mot de passe <span class="text-red-400">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    {{-- Séparateur --}}
                    <div class="border-t border-slate-700"></div>

                    {{-- Section 3: Informations spécifiques --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-amber-400 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-sm">3</span>
                            Informations spécifiques
                        </h3>

                        {{-- Champs communs Optionnels --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-slate-300 mb-2">Prénom</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-slate-300 mb-2">Nom</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            </div>
                        </div>

                        {{-- Champs Joueur --}}
                        <div id="playerFields" class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-slate-300 mb-2">Date de naissance <span class="text-red-400">*</span></label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" onchange="checkAge()" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                                </div>
                                <div>
                                    <label for="position" class="block text-sm font-medium text-slate-300 mb-2">Poste principal</label>
                                    <input type="text" id="position" name="position" value="{{ old('position') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="Ex: Ailier droit">
                                </div>
                            </div>
                            
                            {{-- Champ Tuteur Légal (affiché dynamiquement) --}}
                            <div id="guardianField" class="hidden p-4 rounded-xl border border-amber-500/30 bg-amber-500/5">
                                <label for="guardian_email" class="block text-sm font-medium text-amber-400 mb-2">
                                    <i class="fas fa-shield-alt mr-1"></i> Email du tuteur légal <span class="text-red-400">*</span>
                                </label>
                                <p class="text-xs text-slate-400 mb-3">Conformément au RGPD, une autorisation d'un tuteur légal est requise pour les joueurs mineurs.</p>
                                <input type="email" id="guardian_email" name="guardian_email" value="{{ old('guardian_email') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-amber-500/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="parent@exemple.com">
                            </div>
                        </div>

                        {{-- Champs Recruteur --}}
                        <div id="recruiterFields" class="space-y-4 hidden">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="org_name" class="block text-sm font-medium text-slate-300 mb-2">Club / Organisation <span class="text-red-400">*</span></label>
                                    <input type="text" id="org_name" name="org_name" value="{{ old('org_name') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition" placeholder="Nom du club">
                                </div>
                                <div>
                                    <label for="license_number" class="block text-sm font-medium text-slate-300 mb-2">Numéro de licence / Agent</label>
                                    <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bouton d'inscription --}}
                    <button type="submit" class="w-full px-6 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-lg shadow-lg shadow-amber-500/30 transition transform hover:scale-[1.02] active:scale-[0.98]">
                        Créer mon compte
                    </button>

                    <p class="text-xs text-slate-400 text-center">
                        En créant un compte, tu acceptes nos conditions d'utilisation et notre politique de confidentialité.
                    </p>
                </form>

                <script>
                    function toggleRoleFields() {
                        const role = document.querySelector('input[name="role"]:checked').value;
                        const playerFields = document.getElementById('playerFields');
                        const recruiterFields = document.getElementById('recruiterFields');
                        const dobInput = document.getElementById('date_of_birth');
                        const orgInput = document.getElementById('org_name');
                        
                        if (role === 'player') {
                            playerFields.classList.remove('hidden');
                            recruiterFields.classList.add('hidden');
                            dobInput.required = true;
                            orgInput.required = false;
                            checkAge();
                        } else {
                            playerFields.classList.add('hidden');
                            recruiterFields.classList.remove('hidden');
                            dobInput.required = false;
                            orgInput.required = true;
                            document.getElementById('guardianField').classList.add('hidden');
                            document.getElementById('guardian_email').required = false;
                        }
                    }

                    function checkAge() {
                        const dobStr = document.getElementById('date_of_birth').value;
                        if (!dobStr) return;
                        
                        const dob = new Date(dobStr);
                        const today = new Date();
                        let age = today.getFullYear() - dob.getFullYear();
                        const m = today.getMonth() - dob.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                            age--;
                        }
                        
                        const guardianField = document.getElementById('guardianField');
                        const guardianEmailInput = document.getElementById('guardian_email');
                        
                        if (age < 18) {
                            guardianField.classList.remove('hidden');
                            guardianEmailInput.required = true;
                        } else {
                            guardianField.classList.add('hidden');
                            guardianEmailInput.required = false;
                        }
                    }

                    // Run on init
                    document.addEventListener('DOMContentLoaded', () => {
                        toggleRoleFields();
                    });
                </script>

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
