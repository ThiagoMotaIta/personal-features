

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
                        <td class="esquerda title" colspan="10"> Dados do Responsável pela Publicidade</td>
                    </tr>
                    <tbody>
                        <tr>
                            @if($protocolo_virtuais->requerente == 0)    
                            <td class="esquerda" colspan="8">Concedido a: <p class="dado">{{ $protocolo_virtuais->empreendimento }}</p></td>
                            @else
                            <td class="esquerda" colspan="8">Concedido a: <p class="dado">{{ $protocolo_virtuais->user->name }}</p></td>
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
                        <td class="esquerda title" colspan="10">Dados do Empreendimento</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda title" colspan="4">Inscrição IPTU/ Matrícula imóvel: <p class="dado">0000000</p></td>
                            <td class="esquerda title" colspan="6">Área do Terreno: <p class="dado">Endereço</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="10">Endereço – Coordenadas geográficas <p class="dado">{{ $protocolo_virtuais->endereco }}, N° {{ $protocolo_virtuais->numero }}, Bairro {{ $protocolo_virtuais->bairro }}, {{ $protocolo_virtuais->municipio }} {{ $protocolo_virtuais->uf }}</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="10">Atividade Licenciada <p class="dado">Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p></td>
                        </tr>
                    </tbody>
                </thead>
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="12">Dados dos Responsáveis Técnicos</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda" colspan="4">Tipo <p class="dado">tipo</p></td>
                            <td class="esquerda" colspan="4">Nome do Responsável <p class="dado">yuri card</p></td>
                            <td class="esquerda" colspan="4">CREA/CAU <p class="dado">CREA</p></td>
                        </tr>
                    </tbody>
                </thead>
            </table>
        </table>
    </div>
</body>


