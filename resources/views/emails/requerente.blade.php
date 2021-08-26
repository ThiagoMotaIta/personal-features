@component('mail::message')
# Olá, {{ $requerente->name }}!

<p>Protocolo aguardando confirmação:</p>
 
@component('mail::button', ['url' => $url])
Visite o nosso site
@endcomponent
 
Obrigado,<br>
{{ config('app.name') }}
@endcomponent