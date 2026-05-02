<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorisation parentale requise</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #0f172a;
            color: #e2e8f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #0f172a;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #1e293b;
        }
        .header h1 {
            color: #f59e0b; /* amber-500 */
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px 20px;
            background-color: #1e293b;
            border-radius: 16px;
            margin-top: 20px;
            border: 1px solid #334155;
        }
        .content h2 {
            color: #f8fafc;
            font-size: 20px;
            margin-top: 0;
        }
        .content p {
            line-height: 1.6;
            color: #cbd5e1;
        }
        .credentials-box {
            background-color: #0f172a;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px 8px 8px 4px;
        }
        .credentials-box p {
            margin: 5px 0;
            color: #f8fafc;
            font-weight: bold;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            background-color: #f59e0b;
            color: #0f172a;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            display: inline-block;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Brain Focus Football</h1>
        </div>
        
        <div class="content">
            <h2>Bonjour,</h2>
            <p>Votre enfant <strong>{{ $childName }}</strong> s'est récemment inscrit(e) sur la plateforme <strong>Brain Focus Football</strong>.</p>
            <p>Conformément à la législation en vigueur et à notre politique de protection des mineurs (RGPD), le profil sportif de votre enfant ne sera visible par les recruteurs que lorsque vous aurez donné votre consentement légal.</p>
            
            <p>Un compte "Tuteur" a été automatiquement créé pour vous afin de gérer cette autorisation et de suivre son évolution. Voici vos identifiants provisoires :</p>
            
            <div class="credentials-box">
                <p>Identifiant (Email) : <span style="color: #f59e0b;">{{ $guardianEmail }}</span></p>
                <p>Mot de passe provisoire : <span style="color: #f59e0b;">{{ $temporaryPassword }}</span></p>
            </div>
            
            <div class="button-container">
                <a href="{{ route('login') }}" class="button">Me connecter et valider le profil</a>
            </div>
            
            <p><em>Nous vous conseillons de modifier ce mot de passe provisoire dès votre première connexion dans les paramètres de votre compte.</em></p>
            
            <p>Si vous n'êtes pas le tuteur légal de cet enfant ou s'il s'agit d'une erreur, vous pouvez ignorer cet e-mail.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Brain Focus Football. Tous droits réservés.</p>
            <p>Ceci est un e-mail automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
