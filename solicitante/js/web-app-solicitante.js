var qntdAluno = 1; // Inicia a quantidade de alunos

function iniciaSol(){
    $("#consultaSol-form").hide();
    $("#formSolEdit").hide();
    $("#formNovoAluno").hide();
    $("#formSolLink").show(500);
}

function consultaSol(){
    $("#formSolLink").hide();
    $("#consultaSol-form").show(500);
    $("#formSolEdit").hide();
    $("#formNovoAluno").hide();
    $('#cpfBusca').focus();
}

function cancelarEdit(){
    $("#idAluno-edit").val("");
    $("#escolaAlunoId-edit").val("");
    $("#escolaAluno-edit").val("");
    $("#serieAluno-edit").val("");
    $("#nomeAluno-edit").val("");
    $("#cpfAluno-edit").val("");
    $("#dataNascAluno-edit").val("");
    $("#formSolEdit").hide();
    $("#formNovoAluno").hide();
    $("#consultaSol-form").show(500);
}

function cancelarNovoAluno(){
    $("#idAluno-edit").val("");
    $("#escolaAlunoId-edit").val("");
    $("#escolaAluno-edit").val("");
    $("#serieAluno-edit").val("");
    $("#nomeAluno-edit").val("");
    $("#cpfAluno-edit").val("");
    $("#dataNascAluno-edit").val("");
    $("#formSolEdit").hide();
    $("#formNovoAluno").hide();
    $("#consultaSol-form").show(500);
}

// Solicitar beneficio
function validaEtapa1(){
    $("#msnErro").hide();
    $("#msnErro").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;
    var cpfResp = $("#cpfResp").val();
    var nomeResp = $("#nomeResp").val();
    var rgResp = $("#rgResp").val();
    var dataNascResp = $("#dataNascResp").val();

    if(!$("#check-tablet").is(":checked") && !$("#check-alim").is(":checked")) {
        $("#msnErro").append("<strong>BENEFÍCIOS</strong>: Selecione pelo menos um benefício.<br/>");
        validado = false;
    } else {
        if($("#check-tablet").is(":checked")) {
            $("#check-tablet").val(1);
        } else {
            $("#check-tablet").val(0);
        }
        if($("#check-alim").is(":checked")) {
            $("#check-alim").val(1);
        } else {
            $("#check-alim").val(0);
        }
    }

    if (cpfResp == "" || cpfResp.length < 14){
        $("#msnErro").append("<strong>CPF</strong> inválido.<br/>");
        validado = false;   
    } else {
        var val = cpfResp;
        if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 3);
            var val2 = val.substring(4, 7);
            var val3 = val.substring(8, 11);
            var val4 = val.substring(12, 14);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4);

            s = number;
            c = s.substr(0, 9);
            var dv = s.substr(9, 2);
            var d1 = 0;

            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (10 - i);
            }

            if (d1 == 0)
                result = false;

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
                result = false;

            d1 *= 2;
            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (11 - i);
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
                result = false;
            
            if (!result){
                $("#msnErro").append("<strong>CPF</strong> inválido.<br/>");
                validado = false;
            }
        }
    }

    if (nomeResp == ""){
        $("#msnErro").append("<strong>NOME COMPLETO</strong> precisa ser informado.<br/>");
        validado = false;
    }

    if (rgResp == "" || rgResp <= 0){
        $("#msnErro").append("<strong>RG</strong> precisa ser informado.<br/>");
        validado = false;
    }

    if (dataNascResp == ""){
        $("#msnErro").append("<strong>DATA DE NASCIMENTO</strong> precisa ser informado.");
        validado = false;
    }

    if (validado){
        $("#formEtapa1").hide();
        $("#formEtapa2").show(500);
        $("#descEtapa1").hide();
        $("#descEtapa2").show(500);
        $("#menuSol").click();
        var celular = $("#celularResp").val().replace(/[^0-9]+/g,'')
        $("#celularResp").val(celular);
    } else {
        $("#msnErro").show();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}

// Consultando CPF ja cadastrado
$('#cpfResp').on('blur', function() {
    $("#msnErro").hide();
    $("#msnErro").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");
    var cpf = $("#cpfResp").val();
    $.ajax({
     url: 'controller/buscacpf.php?cpf='+cpf,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].found == "S"){ // Se ja existe CPF
            $("#msnErro").append("<strong>CPF</strong> já Cadastrado.");
            $("#msnErro").show();
            $('html, body').animate({scrollTop:0}, 'slow');
            $("#btnEtapa1").attr("disabled","disabled");
         } else {
            $("#msnErro").hide();
            $("#btnEtapa1").removeAttr("disabled");
         }
        
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });
})

// Consultando CEP
$('#cepResp').on('blur', function() {
    $("#loadingCEP").show();
    var cep = $("#cepResp").val().replace(/\D/g, '');
    $.ajax({
      url: 'https://viacep.com.br/ws/'+cep+'/json/?callback=?',
      dataType: 'jsonp',
      crossDomain: true,
      contentType: "application/json",
      statusCode: {
        200: function(data) { 
                console.log(data);
                 $("#cidadeResp").val(data.localidade);
                 $("#logradouroResp").val(data.logradouro);
                 $("#bairroResp").val(data.bairro);
                 if (data.localidade != null){
                    $("#numeroResp").focus();
                 }
                 $("#loadingCEP").hide();
            }, // Ok
        400: function(msg) { console.log(msg);  }, // Bad Request
        404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
      }
    });
})


// Solicitar beneficio
function validaEtapa2(){
    $("#msnErro").hide();
    $("#msnErro").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;
    var cepResp = $("#cepResp").val();
    var numeroResp = $("#numeroResp").val();

    if (cepResp == ""){
        $("#msnErro").append("<strong>CEP</strong> inválido.<br/>");
        validado = false;
    }

    if (numeroResp == ""){
        $("#msnErro").append("<strong>NÚMERO DE ENDEREÇO</strong> precisa ser informado.<br/>");
        validado = false;
    }

    if (validado){
        $("#formEtapa2").hide();
        $("#formEtapa3").show(500);
        $("#descEtapa2").hide();
        $("#descEtapa3").show(500);
        $("#menuSol").click();
    } else {
        $("#msnErro").show();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}


// Autocomplete Escola
function buscaEscolas(aluno){
    $("#autoCompleteEscolas-"+aluno).html("");
    $("#autoCompleteEscolas-"+aluno).show();

    if ($('#escolaAluno-'+aluno).val() != ""){


        // Removendo acento
        var nameNormal = $("#escolaAluno-"+aluno).val();
        var mapaAcentosHex  = {
            a : /[\xE0-\xE6]/g,
            A : /[\xE0-\xE6]/g,
            e : /[\xE8-\xEB]/g,
            i : /[\xEC-\xEF]/g,
            o : /[\xF2-\xF6]/g,
            u : /[\xF9-\xFC]/g,
            c : /\xE7/g,
            n : /\xF1/g
        };

        for ( var letra in mapaAcentosHex ) {
            var expressaoRegular = mapaAcentosHex[letra];
            nameNormal = nameNormal.replace( expressaoRegular, letra );
        }

        $("#escolaAluno-"+aluno).val(nameNormal);


        $.ajax({
          url: 'controller/autocomplete-escolas.php?param='+$('#escolaAluno-'+aluno).val(),
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            for (var i=0; i < data.length; i++) {
                if (data[i].escola != undefined){
                    $("#autoCompleteEscolas-"+aluno).append("<button type='button' class='btn btn-primary btn-sm' onclick='selecionarEscola("+data[i].escolaInep+", "+data[i].escolaIdTabela+", "+aluno+")'><i class='fa fa-check-circle'></i> "+data[i].escola+" - "+data[i].condicao+" - "+data[i].escolaInep+"</button><br/><br/>");
                }
            }
            
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    } else {
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
    }
}

function selecionarEscola(escolaInep, escolaIdTabela, aluno){
    $("#escolaAlunoId-"+aluno).val(escolaInep);
    $("#autoCompleteEscolas-"+aluno).html("Carregando...");

    $.ajax({
     url: 'controller/buscaescola-id.php?param='+escolaIdTabela,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        $("#escolaAluno-"+aluno).val(data[0].escola+" - "+data[0].condicao);
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });
}


// Retirando acentos dos nomes
$('#name').on('blur', function(event) {

  var nameNormal = $("#name").val();
    var mapaAcentosHex  = {
        a : /[\xE0-\xE6]/g,
        A : /[\xE0-\xE6]/g,
        e : /[\xE8-\xEB]/g,
        i : /[\xEC-\xEF]/g,
        o : /[\xF2-\xF6]/g,
        u : /[\xF9-\xFC]/g,
        c : /\xE7/g,
        n : /\xF1/g
    };

    for ( var letra in mapaAcentosHex ) {
        var expressaoRegular = mapaAcentosHex[letra];
        nameNormal = nameNormal.replace( expressaoRegular, letra );
    }

    $("#name").val(nameNormal);

});


// Solicitar beneficio
function validaEtapa3(){
    $("#msnErro").hide();
    $("#msnErro").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;

    if ($("#idAluno-1").val() == "" || $("#idAluno-1").val().length < 12){
        $("#msnErro").append("<strong>IDENTIFICADOR DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#escolaAlunoId-1").val() == ""){
        $("#msnErro").append("<strong>ESCOLA</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#serieAluno-1").val() == ""){
        $("#msnErro").append("<strong>SÉRIE</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#nomeAluno-1").val() == ""){
        $("#msnErro").append("<strong>NOME DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#dataNascAluno-1").val() == ""){
        $("#msnErro").append("<strong>DATA DE NASCIMENTO</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#cpfAluno-1").val().length > 0){
        var val = $("#cpfAluno-1").val();
        if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 3);
            var val2 = val.substring(4, 7);
            var val3 = val.substring(8, 11);
            var val4 = val.substring(12, 14);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4);

            s = number;
            c = s.substr(0, 9);
            var dv = s.substr(9, 2);
            var d1 = 0;

            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (10 - i);
            }

            if (d1 == 0)
                result = false;

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
                result = false;

            d1 *= 2;
            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (11 - i);
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
                result = false;
            
            if (!result){
                $("#msnErro").append("<strong>CPF</strong> inválido.<br/>");
                validado = false;
            }
        }
    }

    if (validado){
        $("#formEtapa3").hide();
        $("#formEtapa4").show(500);
        $("#descEtapa3").hide();
        $("#descEtapa4").show(500);
        $("#menuSol").click();
    } else {
        $("#msnErro").show();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}

function fotoEducaCenso(acao){
    if (acao == "abrir"){
        $("#fotoEducaCenso").show(500);
    } else {
        $("#fotoEducaCenso").hide(500);
    }
}

// Solicitar beneficio
function validaEtapa4(){
    $("#msnErro").hide();
    $("#msnErro").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;

    if(!$("#check-1").is(":checked") || !$("#check-2").is(":checked")) {
        $("#msnErro").append("<strong>TERMOS DE CIÊNCIA E AUTORIZAÇÃO</strong> precisam estar selecionados.<br/>");
        validado = false;
    }

    if (validado){
        $("#aluno-qntd").val(qntdAluno);
        $("#loadinValidaEtapa4").show();
        var formulario = document.getElementById('formSol');
        formulario.submit();
    } else {
        $("#loadinValidaEtapa4").hide();
        $("#msnErro").show();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}

function voltarEtapa1(){
    $("#msnErro").hide();
    $("#formEtapa2").hide();
    $("#formEtapa1").show(500);
    $("#descEtapa2").hide();
    $("#descEtapa1").show(500);
    $("#menuSol").click();
}

function voltarEtapa2(){
    $("#msnErro").hide();
    $("#formEtapa3").hide();
    $("#formEtapa2").show(500);
    $("#descEtapa3").hide();
    $("#descEtapa2").show(500);
    $("#menuSol").click();

    qntdAluno = 0;
}

function voltarEtapa3(){
    $("#msnErro").hide();
    $("#formEtapa4").hide();
    $("#formEtapa3").show(500);
    $("#descEtapa4").hide();
    $("#descEtapa3").show(500);
    $("#menuSol").click();
}


function validarCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)      
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)       
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}

// Incrementa o formulario de aluno
function outroAluno(novoAluno){
    qntdAluno = qntdAluno + 1;
    var proxAluno = novoAluno+1;
    $("#btnAddAluno").removeAttr("onclick");
    $("#btnAddAluno").attr("onclick","outroAluno("+proxAluno+")");
    $("#novosAlunos").append(""+
        "<span id='spanAluno-"+novoAluno+"'><div id='aluno-"+novoAluno+"'>"+
                                "<h5 class='hAluno'>ALUNO "+novoAluno+" <small class='text-right' style='float:right;'><button type='button' class='btn btn-sm btn-danger' onclick='removeAluno("+novoAluno+")'><i class='fa fa-times-circle'></i></button></small></h5>"+
                                "<hr/>"+
                                "<div class='form-group'>"+
                                  "<label for='idAluno-"+novoAluno+"'>*Identificador do Aluno (12 dígitos)</label>"+
                                  "<input type='text' class='form-control' id='idAluno-"+novoAluno+"' name='idAluno-"+novoAluno+"' placeholder='Informe o identificador do Aluno (são 12 dígitos)' data-mask='000000000000' maxlength='12' minlength='12'>"+
                                "</div>"+
                                "<br/>"+
                                "<div class='form-group'>"+
                                  "<label for='escolaAluno-"+novoAluno+"'>*Escola</label>"+
                                  "<input type='hidden' id='escolaAlunoId-"+novoAluno+"' name='escolaAlunoId-"+novoAluno+"'>"+
                                  "<input type='text' class='form-control' id='escolaAluno-"+novoAluno+"' placeholder='Informe a Escola onde o Aluno está Matriculado' onkeyup='buscaEscolas("+novoAluno+")'>"+

                                  "<div id='autoCompleteEscolas-"+novoAluno+"' class='alert' style='display:none; padding-bottom: 0px; margin-bottom: 0px;'>"+
                                    
                                  "</div>"+
                                "</div>"+
                                "<br/>"+
                                "<div class='form-group'>"+
                                  "<label for='serieAluno-"+novoAluno+"'>*Série</label>"+
                                  "<select class='form-control' id='serieAluno-"+novoAluno+"' name='serieAluno-"+novoAluno+"'>"+
                                    "<option value=''>Selecione</option>"+
                                    "<option value='1'>1º ano</option>"+
                                    "<option value='2'>2º ano</option>"+
                                    "<option value='3'>3º ano</option>"+
                                    "<option value='4'>4º ano</option>"+
                                    "<option value='5'>5º ano</option>"+
                                    "<option value='6'>6º ano</option>"+
                                    "<option value='7'>7º ano</option>"+
                                    "<option value='8'>8º ano</option>"+
                                    "<option value='9'>9º ano</option>"+
                                    "<option value='21'>EJA I (1° ao 3° ano)</option>"+
                                    "<option value='22'>EJA II (4° e 5° ano)</option>"+
                                    "<option value='23'>EJA III (6° e 7° ano)</option>"+
                                    "<option value='24'>EJA IV (8° e 9° ano)</option>"+
                                  "</select>"+
                                "</div>"+
                                "<br/>"+
                                "<div class='form-group'>"+
                                  "<label for='nomeAluno-"+novoAluno+"'>*Nome</label>"+
                                  "<input type='text' class='form-control' id='nomeAluno-"+novoAluno+"' name='nomeAluno-"+novoAluno+"' placeholder='Informe o Nome Completo do Aluno'>"+
                                "</div>"+
                                "<br/>"+
                                "<div class='form-group'>"+
                                  "<label for='cpfAluno-"+novoAluno+"'>CPF (Opcional)</label>"+
                                  "<input type='text' class='form-control' id='cpfAluno-"+novoAluno+"' name='cpfAluno-"+novoAluno+"' placeholder='Informe o CPF do Aluno, caso possua' data-mask='000.000.000-00'>"+
                                "</div>"+
                                "<br/>"+
                                "<div class='form-group'>"+
                                  "<label for='dataNascAluno-"+novoAluno+"'>*Data de Nascimento</label>"+
                                  "<input type='date' class='form-control' id='dataNascAluno-"+novoAluno+"' name='dataNascAluno-"+novoAluno+"' placeholder='Informe a data de Nascimento do Aluno'>"+
                                "</div>"+
                                "<br/>"+
                              "</div>"+
                              "</span><!-- Fim Aluno "+novoAluno+" -->"); 
                              //"<button type='button' class='btn btn-secondary' onclick='outroAluno("+proxAluno+")'>Adicionar outro Aluno <i class='fa fa-plus-circle'></i></button><br/><br/> <!-- Fim Aluno 1 -->");
}


function removeAluno(aluno){
    $("#aluno-"+aluno).hide();
    $("#btnAddAluno").removeAttr("onclick");
    $("#btnAddAluno").attr("onclick","outroAluno("+aluno+")");
    $("#spanAluno-"+aluno).html("");
    qntdAluno = qntdAluno - 1;
}


//Busca sol
function buscaSol(){
    $("#buscaSolLista").html("");
    $("#loadingBuscaSol").show();

    
        $.ajax({
         url: 'controller/buscasolicitacoes.php?cpf='+$('#cpfBusca').val(),
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            for (var i=0; i < data.length; i++) {
                if (data[i].found == "S"){
                    $("#msnErroConsulta").hide();
                    $("#buscaSolLista").show();

                    var dataCadastro = data[i].dataCadastro.split("-");
                    var serie = data[i].serieAluno+"º ano";
                    var escola;

                    if (data[i].serieAluno == 0){
                        serie = 'Série não Informada';
                    }

                    if (data[i].serieAluno == 21){
                        serie = 'EJA I (1° ao 3° ano)';
                    }

                    if (data[i].serieAluno == 22){
                        serie = 'EJA II (4° e 5° ano)';
                    }

                    if (data[i].serieAluno == 23){
                        serie = 'EJA III (6° e 7° ano)';
                    }

                    if (data[i].serieAluno == 24){
                        serie = 'EJA IV (8° e 9° ano)';
                    }

                    $("#buscaSolLista").append("<div class='alert' style='background-color: #eaeaea;'><h4><span class='badge bg-secondary'>"+data[i].identificadorAluno+"</span></h4>Aluno: <strong>"+data[i].nomeAluno+"</strong> / "+serie+" <br/> <strong>"+data[i].nomeEscola+"</strong><br/><small>Solicitação realizada em "+dataCadastro[2]+"/"+dataCadastro[1]+"/"+dataCadastro[0]+"</small></br>");
                    if (data[i].solicitouTablet == "S"){ // Se pediu tablet
                        $("#buscaSolLista").append("Solicitação de <strong>TABLET</strong>:<br/>"+data[i].situacaoTablet+"<br/><br/>");
                    }
                     if (data[i].solicitouAlim == "S"){ // Se pediu Alimentacao
                      $("#buscaSolLista").append("Solicitação de <strong>ALIMENTAÇÃO</strong>:<br/>"+data[i].situacaoAlim+"");
                    }
                    $("#buscaSolLista").append("<hr/></div>");
                }
            }
            
            if (data.length == 0){
                $("#msnErroConsulta").show(500);
                $("#buscaSolLista").hide();
                $("#limparBuscaSol").hide();
            } else {
                $("#limparBuscaSol").show();
                // Libera ADD novo filho
            $("#buscaSolLista").append("<button type='button' class='btn btn-primary' onclick='addNovoAlunoFromBusca("+data[0].idSolicitante+")'>Informar Novo Aluno</button><hr/>");
            }
            $("#loadingBuscaSol").hide();
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    
}


function novaBuscaSol(){
    $("#msnErroConsulta").hide();
    $("#buscaSolLista").html("");
    $("#buscaSolLista").hide();
    $("#limparBuscaSol").hide();
    $('#cpfBusca').val("");
    $('#cpfBusca').focus();
}


function editarSol(solicitacao){
    $("#formSolEdit").show(500);
    $("#consultaSol-form").hide();

    $.ajax({
      url: 'controller/buscasolicitacoes-porid.php?id='+solicitacao,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        
        if (data[0].found == "S"){
            $("#idTable-edit").val(data[0].idTabelaAluno)
            $("#idAluno-edit").val(data[0].identificadorAluno);
            $("#escolaAlunoId-edit").val(data[0].escolaInepAluno);
            $("#escolaAluno-edit").val(data[0].escolaAluno);
            $("#serieAluno-edit").val(data[0].serieAluno);
            $("#nomeAluno-edit").val(data[0].nomeAluno);
            $("#cpfAluno-edit").val(data[0].cpfAluno);
            $("#dataNascAluno-edit").val(data[0].nascimentoAluno);
        }
        
        
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });
}


// Editar Solicitacao
function validaEditSol(){
    $("#msnErroEdit").hide();
    $("#msnErroEdit").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;

    if ($("#idAluno-edit").val() == "" || $("#idAluno-edit").val().length < 12){
        $("#msnErroEdit").append("<strong>IDENTIFICADOR DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#escolaAlunoId-edit").val() == ""){
        $("#msnErroEdit").append("<strong>ESCOLA</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#serieAluno-edit").val() == ""){
        $("#msnErroEdit").append("<strong>SÉRIE</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#nomeAluno-edit").val() == ""){
        $("#msnErroEdit").append("<strong>NOME DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#dataNascAluno-edit").val() == ""){
        $("#msnErroEdit").append("<strong>DATA DE NASCIMENTO</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#cpfAluno-edit").val().length > 0){
        var val = $("#cpfAluno-edit").val();
        if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 3);
            var val2 = val.substring(4, 7);
            var val3 = val.substring(8, 11);
            var val4 = val.substring(12, 14);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4);

            s = number;
            c = s.substr(0, 9);
            var dv = s.substr(9, 2);
            var d1 = 0;

            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (10 - i);
            }

            if (d1 == 0)
                result = false;

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
                result = false;

            d1 *= 2;
            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (11 - i);
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
                result = false;
            
            if (!result){
                $("#msnErroEdit").append("<strong>CPF</strong> inválido.<br/>");
                validado = false;
            }
        }
    }

    if (validado){
        $("#loadinValidaEditSol").show();
        var formulario = document.getElementById('formEditSol');
        formulario.submit();
    } else {
        $("#loadinValidaEditSol").hide();
        $("#msnErroEdit").show();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}

// Autocomplete Escola
function buscaEscolasEdit(){
    var aluno = "edit";
    $("#autoCompleteEscolas-"+aluno).html("");
    $("#autoCompleteEscolas-"+aluno).show();

    if ($('#escolaAluno-'+aluno).val() != ""){


        // Removendo acento
        var nameNormal = $("#escolaAluno-"+aluno).val();
        var mapaAcentosHex  = {
            a : /[\xE0-\xE6]/g,
            A : /[\xE0-\xE6]/g,
            e : /[\xE8-\xEB]/g,
            i : /[\xEC-\xEF]/g,
            o : /[\xF2-\xF6]/g,
            u : /[\xF9-\xFC]/g,
            c : /\xE7/g,
            n : /\xF1/g
        };

        for ( var letra in mapaAcentosHex ) {
            var expressaoRegular = mapaAcentosHex[letra];
            nameNormal = nameNormal.replace( expressaoRegular, letra );
        }

        $("#escolaAluno-"+aluno).val(nameNormal);


        $.ajax({
          url: 'controller/autocomplete-escolas.php?param='+$('#escolaAluno-'+aluno).val(),
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            for (var i=0; i < data.length; i++) {
                if (data[i].escola != undefined){
                    $("#autoCompleteEscolas-"+aluno).append("<button type='button' class='btn btn-primary btn-sm' onclick='selecionarEscolaEdit("+data[i].escolaInep+", "+data[i].escolaIdTabela+")'><i class='fa fa-check-circle'></i> "+data[i].escola+" - "+data[i].condicao+" - "+data[i].escolaInep+"</button><br/><br/>");
                }
            }
            
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    } else {
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
    }
}

function selecionarEscolaEdit(escolaInep, escolaIdTabela){
    var aluno = "edit";
    $("#escolaAlunoId-"+aluno).val(escolaInep);
    $("#autoCompleteEscolas-"+aluno).html("Carregando...");

    $.ajax({
     url: 'controller/buscaescola-id.php?param='+escolaIdTabela,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        $("#escolaAluno-"+aluno).val(data[0].escola+" - "+data[0].condicao);
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });
}


function addNovoAlunoFromBusca(idSolicitante){
    $("#id-solicitante-novoAluno").val(idSolicitante);
    $("#consultaSol-form").hide();
    $("#formNovoAluno").show(500);
}


// Novo Aluno FROM busca
function validaNovoAluno(){
    $("#msnErroNovoAluno").hide();
    $("#msnErroNovoAluno").html("<i class='fa fa-exclamation-triangle'></i> <strong>Erro:</strong><hr/>");

    var validado = true;

    if ($("#idAluno-novoAluno").val() == "" || $("#idAluno-novoAluno").val().length < 12){
        $("#msnErroNovoAluno").append("<strong>IDENTIFICADOR DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#escolaAlunoId-novoAluno").val() == ""){
        $("#msnErroNovoAluno").append("<strong>ESCOLA</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#serieAluno-novoAluno").val() == ""){
        $("#msnErroNovoAluno").append("<strong>SÉRIE</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#nomeAluno-novoAluno").val() == ""){
        $("#msnErroNovoAluno").append("<strong>NOME DO ALUNO</strong> inválido.<br/>");
        validado = false;
    }

    if ($("#dataNascAluno-novoAluno").val() == ""){
        $("#msnErroNovoAluno").append("<strong>DATA DE NASCIMENTO</strong> inválida.<br/>");
        validado = false;
    }

    if ($("#cpfAluno-novoAluno").val().length > 0){
        var val = $("#cpfAluno-novoAluno").val();
        if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 3);
            var val2 = val.substring(4, 7);
            var val3 = val.substring(8, 11);
            var val4 = val.substring(12, 14);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4);

            s = number;
            c = s.substr(0, 9);
            var dv = s.substr(9, 2);
            var d1 = 0;

            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (10 - i);
            }

            if (d1 == 0)
                result = false;

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
                result = false;

            d1 *= 2;
            for (i = 0; i < 9; i++) {
                d1 += c.charAt(i) * (11 - i);
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
                result = false;
            
            if (!result){
                $("#msnErroNovoAluno").append("<strong>CPF</strong> inválido.<br/>");
                validado = false;
            }
        }
    }

    if (validado){
        $("#loadinValidanNovoAluno").show();
        var formulario = document.getElementById('formNovoAlunoFromBusca');
        formulario.submit();
    } else {
        $("#msnErroNovoAluno").show();
        $("#loadinValidaEditSol").hide();
        $("#loadinValidanNovoAluno").hide();
        $('html, body').animate({scrollTop:0}, 'slow');
    }
}

// Autocomplete Escola
function buscaEscolasNovoAluno(){
    var aluno = "novoAluno";
    $("#autoCompleteEscolas-"+aluno).html("");
    $("#autoCompleteEscolas-"+aluno).show();

    if ($('#escolaAluno-'+aluno).val() != ""){


        // Removendo acento
        var nameNormal = $("#escolaAluno-"+aluno).val();
        var mapaAcentosHex  = {
            a : /[\xE0-\xE6]/g,
            A : /[\xE0-\xE6]/g,
            e : /[\xE8-\xEB]/g,
            i : /[\xEC-\xEF]/g,
            o : /[\xF2-\xF6]/g,
            u : /[\xF9-\xFC]/g,
            c : /\xE7/g,
            n : /\xF1/g
        };

        for ( var letra in mapaAcentosHex ) {
            var expressaoRegular = mapaAcentosHex[letra];
            nameNormal = nameNormal.replace( expressaoRegular, letra );
        }

        $("#escolaAluno-"+aluno).val(nameNormal);


        $.ajax({
          url: 'controller/autocomplete-escolas.php?param='+$('#escolaAluno-'+aluno).val(),
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            for (var i=0; i < data.length; i++) {
                if (data[i].escola != undefined){
                    $("#autoCompleteEscolas-"+aluno).append("<button type='button' class='btn btn-primary btn-sm' onclick='selecionarEscolaNovoAluno("+data[i].escolaInep+", "+data[i].escolaIdTabela+")'><i class='fa fa-check-circle'></i> "+data[i].escola+" - "+data[i].condicao+" - "+data[i].escolaInep+"</button><br/><br/>");
                }
            }
            
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    } else {
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
    }
}

function selecionarEscolaNovoAluno(escolaInep, escolaIdTabela){
    var aluno = "novoAluno";
    $("#escolaAlunoId-"+aluno).val(escolaInep);
    $("#autoCompleteEscolas-"+aluno).html("Carregando...");

    $.ajax({
     url: 'controller/buscaescola-id.php?param='+escolaIdTabela,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        $("#escolaAluno-"+aluno).val(data[0].escola+" - "+data[0].condicao);
        $("#autoCompleteEscolas-"+aluno).hide();
        $("#autoCompleteEscolas-"+aluno).html("");
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });
}


function addNovoAlunoFromBusca(idSolicitante){
    $("#id-solicitante-novoAluno").val(idSolicitante);
    $("#consultaSol-form").hide();
    $("#formNovoAluno").show(500);
}