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
                    <td colspan="4">N° do processo <p class="dado">XXXXXXXXXXXXXXXXXX</p></td>
                    <td colspan="4">Data da Emissão <p class="dado">XXXXXXXXXXXXXXXXXX</p></td>
                    <td colspan="4">Data de Validade<p class="dado">XXXXXXXXXXXXXXXXXX</p> </td>
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
                    <td class="esquerda" colspan="6">Inscrição IPTU:<p class="dado"> pivete</p>
                    </td>
                    <td class="esquerda" colspan="6">Endereço: <p class="dado"> Onde a inveja não chega</p>
                    </td>
                </tr>
                <tr>
                    <td class="esquerda" colspan="4">Área do terreno: <p class="dado">00000m²</p>
                    </td>
                    <td class="esquerda" colspan="4">Área Construída:<p class="dado">00000m²</p>
                    </td>
                    <td class="esquerda" colspan="4">Área do Estabelecimento:<p class="dado">00000m²</p>
                    </td>
                </tr>
                <tr>
                <td class="esquerda" colspan="3">CNAE: <p class="dado">00000m²</p>
                    </td>
                    <td class="esquerda" colspan="3">Atividade:<p class="dado">00000m²</p>
                    </td>
                    <td class="esquerda" colspan="3">Atividade Exercida:<p class="dado">00000m²</p>
                    </td>
                    <td class="esquerda" colspan="3">Atividade Permitida:<p class="dado">00000m²</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="10"> Responsável Legal pelo empreendimento:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="8">Nome do Responsável: <p class="dado">XXXXXXXXXX XXXXXXX XXXXXXXX</p>
                    </td>
                    <td class="esquerda" colspan="2">CPF: <p class="dado">000.000.000-00</p>
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