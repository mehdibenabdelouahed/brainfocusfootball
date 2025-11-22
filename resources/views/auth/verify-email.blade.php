@extends('layouts.app')

@section('title', 'Vérifiez votre email')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-24 w-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mb-6">
                <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-white">
                Vérifiez votre adresse email
            </h2>
            <p class="mt-2 text-sm text-gray-300">
                Un email de vérification a été envoyé à <strong class="text-indigo-400">{{ auth()->user()->email }}</strong>
            </p>
        </div>

        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-2xl">
            @if (session('status') == 'verification-link-sent')
                <div class="rounded-md bg-green-500/20 p-4 border border-green-500/50 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-300">
                                Un nouveau lien de vérification a été envoyé!
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4 text-gray-200">
                <p class="flex items-start">
                    <svg class="h-6 w-6 text-indigo-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm">Consultez votre boîte de réception et cliquez sur le lien de vérification.</span>
                </p>
                <p class="flex items-start">
                    <svg class="h-6 w-6 text-indigo-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm">Le lien expire dans 60 minutes.</span>
                </p>
                <p class="flex items-start">
                    <svg class="h-6 w-6 text-indigo-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                    </svg>
                    <span class="text-sm">Vérifiez également votre dossier spam si vous ne trouvez pas l'email.</span>
                </p>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10">
                <p class="text-sm text-gray-300 text-center mb-4">
                    Vous n'avez pas reçu l'email ?
                </p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200"
                    >
                        Renvoyer l'email de vérification
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 hover:text-white transition-colors">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
