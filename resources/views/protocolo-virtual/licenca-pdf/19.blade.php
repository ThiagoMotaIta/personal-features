<body>
    <div class="content-pdf">
        <table >
            <thead>
                <tr>
                    <th class="centro title-protocolo" colspan="6">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="2">Nº do Processo: <p class="dado">15152155115</p>
                    </td>
                    <td class="esquerda" colspan="2">Data de Emissão: <p class="dado">09/06/2021</p>
                    </td>
                    <td class="esquerda" colspan="2">Data de Validade: <p class="dado">09/06/2021</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="10"> Dados do Proprietário do empreendimento:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="8">Concedido a: <p class="dado">XXXXXXXXXX XXXXXXX XXXXXXXX</p>
                    </td>
                    <td class="esquerda" colspan="2">CNPJ/CPF: <p class="dado">000.000.000-00</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="12"> Dados do empreendimento:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="6">Inscrição IPTU/Matrícula Imóvel:<p class="dado"> pivete</p>
                    </td>
                    <td class="esquerda" colspan="6" >Área do Terreno: <p class="dado"> 0000m²</p>
                    </td>
                </tr>
                <tr>
                <td class="esquerda" colspan="12" >Endereço: <p class="dado"> Onde a inveja não chega</p>
                    </td>
                </tr>
                <tr>
                    <td class="esquerda" colspan="12">Atividade Licenciada:<p class="dado">XXXXXXXXXXXXXXXXXXXXXXXXXX
XXXXXXXXXXXXXXXXXXXXXXXXXX
XXXXXXXXXXXXXXXXXXXXXXXXXX</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="15"> Dados dos Responsáveis Técnicos:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="5">Tipo:<p class="dado"> De todas elas</p>
                    </td>
                    <td class="esquerda" colspan="5">Nome do Responsável:<p class="dado"> De todas elas</p>
                    </td>
                    <td class="esquerda" colspan="5">CREA/CAU:<p class="dado"> De todas elas</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="new-content">
            <table>
                <thead>
                    <tr>
                        <th class="centro title-protocolo" colspan="6">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="esquerda" colspan="2">Nº do Processo: <p class="dado">15152155115</p>
                        </td>
                        <td class="esquerda" colspan="2">Data de Emissão: <p class="dado">09/06/2021</p>
                        </td>
                        <td class="esquerda" colspan="2">Data de Validade: <p class="dado">09/06/2021</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="new-content">
                <table>
                    <thead>
                        <tr>
                            <td colspan="15" class="esquerda title">Condicionantes</td>
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
        </div>
    </div>
</body>