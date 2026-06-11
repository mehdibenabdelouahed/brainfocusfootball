<x-mail::message>
# {{ __('emails.contact_subject') }}

{!! __('emails.contact_received_body') !!}

<x-mail::panel>
### {{ __('emails.contact_sender_info') }}
**{{ __('emails.contact_name') }} :** {{ $name }}  
**{{ __('emails.contact_email') }} :** [{{ $email }}](mailto:{{ $email }})  
**{{ __('emails.contact_subject_label') }} :** {{ $subject }}
</x-mail::panel>

### {{ __('emails.contact_message_label') }}
{{ $messageBody }}

<x-mail::button :url="'mailto:' . $email . '?subject=Re: ' . $subject" color="success">
{{ __('emails.contact_reply_button') }}
</x-mail::button>

{{ __('emails.thanks') }},<br>
{{ __('emails.team_regards', ['app_name' => config('app.name')]) }}
</x-mail::message>
