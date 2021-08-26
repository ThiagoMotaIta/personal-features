
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        @page { margin: 0px; }
        
        body {
            margin: 0px;
            max-width: 100%;
            width: 100%;
            text-align: center;
            background-image: url("./img/geral/fundo_pdf.jpg");
            font-family: Arial, Helvetica, sans-serif;
        }

        .logo-pdf{
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        table {
            box-shadow: 0px 0px 10px black;
            margin: 0px 60px;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid black;
        }


        .centro {
            text-align: center;
        }

        .esquerda {
            text-align: left;
        }

        .direita {
            text-align: right;
        }

        .dado {
            color: red;
        }

        .title {
            font-weight: bold;
        }
        .qr-law{
            padding-top: 20px;
            display:flex;
            flex-direction: row;
            text-align: left;
            margin: 20px 60px;
        }
        .qr{
            align-items: flex-start;
        }
        .law{
            text-align: end;
            align-items: flex-end;
            margin-left: 250px;
            font-size: 12px;
        }
        .article{
            font-style: italic;
        }
        .law .title{
            font-weight: 800;
        }
        .new-content{
            margin-top: 100px;
        }
    </style>
</head>
<body>
    
    <div class="logo-pdf">
        <img src="./img/geral/licenca.png" alt="" width="400">
    </div>

    <div class="content">
        @include('protocolo-virtual.licenca-pdf.'.$protocolo_virtuais->tipoLicenca->id)
    </div>

    <div class="qr-law">
            <div class="qr">
                <img src="data:image/png;base64, {!! $qrcode !!}">
            </div>
            <div class="law">
                <p class="law-title">DECRETO LEI 2848/40 CÓDIGO PENAL</p>
                <p class="article">Art. 171 - Obter, para si ou para outrem, vantagem ilícita, em prejuízo alheio, induzindo ou mantendo alguém em erro, mediante artifício, ardil, ou qualquer outro meio fraudulento: Pena - reclusão, de um a cinco anos, e multa. </p>
                <p class="article">Art. 299 - Omitir, em documento público ou particular, declaração que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente relevante: Pena - reclusão, de um a cinco anos, e multa, se o documento é público, e reclusão de um a três anos, e multa, se o documento é particular. </p>
                <div><b>ESSE DOCUMENTO ATESTA A SUA REGULARIDADE, MANTENHA EM UM LOCAL VISÍVEL. PARA VERIFICAR SUA AUTENTICIDADE, CONSULTE O QR-CODE.</b></div>
            </div>
           
    </div>

</body>
</html>

