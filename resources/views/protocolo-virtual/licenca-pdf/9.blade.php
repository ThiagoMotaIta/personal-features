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
                    <td colspan="10">N° do processo <p class="dado">XXXXXXXXXXXXXXXXXX</p>
                    </td>
                    <td colspan="2">Data da Emissão <p class="dado">28/01/2000</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="10"> Dados do Requerente:</td>
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
                    <td class="esquerda" colspan="6">Endereço: <p class="dado"> Onde a inveja não chega</p>
                    </td>
                    <td class="esquerda" colspan="3">Inscrição IPTU:<p class="dado"> pivete</p>
                    </td>
                    <td class="esquerda" colspan="3">Matrícula:<p class="dado"> é sal </p>
                    </td>

                </tr>
                <tr>
                    <td class="esquerda" colspan="12">Descrição: <p class="dado">Zona dos cria do front</p></td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="esquerda title" colspan="10"> Confinantes</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="8">Nome do Responsável: <p class="dado">XXXXXXXXXX XXXXXXX XXXXXXXX
                        </p>
                    </td>
                    <td class="esquerda" colspan="2">CPF: <p class="dado">000.000.000-00</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>Ao Norte</li>
                            <li>Ao Sul</li>
                            <li>Ao Leste</li>
                            <li>Ao Oeste</li>
                        </ul>
                    </td>
                    <td colspan="5">
                        <ul>
                            <li>XXXXXXXXXX XXXXXXX XXXXXXXX</li>
                            <li>XXXXXXXXXX XXXXXXX XXXXXXXX</li>
                            <li>XXXXXXXXXX XXXXXXX XXXXXXXX</li>
                            <li>XXXXXXXXXX XXXXXXX XXXXXXXX</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="10"class="esquerda"> Certificamos para os devidos fins que os dados cadastrais, acima especificados, bem como os confrontantes, estão em
                        conformidade com as informações registradas junto a Prefeitura Municipal de Caucaia.</td>
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
                                <b>@if($protocolo_virtuais->requerente == 0) {{$protocolo_virtuais->empreendimento }} /
                                    CPF: {{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}} @else {{
                                    $protocolo_virtuais->user->name }} / {{ Helper::mask($protocolo_virtuais->user->cpf,
                                    '###.###.###-##')}} @endif</b>
                            </li>
                            <li>A revogação dessa licença poderá ocorrer caso seja constatado alterações em relação ao
                                projeto de publicidade aprovado.</li>
                            <li>Município não se responsabilizará por eventuais danos a pessoas ou propriedades,
                                decorrentes da inadequada execução, colocação ou manutenção dos veículos.</li>
                            <li>Se houver desistência da instalação do veículo de publicidade, ou caso seja removido ou
                                alterado, o interessado deverá solicitar o cancelamento desta Licença.</li>
                            <li>Esta Licença somente poderá ser renovada mediante solicitação do interessado em data
                                anterior a data de validade e pagamento da taxa expediente.</li>
                            <li>Esta Licença não exime o estabelecimento de possuir Alvará de Funcionamento bem como não
                                implica a inobservância das demais autorizações municipais.</li>
                            <li> Caso seja constatado através de monitoramento ou fiscalização o não atendimento à
                                legislação municipal, seja por omissão ou falsa descrição, este documento poderá ser
                                cancelado ou cassado.</li>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>