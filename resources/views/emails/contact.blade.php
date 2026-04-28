<x-mail::message>
# 📨 Nouveau message de contact

Vous avez reçu une nouvelle demande via le formulaire de contact de **Brain Focus Football**.

<x-mail::panel>
### 👤 Informations de l'expéditeur
**Nom :** {{ $name }}  
**Email :** [{{ $email }}](mailto:{{ $email }})  
**Sujet :** {{ $subject }}
</x-mail::panel>

### 💬 Message :
{{ $messageBody }}

<x-mail::button :url="'mailto:' . $email . '?subject=Re: ' . $subject" color="success">
Répondre directement
</x-mail::button>

Merci,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
