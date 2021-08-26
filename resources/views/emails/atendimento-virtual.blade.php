@component('mail::message')
# Olá, {{ $atendimentoVirtual->nome }}!
 
<p>Esse é um e-mail de teste! =D</p>
<p>Segue link atendimento virtual:</p>
<a target="_blank" href="{{$link}}">{{$link}}</a>
 
@component('mail::button', ['url' => $url])
Visite o nosso site
@endcomponent
 
Obrigado,<br>
{{ config('app.name') }}
@endcomponent