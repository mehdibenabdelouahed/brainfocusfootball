<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un recruteur s'intéresse à vous !</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #0f172a; font-family: 'Inter', Arial, sans-serif; color: #e2e8f0; }
        .wrapper { max-width: 640px; margin: 40px auto; padding: 20px; }
        .card { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid #334155; border-radius: 24px; overflow: hidden; }
        .hero { background: linear-gradient(135deg, #1c1208 0%, #27180a 50%, #0f172a 100%); padding: 48px 40px; text-align: center; border-bottom: 1px solid #f59e0b33; position: relative; }
        .hero-badge { display: inline-block; background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.4); color: #fbbf24; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; padding: 6px 16px; border-radius: 100px; margin-bottom: 20px; }
        .star-icon { font-size: 64px; display: block; margin-bottom: 16px; }
        .hero h1 { font-size: 28px; font-weight: 900; color: #ffffff; margin-bottom: 12px; line-height: 1.2; }
        .hero p { color: #94a3b8; font-size: 15px; line-height: 1.6; max-width: 480px; margin: 0 auto; }
        .body { padding: 40px; }
        .highlight-box { background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.03)); border: 1px solid rgba(245,158,11,0.2); border-radius: 16px; padding: 24px; margin-bottom: 28px; }
        .highlight-box .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #f59e0b; margin-bottom: 8px; }
        .highlight-box .value { font-size: 22px; font-weight: 800; color: #ffffff; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px; }
        .info-item { background: rgba(51,65,85,0.4); border: 1px solid #334155; border-radius: 12px; padding: 16px; }
        .info-item .label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #64748b; margin-bottom: 6px; }
        .info-item .value { font-size: 15px; font-weight: 700; color: #e2e8f0; }
        .cta-section { text-align: center; margin-top: 32px; }
        .cta-button { display: inline-block; background: linear-gradient(135deg, #f59e0b, #d97706); color: #0f172a; font-size: 15px; font-weight: 800; text-decoration: none; padding: 16px 40px; border-radius: 100px; letter-spacing: 0.02em; }
        .footer { padding: 24px 40px; border-top: 1px solid #1e293b; text-align: center; }
        .footer p { color: #475569; font-size: 12px; line-height: 1.6; }
        .footer strong { color: #64748b; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="card">
        <div class="hero">
            <span class="hero-badge">Brain Focus Football</span>
            <span class="star-icon">⭐</span>
            <h1>Votre profil a été mis en favori !</h1>
            <p>Bonne nouvelle, {{ $player->first_name }} ! Un recruteur professionnel vient d'ajouter votre profil à sa liste de talents surveillés.</p>
        </div>

        <div class="body">
            <div class="highlight-box">
                <div class="label">Organisation intéressée</div>
                <div class="value">{{ $recruiter->org_name ?? 'Un recruteur professionnel' }}</div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="label">Votre poste</div>
                    <div class="value">{{ $player->position ?? 'Non renseigné' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Votre club</div>
                    <div class="value">{{ $player->current_club ?? 'Sans club' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Ajouté aux favoris</div>
                    <div class="value">{{ now()->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Statut profil</div>
                    <div class="value" style="color: #34d399;">✓ Visible</div>
                </div>
            </div>

            <p style="color: #94a3b8; font-size: 14px; line-height: 1.8; margin-bottom: 24px;">
                🎯 Un recruteur qui met un profil en favori est en phase d'évaluation active. 
                Assurez-vous que votre profil est complet et à jour pour maximiser vos chances d'être contacté.
            </p>

            <div class="cta-section">
                <a href="{{ url('/profil/' . $player->user_id) }}" class="cta-button">
                    Voir mon profil public →
                </a>
            </div>
        </div>

        <div class="footer">
            <p>Vous recevez cet e-mail car un recruteur a interagi avec votre profil sur <strong>Brain Focus Football</strong>.<br>
            Cette notification vous a été envoyée automatiquement. Vous ne pouvez pas répondre à cet e-mail.</p>
        </div>
    </div>
</div>
</body>
</html>
