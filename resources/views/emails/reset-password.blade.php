<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.reset_password_subject') }}</title>
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
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('emails.reset_password_header') }}</h1>
        </div>
        <div class="content">
            <p>{{ __('emails.reset_password_hello') }}</p>
            <p>{{ __('emails.reset_password_body_1') }}</p>
            <p>{{ __('emails.reset_password_body_2') }}</p>
            
            <center>
                <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" class="button">
                    {{ __('emails.reset_password_btn') }}
                </a>
            </center>

            <div class="warning">
                <p>{!! __('emails.reset_password_warning') !!}</p>
            </div>

            <p>{{ __('emails.reset_password_fallback') }}</p>
            <p style="word-break: break-all; color: #667eea;">
                {{ route('password.reset', ['token' => $token, 'email' => $email]) }}
            </p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} BrainFocusFootball. {{ __('emails.all_rights_reserved') }}</p>
            <p>{{ __('emails.auto_email_footer') }}</p>
        </div>
    </div>
</body>
</html>
