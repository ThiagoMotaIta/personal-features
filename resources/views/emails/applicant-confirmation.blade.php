@component('mail::message')
# Olá, {{ $protocolo->user->name }}!

<p>Resposta a solicitação de confirmação de resposanbilidade</p>

@component('mail::button', ['url' => $url])
Visite o nosso site
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
