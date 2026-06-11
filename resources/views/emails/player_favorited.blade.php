<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.player_fav_subject') }}</title>
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
            <span class="hero-badge">{{ __('emails.player_fav_hero_badge') }}</span>
            <span class="star-icon">⭐</span>
            <h1>{{ __('emails.player_fav_header') }}</h1>
            <p>{{ __('emails.player_fav_body', ['name' => $player->first_name]) }}</p>
        </div>

        <div class="body">
            <div class="highlight-box">
                <div class="label">{{ __('emails.player_fav_interested_org') }}</div>
                <div class="value">{{ $recruiter->org_name ?? __('emails.player_fav_pro_recruiter') }}</div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="label">{{ __('emails.player_fav_your_position') }}</div>
                    <div class="value">{{ $player->position ?? __('profile.not_specified') }}</div>
                </div>
                <div class="info-item">
                    <div class="label">{{ __('emails.player_fav_your_club') }}</div>
                    <div class="value">{{ $player->current_club ?? __('profile.no_club') }}</div>
                </div>
                <div class="info-item">
                    <div class="label">{{ __('emails.player_fav_added_on') }}</div>
                    <div class="value">{{ now()->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="label">{{ __('emails.player_fav_profile_status') }}</div>
                    <div class="value" style="color: #34d399;">{{ __('emails.player_fav_visible') }}</div>
                </div>
            </div>

            <p style="color: #94a3b8; font-size: 14px; line-height: 1.8; margin-bottom: 24px;">
                {{ __('emails.player_fav_info_tip') }}
            </p>

            <div class="cta-section">
                <a href="{{ route('profile.show', $player->user_id) }}" class="cta-button">
                    {{ __('emails.player_fav_btn') }}
                </a>
            </div>
        </div>

        <div class="footer">
            <p>{!! __('emails.player_fav_footer') !!}</p>
        </div>
    </div>
</div>
</body>
</html>
