@extends('layouts.app')

@section('title', 'Finaliser l\'abonnement — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <span class="text-2xl font-black italic tracking-tighter uppercase"><span class="text-amber-500">Brain</span>Focus</span>
            </a>
            <h1 class="text-2xl font-bold mt-6">Validation de l'Abonnement</h1>
            <p class="text-slate-400 mt-2">Vous avez choisi le plan <span class="text-amber-400 font-bold uppercase">{{ $plan }}</span>.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl">
            <div class="mb-6 pb-6 border-b border-slate-800">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Total à payer</span>
                    <span class="text-2xl font-black text-white">
                        @if($plan === 'STANDARD') 29€
                        @elseif($plan === 'PRO') 79€
                        @elseif($plan === 'ACADEMIE') 199€
                        @elseif($plan === 'PREMIUM') 9€
                        @else 0€ @endif
                        <span class="text-sm text-slate-500 font-normal">/ mois</span>
                    </span>
                </div>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="{{ $plan }}">

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-1">Nom sur la carte</label>
                        <input type="text" name="card_name" value="{{ Auth::user()->name }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-amber-500 transition" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-1">Numéro de carte (Simulation)</label>
                        <div class="relative">
                            <input type="text" name="card_number" placeholder="4242 4242 4242 4242" class="w-full bg-slate-950 border border-slate-700 rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:border-amber-500 transition font-mono" required>
                            <svg class="w-5 h-5 text-slate-500 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Ceci est une simulation. Entrez n'importe quel numéro.</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-black py-4 rounded-xl flex items-center justify-center gap-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Payer et S'abonner
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <p class="text-xs text-slate-500 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></path></svg>
                Paiement sécurisé par Stripe
            </p>
        </div>
    </div>
</div>
@endsection
