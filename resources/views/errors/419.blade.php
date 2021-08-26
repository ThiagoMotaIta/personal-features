{{-- @php
  Auth::logout();
  Session::flush();
@endphp
<script>
  window.location = '';
</script> --}}

@extends('errors::illustrated-layout')
{{-- @extends('errors::layout') --}}
{{-- @extends('errors::minimal') --}}

@section('title', __('Sessão expirou'))
@section('code', '419')
@section('message', __('Sua sessão expirou click no botão abaixo para voltar para aplicação.'))

{{-- <h2>{{ $exception->getMessage() }}</h2> --}}