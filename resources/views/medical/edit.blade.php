@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- En-tête sécurisé --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-2 font-oswald flex items-center gap-3">
            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Dossier Médical Sécurisé
        </h1>
        <p class="text-slate-400">Gérez les informations médicales de <span class="text-amber-400 font-semibold">{{ $player->first_name }} {{ $player->last_name }}</span>.</p>
    </div>

    {{-- Bannière de chiffrement --}}
    <div class="bg-emerald-950/40 border border-emerald-900/50 rounded-2xl p-5 mb-8 flex gap-4 items-start">
        <div class="p-2 bg-emerald-900/50 rounded-xl text-emerald-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-emerald-400 font-bold mb-1">Chiffrement AES-256 Actif</h3>
            <p class="text-emerald-500/80 text-sm">
                Toutes les données saisies sur cette page sont chiffrées de bout en bout avant d'être sauvegardées dans notre base de données. 
                Seules les personnes expressément autorisées (joueur, tuteur) peuvent les déchiffrer et les consulter.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-900/50 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('medical.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Groupe Sanguin --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-300 mb-2">Groupe Sanguin</label>
                    <select name="blood_type_enc" class="w-full bg-slate-950/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                        <option value="">Non renseigné</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                            <option value="{{ $type }}" {{ old('blood_type_enc', $medicalData->blood_type_enc) == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Allergies --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-300 mb-2">Allergies (Médicaments, aliments, etc.)</label>
                    <textarea name="allergies_encrypted" rows="3" 
                              class="w-full bg-slate-950/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-slate-600"
                              placeholder="Listez les allergies connues...">{{ old('allergies_encrypted', $medicalData->allergies_encrypted) }}</textarea>
                </div>

                {{-- Historique des blessures --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-300 mb-2">Historique des blessures (Déchirures, fractures, opérations)</label>
                    <textarea name="injuries_history_enc" rows="4" 
                              class="w-full bg-slate-950/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-slate-600"
                              placeholder="Ex: Entorse cheville droite (2024)...">{{ old('injuries_history_enc', $medicalData->injuries_history_enc) }}</textarea>
                </div>

                {{-- Permissions d'accès --}}
                <div class="md:col-span-2 pt-6 border-t border-slate-800">
                    <h3 class="text-lg font-bold text-white mb-4">Confidentialité & Partage</h3>
                    
                    <label class="flex items-start gap-4 cursor-pointer p-4 bg-slate-800/30 rounded-2xl border border-slate-700/50 hover:bg-slate-800/50 transition">
                        <div class="flex items-center h-6">
                            <input type="checkbox" name="access_restricted" value="1" 
                                   class="w-5 h-5 rounded border-slate-600 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900 bg-slate-900"
                                   {{ old('access_restricted', $medicalData->access_restricted) ? 'checked' : '' }}>
                        </div>
                        <div>
                            <span class="block text-white font-semibold mb-1">Restreindre l'accès aux recruteurs</span>
                            <span class="block text-sm text-slate-400">Si cette case est cochée, aucun recruteur ne pourra consulter ce dossier médical sans vous en faire la demande explicite au préalable.</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold transition">
                Retour au Dashboard
            </a>
            <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black tracking-wide shadow-lg shadow-amber-500/20 transition-all hover:-translate-y-0.5">
                Chiffrer et Sauvegarder
            </button>
        </div>
    </form>
</div>
@endsection
