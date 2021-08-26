<option value="" selected disabled>Selecione um assunto</option>
@foreach($assuntos as $key => $assunto)
    @php 
        $descricao = mb_convert_case($assunto->descricao, MB_CASE_TITLE, "UTF-8");         
    @endphp
  <option value="{{$assunto->id}}" {{ $old == $assunto->id ? 'selected':''}}>{{$descricao}}</option>
@endforeach
