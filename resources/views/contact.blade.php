@extends('layouts.app')

@section('title', 'Contact - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white py-12 px-4">
    <div class="max-w-6xl mx-auto">
        {{-- En-tête --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">
                Contactez-nous
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto">
                Une question ? Un partenariat ? Ou simplement envie de discuter football ?
                N'hésitez pas à nous envoyer un message.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Formulaire de contact --}}
            <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-8 shadow-xl">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-xl p-4 text-green-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nom complet</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                                placeholder="Votre nom">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                                placeholder="votre@email.com">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-slate-300 mb-2">Sujet</label>
                        <input type="text" id="subject" name="subject" required
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Le sujet de votre message">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition"
                            placeholder="Votre message..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full px-6 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-lg shadow-lg shadow-amber-500/30 transition transform hover:scale-[1.02] active:scale-[0.98]">
                        Envoyer le message
                    </button>
                </form>
            </div>

            {{-- Informations de contact --}}
            <div class="space-y-8">
                {{-- Info Box --}}
                <div class="bg-slate-900/30 border border-slate-800 rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">Informations</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-200">Email</h4>
                                <p class="text-slate-400">contact@brainfocusfootball.com</p>
                                <p class="text-slate-500 text-sm mt-1">Réponse sous 24-48h</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500 shrink-0">   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
