@extends('layouts.app')

@section('title', 'Messagerie — Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white flex flex-col">
    @include('partials.navbar')

    <div class="flex-1 max-w-7xl mx-auto w-full px-4 py-8 flex gap-0 h-[calc(100vh-72px)]">

        {{-- ============ PANNEAU GAUCHE : Liste des conversations ============ --}}
        <div class="w-full md:w-80 lg:w-96 flex-shrink-0 flex flex-col bg-slate-900 border border-slate-800 rounded-2xl {{ isset($conversation) ? 'hidden md:flex' : 'flex' }} overflow-hidden">
            
            {{-- Header --}}
            <div class="p-5 border-b border-slate-800 flex-shrink-0">
                <h1 class="text-lg font-bold flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Messagerie
                </h1>
                @php
                    $unreadCount = 0;
                    foreach($conversations as $conv) {
                        $unreadCount += $conv->messages->where('sender_id', '!=', Auth::id())->where('is_read', false)->count();
                    }
                @endphp
                @if($unreadCount > 0)
                    <p class="text-xs text-amber-400 mt-1">{{ $unreadCount }} message(s) non-lu(s)</p>
                @endif
            </div>

            {{-- Liste des conversations --}}
            <div class="flex-1 overflow-y-auto">
                @forelse($conversations as $conv)
                    @php
                        // Identifier l'interlocuteur selon notre rôle
                        $interlocutor = (Auth::id() === $conv->recruiter_id) 
                            ? ($conv->player ?? $conv->recruiter) 
                            : ($conv->recruiter ?? $conv->player);
                        $isActive = isset($conversation) && $conversation->id === $conv->id;
                        $hasUnread = $conv->messages->where('sender_id', '!=', Auth::id())->where('is_read', false)->count() > 0;
                    @endphp
                    <a href="{{ route('messages.show', $conv->id) }}" 
                       class="flex items-center gap-3 p-4 border-b border-slate-800 hover:bg-slate-800/50 transition {{ $isActive ? 'bg-slate-800/80' : '' }}">
                        
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-lg flex-shrink-0 relative">
                            {{ strtoupper(substr($interlocutor->name ?? '?', 0, 1)) }}
                            @if($hasUnread)
                                <span class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-amber-500 rounded-full border-2 border-slate-900"></span>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-white truncate">{{ $interlocutor->name }}</p>
                            @if($conv->latestMessage)
                                <p class="text-xs text-slate-500 truncate">{{ Str::limit($conv->latestMessage->content, 40) }}</p>
                            @else
                                <p class="text-xs text-slate-600 italic">Nouvelle conversation</p>
                            @endif
                        </div>

                        @if($conv->latestMessage)
                            <span class="text-[10px] text-slate-600 flex-shrink-0">{{ $conv->latestMessage->created_at->diffForHumans(null, true) }}</span>
                        @endif
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center h-full py-16 px-6 text-center">
                        <svg class="w-12 h-12 text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <p class="text-slate-400 font-semibold mb-1">Aucune conversation</p>
                        @if(Auth::user()->isRecruiter())
                            <p class="text-slate-600 text-xs">Trouvez un joueur dans la galerie des talents et cliquez sur "Contacter".</p>
                        @else
                            <p class="text-slate-600 text-xs">Les recruteurs qui vous contactent apparaîtront ici.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ============ PANNEAU DROIT : Zone de chat ============ --}}
        @if(isset($conversation) && isset($messages))
            @php
                $interlocutor = (Auth::id() === $conversation->recruiter_id) ? $conversation->player : $conversation->recruiter;
            @endphp
            <div class="flex-1 flex flex-col bg-slate-900/50 border border-slate-800 md:rounded-r-2xl border-l-0 overflow-hidden">
                
                {{-- Header du chat --}}
                <div class="p-4 border-b border-slate-800 flex items-center gap-3 flex-shrink-0">
                    <a href="{{ route('messages.index') }}" class="md:hidden p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    <div class="w-9 h-9 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                        {{ strtoupper(substr($interlocutor->name ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-sm text-white">{{ $interlocutor->name }}</p>
                        <p class="text-xs text-slate-500 capitalize">{{ $interlocutor->role }}</p>
                    </div>
                </div>

                {{-- Messages --}}
                <div id="messages-container" class="flex-1 overflow-y-auto p-6 space-y-4">
                    @forelse($messages as $msg)
                        @php $isMe = $msg->sender_id === Auth::id(); @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} gap-3">
                            @if(!$isMe)
                                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-1">
                                    {{ strtoupper(substr($msg->sender->name ?? '?', 0, 1)) }}
                                </div>
                            @endif
                            <div class="max-w-md">
                                <div class="px-4 py-3 rounded-2xl text-sm leading-relaxed {{ $isMe ? 'bg-amber-500 text-slate-950 rounded-br-sm font-medium' : 'bg-slate-800 text-white rounded-bl-sm' }}">
                                    {{ $msg->content }}
                                </div>
                                <p class="text-[10px] text-slate-600 mt-1 {{ $isMe ? 'text-right' : 'text-left' }}">
                                    {{ $msg->created_at->format('H:i') }}
                                    @if($isMe && $msg->is_read) · <span class="text-amber-500/60">Lu</span> @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-full">
                            <p class="text-slate-600 text-sm">Démarrez la conversation en envoyant le premier message !</p>
                        </div>
                    @endforelse
                </div>

                {{-- Formulaire d'envoi --}}
                <div class="p-4 border-t border-slate-800 flex-shrink-0">
                    <form action="{{ route('messages.store', $conversation->id) }}" method="POST" class="flex items-end gap-3">
                        @csrf
                        <div class="flex-1 bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus-within:border-amber-500 transition">
                            <textarea name="content" rows="1" placeholder="Écrivez votre message..." required
                                      class="w-full bg-transparent text-white text-sm resize-none focus:outline-none placeholder-slate-500"
                                      oninput="this.style.height=''; this.style.height = Math.min(this.scrollHeight, 120) + 'px'"></textarea>
                        </div>
                        <button type="submit" class="p-3 bg-amber-500 hover:bg-amber-400 text-slate-950 rounded-xl transition flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        @else
            {{-- Placeholder si pas de conversation sélectionnée --}}
            <div class="hidden md:flex flex-1 items-center justify-center bg-slate-900/30 border border-slate-800 border-l-0 rounded-r-2xl">
                <div class="text-center">
                    <svg class="w-16 h-16 text-slate-800 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <p class="text-slate-600 font-semibold">Sélectionnez une conversation</p>
                </div>
            </div>
        @endif

    </div>
</div>

<script>
    // Scroll automatique vers le bas dans le chat
    const container = document.getElementById('messages-container');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
</script>
@endsection
