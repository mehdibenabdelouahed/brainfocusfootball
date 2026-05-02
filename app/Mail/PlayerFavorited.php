<?php

namespace App\Mail;

use App\Models\Player;
use App\Models\Recruiter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PlayerFavorited extends Mailable
{
    use Queueable, SerializesModels;

    public Player $player;
    public Recruiter $recruiter;

    public function __construct(Player $player, Recruiter $recruiter)
    {
        $this->player = $player;
        $this->recruiter = $recruiter;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⭐ Un recruteur a mis votre profil en favori !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.player_favorited',
        );
    }
}
