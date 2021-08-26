<option value="">Selecione o horário do atendimento</option>
@foreach($horarios as $key => $horario)
    @foreach(explode(' ', $horario->horario) as $hora) 
        <option value="{{$horario->horario}}" {{ $old == $horario->horario ? 'selected':''}}>{{$hora[0]}}{{$hora[1]}}:{{$hora[3]}}{{$hora[4]}}</option>
    @endforeach
@endforeach