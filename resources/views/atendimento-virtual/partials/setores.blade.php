    <option value="">Selecione o setor</option>
  @foreach($setores as $key => $setor)
    <option value="{{$setor->id}}" {{ $old == $setor->id ? 'selected':''}}>{{$setor->nome}}</option>
  @endforeach
