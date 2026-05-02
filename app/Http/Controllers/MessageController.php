<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer toutes les conversations selon le rôle
        if ($user->isRecruiter()) {
            $conversations = $user->recruiterConversations()
                ->with(['player', 'latestMessage'])
                ->get()
                ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at);
        } else {
            $conversations = $user->playerConversations()
                ->with(['recruiter', 'latestMessage'])
                ->get()
                ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at);
        }

        return view('messages.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        $user = Auth::user();

        // Sécurité
        if ($conversation->recruiter_id !== $user->id && $conversation->player_id !== $user->id) {
            abort(403, 'Accès non autorisé à cette conversation.');
        }

        // Marquer les messages reçus comme lus
        $conversation->messages()->where('sender_id', '!=', $user->id)->where('is_read', false)->update(['is_read' => true]);

        $messages = $conversation->messages()->with('sender')->oldest()->get();

        // Recharger les conversations pour la liste latérale
        if ($user->isRecruiter()) {
            $conversations = $user->recruiterConversations()
                ->with(['player', 'latestMessage'])
                ->get()
                ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at);
        } else {
            $conversations = $user->playerConversations()
                ->with(['recruiter', 'latestMessage'])
                ->get()
                ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at);
        }

        return view('messages.index', compact('conversations', 'conversation', 'messages'));
    }

    public function initiate(Request $request, User $player)
    {
        $user = Auth::user();

        if (!$user->isRecruiter()) {
            return back()->with('error', 'Seuls les recruteurs peuvent initier une conversation.');
        }

        if ($player->role !== 'player') {
            return back()->with('error', 'Vous ne pouvez contacter que des joueurs.');
        }

        // Vérifier si une conversation existe déjà
        $conversation = Conversation::where('recruiter_id', $user->id)
            ->where('player_id', $player->id)
            ->first();

        if ($conversation) {
            return redirect()->route('messages.show', $conversation->id);
        }

        // Vérifier les quotas si c'est une nouvelle conversation
        if (!$user->canContactPlayer()) {
            return back()->with('error', 'Vous avez atteint votre limite de contacts ou votre abonnement ne le permet pas.');
        }

        // Créer la conversation
        $conversation = Conversation::create([
            'recruiter_id' => $user->id,
            'player_id' => $player->id,
        ]);

        return redirect()->route('messages.show', $conversation->id);
    }

    public function store(Request $request, Conversation $conversation)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Sécurité
        if ($conversation->recruiter_id !== $user->id && $conversation->player_id !== $user->id) {
            abort(403);
        }

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'content' => $request->content,
            'is_read' => false,
        ]);

        return back();
    }
}
