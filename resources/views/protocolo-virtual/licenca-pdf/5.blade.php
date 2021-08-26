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
                    <td colspan="6">N° do processo </td>
                    <td colspan="6">Data da Emissão</td>
                </tr>
                <tr>
                    <td class="esquerda" colspan="12">Em atendimento a Lei Complementar nº 63 de 12 de fevereiro de
                        2019, que dispõe sobre o
                        Parcelamento, Uso e Ocupação do Solo no Município de Caucaia e em consonância ao Artigo 111 que
                        estabelece que “antes da elaboração do projeto de loteamento, deverá o interessado,
                        preliminarmente,
                        solicitar ao órgão municipal, através da secretaria competente, que sejam definidas formalmente
                        em carta
                        de anuência as diretrizes para o uso do solo na área”, temos a informar que: Certificamos para
                        continuidade
                        nos demais licenciamentos, que o projeto prévio de parcelamento de solo, está de acordo com as
                        diretrizes
                        estabelecidas em legislação específica.
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="esquerda title" colspan="12">Dados do Proprietário do Empreendimento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="esquerda" colspan="8">Concedido a: <p class="dado">XXXXXXXXXXXXXXXXXX</p>
                    </td>
                    <td class="esquerda" colspan="4">CNPJ/CPF: <p class="dado">000.000.000-00</p>
                    </td>
                </tr>
                <tr>
                    <td class="esquerda title" colspan="12">Dados do Empreendimento</td>
                </tr>
                <tr>
                    <td colspan="12" class="esquerda"> Descrição
                        <p class="dado">Um terreno foreiro ao Patrimônio da Prefeitura Municipal de Caucaia, com denominação de FAZENDA NOVA OLINDA,
                            no lugar Camurumpim, neste Município, com Área Total de 588.304,74m² (58,8305ha Av.07/038.705), conforme
                            Matrícula nº 038.705, do Ofício Privativo de registro de Imóveis da Comarca de Caucaia, Ceará</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Inscrição IPTU <p class="dado">0000000000</p></td>
                    <td colspan="4">Endereço <p class="dado">0000000000</p></td>
                    <td colspan="4">Zoneamento <p class="dado">0000000000</p></td>
                </tr>
                <tr>
                    <td colspan="4">Matricula <p class="dado">0000000000</p></td>
                    <td colspan="4">Situação Fundiária <p class="dado">0000000000</p></td>
                    <td colspan="4">Área <p class="dado">0000000000</p> </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="new-content">
        <table>
            <thead>
                <tr>
                    <th class="centro title-protocolo" colspan="12">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">N° do processo <p class="dado">0000000000</p></td>
                    <td colspan="6">Data da Emissão <p class="dado">0000000000</p></td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="title" colspan="15"> Quador de Áreas</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">Tipo</td>
                    <td class="dado centro" colspan="2">(%)</td>
                    <td  class="dado centro" colspan="5">Área Exigida</td>
                    <td class="dado centro" colspan="5">Diretrizes</td>
                </tr>
                <tr>
                    <td colspan="3">Área Verde</td>
                    <td  class="dado centro" colspan="2">(%)</td>
                    <td class="dado centro" colspan="5">0000m²</td>
                    <td class="dado centro" colspan="5">0000m²</td>
                </tr>
                <tr>
                    <td colspan="3">Área Institucional</td>
                    <td class="dado centro" colspan="2">(%)</td>
                    <td  class="dado centro"colspan="5">0000m²</td>
                    <td class="dado centro" colspan="5">0000m²</td>
                </tr>
                <tr>
                    <td colspan="3">Banco de Terras</td>
                    <td class="dado centro"colspan="2">(%)</td>
                    <td class="dado centro" colspan="5">0000m²</td>
                    <td  class="dado centro" colspan="5">0000m²</td>
                </tr>
                <tr>
                    <td colspan="3">Sistema Viário</td>
                    <td class="dado centro" colspan="6">Conforme as diretrizes do Loteamento</td>
                    <td class="dado centro" colspan="6">0000m²</td>
                </tr>
                <tr>
                    <td colspan="3">Área Parcelável</td>
                    <td class="dado centro" colspan="12">0000m²</td>
                </tr>
                <tr>
                    <td colspan="3">Total</td>
                    <td class="dado centro" colspan="12">0000m²</td>
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