

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
                        <td class="esquerda title" colspan="10">Dados da Publicidade</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="esquerda title" colspan="10">Endereço de Instalação: <p class="dado">{{ $protocolo_virtuais->endereco }}, N° {{ $protocolo_virtuais->numero }}, Bairro {{ $protocolo_virtuais->bairro }}, {{ $protocolo_virtuais->municipio }} {{ $protocolo_virtuais->uf }}</p></td>
                        </tr>
                        <tr>
                            <td class="esquerda title" colspan="10">Tipo de Veículo: <p class="dado">Endereço</p></td>
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
                <thead>
                    <tr>
                        <td class="esquerda title" colspan="10">Observações</td>
                    </tr>
                    <tbody>
                        <td class="esquerda" colspan="10"> 
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
                    </tbody>
                </thead>
            </table>
        </table>
    </div>
    <!-- <div class="qr-law">
        <div class="qr">
            <img src="data:image/png;base64, {!! $qrcode !!}">
        </div>
        <div class="law">
            <p class="law-title">DECRETO LEI 2848/40 CÓDIGO PENAL</p>
            <p class="article">Art. 171 - Obter, para si ou para outrem, vantagem ilícita, em prejuízo alheio, induzindo ou mantendo alguém em erro, mediante artifício, ardil, ou qualquer outro meio fraudulento: Pena - reclusão, de um a cinco anos, e multa. </p>
            <p class="article">Art. 299 - Omitir, em documento público ou particular, declaração que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente relevante: Pena - reclusão, de um a cinco anos, e multa, se o documento é público, e reclusão de um a três anos, e multa, se o documento é particular. </p>
            <div class="atestado">ESSE DOCUMENTO ATESTA A SUA REGULARIDADE, MANTENHA EM UM LOCAL VISÍVEL. PARA VERIFICAR SUA AUTENTICIDADE, CONSULTE O QR-CODE.</div>
        </div>
       
    </div> -->
</body>


