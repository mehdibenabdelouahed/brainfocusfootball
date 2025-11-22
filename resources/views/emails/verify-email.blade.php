<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
        }
        .content p {
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s;
        }
        .button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #014361;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✉️ Vérification de votre email</h1>
        </div>
        <div class="content">
            <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
            <p>Bienvenue sur BrainFocusFootball! Pour finaliser votre inscription, veuillez vérifier votre adresse email en cliquant sur le bouton ci-dessous :</p>
            
            <center>
                <a href="{{ $verificationUrl }}" class="button">
                    Vérifier mon adresse email
                </a>
            </center>

            <div class="info-box">
                <p><strong>ℹ️ Information :</strong> Ce lien de vérification expirera dans 60 minutes.</p>
            </div>

            <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :</p>
            <p style="word-break: break-all; color: #667eea;">
                {{ $verificationUrl }}
            </p>

            <p>Si vous n'avez pas créé de compte sur BrainFocusFootball, ignorez simplement cet email.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} BrainFocusFootball. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
