@extends('layouts.app')

@section('title', 'Tableau de Bord Administrateur — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white flex flex-col md:flex-row">
    
    {{-- Sidebar Admin --}}
    <aside class="w-full md:w-64 bg-slate-900 border-r border-slate-800 flex flex-col hidden md:flex">
        <div class="p-6 border-b border-slate-800">
            <a href="{{ route('home') }}" class="inline-block mb-1">
                <span class="text-2xl font-black italic tracking-tighter uppercase"><span class="text-amber-500">Brain</span>Focus</span>
            </a>
            <p class="text-[10px] uppercase font-black tracking-widest text-indigo-400">Panel Administrateur</p>
        </div>
        <nav class="p-4 flex-1 space-y-2">
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-indigo-600/20 text-indigo-400 rounded-xl font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Vue d'ensemble
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-slate-800 hover:bg-red-500/20 text-slate-300 hover:text-red-400 transition rounded-lg text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Se Déconnecter
                </button>
            </form>
        </div>
    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 p-4 md:p-8 overflow-y-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-black mb-2">Super Dashboard</h1>
            <p class="text-slate-400">Bienvenue, Administrateur. Voici l'état de la plateforme.</p>
        </header>

        {{-- KPIS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-indigo-900/50 to-slate-900 border border-indigo-500/30 rounded-2xl p-6">
                <p class="text-indigo-400 text-xs font-bold uppercase tracking-wider mb-2">Revenu MRR</p>
                <p class="text-4xl font-black">{{ $mrr }} €</p>
                <p class="text-xs text-slate-500 mt-2">Revenu mensuel récurrent</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Total Joueurs</p>
                <p class="text-4xl font-black text-amber-400">{{ $totalPlayers }}</p>
                <p class="text-xs text-slate-500 mt-2">{{ $completionRate }}% de profils complétés</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Total Recruteurs</p>
                <p class="text-4xl font-black text-blue-400">{{ $totalRecruiters }}</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Santé & Trafic</p>
                <div class="flex flex-col gap-1 mt-1">
                    <p class="text-sm"><span class="font-bold text-white">{{ $medicalUsersCount }}</span> dossiers médicaux</p>
                    <p class="text-sm"><span class="font-bold text-white">{{ $totalViews }}</span> vues de profils</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            {{-- Répartition des Abonnements --}}
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-4">Abonnements Actifs</h2>
                <div class="space-y-3">
                    @forelse($planBreakdown as $plan => $count)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-300">{{ $plan }}</span>
                            <span class="px-2 py-1 bg-slate-800 rounded text-xs font-bold">{{ $count }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm italic">Aucun abonnement payant pour le moment.</p>
                    @endforelse
                </div>
            </div>

            {{-- Top 5 Stars --}}
            <div class="lg:col-span-2 bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Top 5 Talents (Favoris)
                </h2>
                <div class="space-y-4">
                    @forelse($topTalents as $index => $star)
                        <div class="flex items-center gap-4 bg-slate-800/50 p-3 rounded-xl border border-slate-700/50">
                            <span class="text-2xl font-black text-slate-700 w-6 text-center">{{ $index + 1 }}</span>
                            @if($star->profile_photo)
                                <img src="{{ asset('storage/' . $star->profile_photo) }}" alt="" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-500 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($star->first_name ?? 'J', 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="font-bold text-sm text-white">{{ $star->first_name }} {{ $star->last_name }}</p>
                                <p class="text-xs text-slate-400">{{ $star->position ?? 'Poste NC' }}</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-lg font-black text-amber-400">{{ $star->favorited_by_count }}</span>
                                <span class="text-[10px] uppercase text-slate-500">Favoris</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm italic">Aucun joueur mis en favori pour l'instant.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Liste des Utilisateurs --}}
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-slate-800 flex justify-between items-center">
                <h2 class="text-lg font-bold">Gestion des Utilisateurs</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-800/50 text-slate-400 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Utilisateur</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">Plan (Actif)</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($users as $u)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-6 py-4">
                                <p class="font-bold text-white">{{ $u->name }}</p>
                                <p class="text-xs text-slate-500">{{ $u->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-bold 
                                    @if($u->role === 'admin') bg-indigo-500/20 text-indigo-400
                                    @elseif($u->role === 'recruiter') bg-blue-500/20 text-blue-400
                                    @elseif($u->role === 'guardian') bg-purple-500/20 text-purple-400
                                    @else bg-amber-500/20 text-amber-400 @endif">
                                    {{ strtoupper($u->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($u->activeSubscription)
                                    <span class="text-emerald-400 font-bold">{{ $u->activeSubscription->plan_name }}</span>
                                @else
                                    <span class="text-slate-500">Gratuit</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($u->banned_at)
                                    <span class="text-red-500 font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        Banni
                                    </span>
                                @else
                                    <span class="text-emerald-500">Actif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($u->id !== Auth::id())
                                    @if($u->banned_at)
                                        <form action="{{ route('admin.users.unban', $u->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs px-3 py-1.5 rounded bg-slate-800 hover:bg-emerald-600 text-emerald-400 hover:text-white transition font-bold border border-emerald-900">
                                                Débannir
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.ban', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir bannir cet utilisateur ?');">
                                            @csrf
                                            <button type="submit" class="text-xs px-3 py-1.5 rounded bg-slate-800 hover:bg-red-600 text-red-400 hover:text-white transition font-bold border border-red-900">
                                                Bannir
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-slate-800">
                {{ $users->links() }}
            </div>
        </div>

    </main>
</div>
@endsection
