
<body>

    <div class="content-pdf">
        <table id="matriculado">
            <thead>
                <tr>
                    <th class="centro" colspan="6">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                </tr>
            </thead>
            <tbody>
                <tbody>
                    <tr>
                        <td class="esquerda" colspan="2">Nº do Processo: <p class="dado">PMC{{$protocolo_virtuais->id}}/{{ now()->year }}</p></td>
                        <td class="esquerda" colspan="2">Data de Emissão: <p class="dado">{{$protocolo_virtuais->created_at->format('d/m/Y')}}</p></td>
                        <td class="esquerda" colspan="2">Data de Vencimento: <p class="dado">{{$protocolo_virtuais->date_arquivar_protocolo}}</p></td>
                    </tr>
                </tbody>
            </tbody>
            <table>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="10">Dados do Requerente</td>
                    </tr>
                    <tbody>
                        <tr>
                            @if($protocolo_virtuais->requerente == 0)    
                            <td class="esquerda" colspan="8">Nome: <p class="dado">{{ $protocolo_virtuais->empreendimento }}</p></td>
                            @else
                            <td class="esquerda" colspan="8">Nome: <p class="dado">{{ $protocolo_virtuais->user->name }}</p></td>
                            @endif
                            @if($protocolo_virtuais->licenca == 'pj')
                                <td class="esquerda" colspan="2">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->cnpj, '##.###.###/####-##') }}</p></td>
                            @else 
                                @if($protocolo_virtuais->requerente == 0)
                                <td class="esquerda" colspan="2">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}</p></td>
                                @else
                                <td class="esquerda" colspan="2">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}}</p></td>
                                @endif
                            @endif
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="10">Dados do Empreendimento para Consulta</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda title" colspan="4">Inscrição IPTU <p class="dado">00000000000</p></td>
                            <td class="esquerda title" colspan="6">Endereço <p class="dado">{{ $protocolo_virtuais->endereco }}, N° {{ $protocolo_virtuais->numero }}, Bairro {{ $protocolo_virtuais->bairro }}, {{ $protocolo_virtuais->municipio }} {{ $protocolo_virtuais->uf }}</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="3">Área do Total Terreno <p class="dado">000000m²</p></td>
                            <td class="esquerda title" colspan="3">Área do Terreno Utilizada <p class="dado">000000m²</p></td>
                            <td class="esquerda title" colspan="2">Área Construída <p class="dado">000000m²</p></td>
                            <td class="esquerda title" colspan="2">Zoneamento <p class="dado">ZGB</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title font-sm" colspan="1">CNAE <p class="dado">0000000</p></td>
                            <td class="esquerda title" colspan="6">Atividade <p class="dado">000000m²</p></td>
                            <td class="esquerda title font-sm" colspan="1">Classificação <p class="dado">000000m²</p></td>
                            <td class="esquerda title font-sm" colspan="1">Exercida no local? <p class="dado">000000m²</p></td>
                            <td class="esquerda title font-sm" colspan="1">Adequabilidade <p class="dado">ZGB</p></td>
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Indicadores Urbanos da Zona</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda" colspan="2">Taxa de Ocupação (máx) <p class="dado">000%</p></td>
                            <td class="esquerda" colspan="2">Índ. de Aproveitamento (máx) <p class="dado">000</p></td>
                            <td class="esquerda" colspan="2">Tx. de Permeabilidade (mín) <p class="dado">000%</p></td>
                            <td class="esquerda" colspan="2">Recuos (Frente, Fundo, Lateral) <p class="dado">000, 000, 000</p></td>
                            <td class="esquerda" colspan="2">Gabarito (máx) <p class="dado">000</p></td>
                        </tr>|
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="10">Observações</td>
                    </tr>
                    <tbody>
                        <td class="esquerda" colspan="10"> 
                            <ol>
                                <li>Requerente desta Licença (pessoa que preencheu os dados): 
                                    <b>@if($protocolo_virtuais->requerente == 0) {{$protocolo_virtuais->empreendimento }} / CPF: {{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}  @else {{ $protocolo_virtuais->user->name }} / {{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}} @endif</b></li>
                                <li>Esta Consulta é uma ferramenta informativa, sendo sua análise realizada com base nos dados e informações prestadas pelo requerente, ficando a cargo do requerente atualizar os documentos do imóvel (Certidão do IPTU e matrícula) antes ou após a sua análise.</li>
                                <li>Esta Consulta não possui efeito de licença e não regulariza a edificação ou a atividade, devendo ser utilizada para dar início aos processos de licenciamento.</li>
                                <li>Caso o resultado seja PERMITIDO para todas as atividades informadas, esta Consulta possuirá o efeito de anuência, devendo ser apresentada no processo de licenciamento da construção ou da atividade a ser exercida. </li>
                            </ol>
                        </td>
                    </tbody>
                </thead>
            </table>
        </table>
    </div>

</body>
