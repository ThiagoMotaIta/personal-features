<body>
    <div class="content-pdf">
        <table>
            <thead>
                <tr>
                    <th class="centro title-protocolo" colspan="12">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="3">Nº do Processo: <p class="dado">15152155115</p>
                    </td>
                    <td class="esquerda" colspan="3">Data de Emissão: <p class="dado">09/06/2021</p>
                    </td>
                    <td class="esquerda" colspan="3">Data de Montagem: <p class="dado">09/06/2021</p>
                    </td>
                    <td class="esquerda" colspan="3">Data de Desmontagem: <p class="dado">09/06/2021</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead><tr>
                <th class="esquerda title" colspan="12">Dados do Responsável pelo Evento</th>
            </tr></thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="8">Concedido a: <p class="dado">XXXXXXXXXXXXXXXXXX</p>
                    </td>
                    <td class="esquerda" colspan="4">CNPJ/CPF: <p class="dado">000.000.000-00</p>
                    </td>
                </tr>
                <tr>
                    <td class="esquerda title" colspan="12">Dados do Evento</td>
                </tr>
                <tr>
                    <td colspan="6"class="esquerda"> Nome do Evento
                        <p class="dado">Sana Fest</p>
                    </td>
                    <td colspan="6"class="esquerda">Data do Evento
                        <p class="dado">09/06/2021</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" >Endereço: 
                        <p class="dado"> Onde a Inveja não chega</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">Descrição
                        <p class="dado"> Só os otaku e kpop</p>    
                    </td>
                </tr>
                <tr>
                    <td colspan="12"> Equipamentos Autorizados
                        <p class="dado"> alguma coisa </p>  
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="title"> Dados Responsáveis Técnicos</td>
                </tr>
                <tr>
                    <td class="esquerda" colspan="4">Tipo: <p class="dado">15152155115</p>
                    </td>
                    <td class="esquerda" colspan="4">Nome do responsável: <p class="dado">09/06/2021</p>
                    </td>
                    <td class="esquerda" colspan="4">CREA/CAU: <p class="dado">09/06/2021</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td colspan="15" class="esquerda title">Observações</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="15">
                        <ol>
                            <li>Requerente desta Licença (pessoa que preencheu os dados): 
                                <b>@if($protocolo_virtuais->requerente == 0) {{$protocolo_virtuais->empreendimento }} / CPF: {{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}  @else {{ $protocolo_virtuais->user->name }} / {{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}} @endif</b></li>
                            <li>A revogação dessa licença poderá ocorrer caso seja constatado alterações em relação ao projeto de publicidade aprovado.</li>
                            <li>Município não se responsabilizará por eventuais danos a pessoas ou propriedades, decorrentes da inadequada execução, colocação ou manutenção dos veículos.</li>
                            <li>Se houver desistência da instalação do veículo de publicidade, ou caso seja removido ou alterado, o interessado deverá solicitar o cancelamento desta Licença.</li>
                            <li>Esta Licença somente poderá ser renovada mediante solicitação do interessado em data anterior a data de validade e pagamento da taxa expediente.</li>
                            <li>Esta Licença não exime o estabelecimento de possuir Alvará de Funcionamento bem como não implica a inobservância das demais autorizações municipais.</li>
                            <li> Caso seja constatado através de monitoramento ou fiscalização o não atendimento à legislação municipal, seja por omissão ou falsa descrição, este documento poderá ser cancelado ou cassado.</li>
                        </ol>
                    </td>
                </tr>
            </tbody>   
        </table>
    </div>
</body>