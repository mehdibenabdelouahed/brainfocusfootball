<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.guardian_subject') }}</title>
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
            <h2>{{ __('emails.guardian_hello') }}</h2>
            <p>{!! __('emails.guardian_body_1', ['childName' => $childName]) !!}</p>
            <p>{!! __('emails.guardian_body_2') !!}</p>
            <p>{!! __('emails.guardian_body_3') !!}</p>
            
            <div class="credentials-box">
                <p>{{ __('emails.guardian_username') }} <span style="color: #f59e0b;">{{ $guardianEmail }}</span></p>
                <p>{{ __('emails.guardian_temp_password') }} <span style="color: #f59e0b;">{{ $temporaryPassword }}</span></p>
            </div>
            
            <div class="button-container">
                <a href="{{ route('login') }}" class="button">{{ __('emails.guardian_button') }}</a>
            </div>
            
            <p><em>{{ __('emails.guardian_hint') }}</em></p>
            
            <p>{{ __('emails.guardian_not_guardian') }}</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Brain Focus Football. {{ __('emails.all_rights_reserved') }}</p>
            <p>{{ __('emails.auto_email_footer') }}</p>
        </div>
    </div>
</body>
</html>
