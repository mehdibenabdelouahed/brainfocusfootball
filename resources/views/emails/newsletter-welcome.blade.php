<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>🧠 Bienvenue sur Brain Focus Football !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #020617; color: #f1f5f9; font-family: 'Inter', -apple-system, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px 24px; }
        .logo-section { text-align: center; padding: 40px 0 32px; }
        .logo-section img { width: 80px; height: 80px; object-fit: contain; }
        .logo-section h1 { font-size: 24px; font-weight: 800; margin-top: 16px; color: #f59e0b; }
        .card { background: #0f172a; border: 1px solid #1e293b; border-radius: 24px; padding: 40px; margin: 24px 0; }
        .badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3); color: #f59e0b; padding: 8px 16px; border-radius: 100px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 24px; }
        .greeting { font-size: 28px; font-weight: 800; margin-bottom: 16px; color: #fff; }
        .greeting span { color: #f59e0b; }
        p { color: #94a3b8; font-size: 15px; line-height: 1.8; margin-bottom: 16px; }
        .features { display: grid; gap: 16px; margin: 32px 0; }
        .feature { display: flex; align-items: flex-start; gap: 16px; background: #1e293b; border-radius: 16px; padding: 20px; }
        .feature-icon { width: 40px; height: 40px; background: rgba(245,158,11,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .feature-title { font-weight: 700; color: #f1f5f9; margin-bottom: 4px; font-size: 14px; }
        .feature-desc { color: #64748b; font-size: 13px; }
        .cta-btn { display: block; width: 100%; background: linear-gradient(135deg, #f59e0b, #d97706); color: #0f172a; text-align: center; padding: 18px 32px; border-radius: 100px; font-size: 16px; font-weight: 800; text-decoration: none; margin: 32px 0; }
        .footer { text-align: center; padding: 32px 0 0; border-top: 1px solid #1e293b; }
        .footer p { font-size: 12px; color: #475569; }
        .footer a { color: #f59e0b; }
    </style>
</head>
<body>
<div class="container">
    <div class="logo-section">
        <h1>Brain Focus Football</h1>
        <p style="color: #64748b; font-size: 13px; margin-top: 8px;">Les champions commencent par l'esprit</p>
    </div>

    <div class="card">
        <div class="badge">
            <span>🎉</span> Bienvenue dans la communauté
        </div>

        <div class="greeting">
            Tu es maintenant <span>dans la boucle</span> !
        </div>

        @if($subscriber->name)
            <p>Bonjour <strong style="color: #f1f5f9;">{{ $subscriber->name }}</strong>,</p>
        @endif

        <p>Merci de rejoindre Brain Focus Football. Tu vas recevoir <strong style="color: #f1f5f9;">chaque semaine un conseil mental, nutritionnel ou tactique</strong> pour avancer vers tes objectifs football.</p>

        <p>Voilà ce qui t'attend dans la newsletter :</p>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">🧠</div>
                <div>
                    <div class="feature-title">Préparation mentale</div>
                    <div class="feature-desc">Techniques de visualisation, gestion du stress, confiance en soi</div>
                </div>
            </div>
            <div class="feature">
                <div class="feature-icon">🥗</div>
                <div>
                    <div class="feature-title">Nutrition & Récupération</div>
                    <div class="feature-desc">Ce que mangent les pros, les erreurs à éviter, les recettes gagnantes</div>
                </div>
            </div>
            <div class="feature">
                <div class="feature-icon">🎯</div>
                <div>
                    <div class="feature-title">Carrière & Recrutement</div>
                    <div class="feature-desc">Comment les recruteurs pensent, comment te faire remarquer</div>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="cta-btn">
            Visiter Brain Focus Football →
        </a>

        <p style="font-size: 13px; text-align: center; color: #475569;">Si tu ne t'es pas inscrit à cette newsletter, tu peux ignorer cet email.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Brain Focus Football. Tous droits réservés.</p>
        <p style="margin-top: 8px;"><a href="{{ route('home') }}">brainfocusfootball.com</a></p>
    </div>
</div>
</body>
</html>
