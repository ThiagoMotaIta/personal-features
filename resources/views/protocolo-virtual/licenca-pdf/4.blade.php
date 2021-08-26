
<body>
    <div class="content-pdf">
        <table id="matriculado">
            <thead>
                <tr>
                    <th class="centro" colspan="12">{{$protocolo_virtuais->tipoLicenca->descricao}}</th>
                </tr>
            </thead>
            <tbody>
                <tbody>
                    <tr>
                        <td class="esquerda" colspan="4">Nº do Processo: <p class="dado">PMC{{$protocolo_virtuais->id}}/{{ now()->year }}</p></td>
                        <td class="esquerda" colspan="4">Data de Emissão: <p class="dado">{{$protocolo_virtuais->created_at->format('d/m/Y')}}</p></td>
                        <td class="esquerda" colspan="4">Data de Vencimento: <p class="dado">{{$protocolo_virtuais->date_arquivar_protocolo}}</p></td>
                    </tr>
                </tbody>
            </tbody>
            <table>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Dados do Proprietário do Empreendimento</td>
                    </tr>
                    <tbody>
                        <tr>
                            @if($protocolo_virtuais->requerente == 0)    
                            <td class="esquerda" colspan="6">Concedido a: <p class="dado">{{ $protocolo_virtuais->empreendimento }}</p></td>
                            @else
                            <td class="esquerda" colspan="6">Concedido a: <p class="dado">{{ $protocolo_virtuais->user->name }}</p></td>
                            @endif
                            @if($protocolo_virtuais->licenca == 'pj')
                                <td class="esquerda" colspan="6">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->cnpj, '##.###.###/####-##') }}</p></td>
                            @else 
                                @if($protocolo_virtuais->requerente == 0)
                                <td class="esquerda" colspan="6">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}</p></td>
                                @else
                                <td class="esquerda" colspan="6">CNPJ/CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}}</p></td>
                                @endif
                            @endif
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Dados do Empreendimento</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda title" colspan="6">Inscrição IPTU <p class="dado">00000000000</p></td>
                            <td class="esquerda title" colspan="6">Endereço <p class="dado">{{ $protocolo_virtuais->endereco }}, N° {{ $protocolo_virtuais->numero }}, Bairro {{ $protocolo_virtuais->bairro }}, {{ $protocolo_virtuais->municipio }} {{ $protocolo_virtuais->uf }}</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="4">Área do Terreno <p class="dado">000000m²</p></td>
                            <td class="esquerda title" colspan="4">Área Construída <p class="dado">000000m²</p></td>
                            <td class="esquerda title" colspan="4">Área do Estabelecimento <p class="dado">000000m²</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="2">CNAE <p class="dado">0000000</p></td>
                            <td class="esquerda title" colspan="6">Atividade <p class="dado">xxxxxxxxxxxxxxxxxxxxxxxxxx</p></td>
                            <td class="esquerda title" colspan="2">Atividade Exercida <p class="dado">Sim</p></td>
                            <td class="esquerda title" colspan="2">Atividade Permitida <p class="dado">Sim</p></td>
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Responsável Legal pelo Empreendimento</td>
                    </tr>
                    <tbody>
                        <tr>
                            @if($protocolo_virtuais->requerente == 0)
                                <td class="esquerda" colspan="6">CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}</p></td>
                            @else
                                <td class="esquerda" colspan="6">CPF: <p class="dado">{{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}}</p></td>
                            @endif
                            @if($protocolo_virtuais->requerente == 0)    
                            <td class="esquerda" colspan="6">Nome do Responsável <p class="dado">{{ $protocolo_virtuais->empreendimento }}</p></td>
                            @else
                            <td class="esquerda" colspan="6">Nome do Responsável <p class="dado">{{ $protocolo_virtuais->user->name }}</p></td>
                            @endif
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Observações</td>
                    </tr>
                    <tbody>
                        <td class="esquerda" colspan="12"> 
                            <ol>
                                <li>Requerente desta Licença (pessoa que preencheu os dados): 
                                    <b>@if($protocolo_virtuais->requerente == 0) {{$protocolo_virtuais->empreendimento }} / CPF: {{ Helper::mask($protocolo_virtuais->cpf, '###.###.###-##')}}  @else {{ $protocolo_virtuais->user->name }} / {{ Helper::mask($protocolo_virtuais->user->cpf, '###.###.###-##')}} @endif</b></li>
                                <li>Caso seja constatado através de monitoramento ou fiscalização o não atendimento à legislação municipal, seja por omissão ou falsa descrição, este documento poderá ser cancelado ou cassado.</li>
                                <li>O empreendimento ficará passível de fiscalização e monitoramento pelo Órgão competente.</li>
                                <li> Este documento não exime o estabelecimento de possuir licença ambiental ou sanitária, quando exigido por lei, ficando a efetiva operação da(s) atividade(s) condicionada(s) à emissão desta.</li>
                            </ol>
                        </td>
                    </tbody>
                </thead>
            </table>
        </table>
    </div>

</body>

