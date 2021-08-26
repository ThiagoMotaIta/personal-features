@component('mail::message')
# Olá, {{ $user->nome }}!
 
<p>Esse é um e-mail de teste! =D</p>
<p>{{ $mensagem }}</p>
 
Numero do protocolo: <strong>{{ $user->id }}</strong>

@component('mail::button', ['url' => $url])
Visite o nosso site
@endcomponent
 
Obrigado,<br>
{{ config('app.name') }}
@endcomponent