@component('mail::message')
# Olá, {{$name != "" ? $name : $protocolo->user->name }}

Sua linceça esta pronta para ser gerada

@component('mail::button', ['url' => $url])
Visite o nosso site
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
