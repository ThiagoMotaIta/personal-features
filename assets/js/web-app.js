// =================== MENUS - SITE

$('#menuCampeonatos').on('click', function() {
    window.location.href = "campeonatos.php";
})

$('#menuXTreinos').on('click', function() {
    window.location.href = "xtreinos.php";
})

$('#menuLiga').on('click', function() {
    window.location.href = "ligas.php";
})

$('#menuDisputas').on('click', function() {
    window.location.href = "disputas.php";
})

$('#menuLoja').on('click', function() {
    window.location.href = "loja.php";
})

$('#menuRankingSquad').on('click', function() {
    window.location.href = "ranking-team.php";
})

$('#menuRankingSolo').on('click', function() {
    window.location.href = "ranking-solo.php";
})

$('#menuPerfil').on('click', function() {
    window.location.href = "perfil.php";
})

$('#menuSair').on('click', function() {
    window.location.href = "controller/logoff.php";
})

$('#menuBr').on('click', function() {
    window.location.href = "controller/mudaIdioma.php?lang=br";
})

$('#menuEng').on('click', function() {
    window.location.href = "controller/mudaIdioma.php?lang=eng";
})


// Links GAMES
$('#menuGame1').on('click', function() {
    window.location.href = "jogo-perfil.php?game=1";
})

$('#menuGame2').on('click', function() {
    window.location.href = "jogo-perfil.php?game=2";
})

$('#menuGame3').on('click', function() {
    window.location.href = "jogo-perfil.php?game=3";
})

$('#menuGame4').on('click', function() {
    window.location.href = "jogo-perfil.php?game=4";
})

$('#menuGame5').on('click', function() {
    window.location.href = "jogo-perfil.php?game=5";
})

$('#menuGame6').on('click', function() {
    window.location.href = "jogo-perfil.php?game=6";
})

$('#menuGame7').on('click', function() {
    window.location.href = "jogo-perfil.php?game=7";
})

$('#menuGame8').on('click', function() {
    window.location.href = "jogo-perfil.php?game=8";
})




function chamaLinkCamps(){
  window.location.href = "campeonatos.php";
}


//  ============== PRE INSCRICAO
function validarPreInscricao(){
    var validado = true;

    var sEmail  = $("#email").val();
    var nome  = $("#name").val();
    var emailConfirm  = $("#emailConfirm").val();
    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(sEmail))||sEmail.match(illegalChars)){
        $("#msnErroEmail").show(500);
        validado = false;
    }else{
        $("#msnErroEmail").hide(500);
    }

    if (nome == ""){
        $("#msnErroNome").show(500);
        validado = false;
    } else {
        $("#msnErroNome").hide(500);
    }

    if (emailConfirm != sEmail){
        $("#msnErroEmailConfirm").show(500);
        validado = false;
    } else {
        $("#msnErroEmailConfirm").hide(500);
    }

    if (validado){
        var formulario = document.getElementById('formPreInsc');
        formulario.submit();
    }
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

$('#nameReg').on('blur', function(event) {

  var nameNormal = $("#nameReg").val();
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

    $("#nameReg").val(nameNormal);

});


// Retirando acentos dos nomes
$('#perfilName').on('blur', function(event) {

  var nameNormal = $("#perfilName").val();
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

    $("#perfilName").val(nameNormal);

});


/*$('#nameReg').on('blur', function() {
    $("#btnCriarConta").show(500);
})*/


// =============== RESGATAR PRE-INSCRITO

function verificarPre(){
    var validado = true;

    var sEmail  = $("#emailPreInsc").val();
    var emailConfirm  = $("#emailPreInscConf").val();
    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(sEmail))||sEmail.match(illegalChars)){
        $("#msnErroEmailPreIns").show(500);
        validado = false;
    }else{
        $("#msnErroEmailPreIns").hide(500);
    }

    if (emailConfirm != sEmail){
        $("#msnErroEmailPreInsConfirm").show(500);
        validado = false;
    } else {
        $("#msnErroEmailPreInsConfirm").hide(500);
    }

    if (validado){

        $("#mnsAguard").html("<br/><i class='fa fa-spinner fa-spin'></i> Carregando...");

        $.ajax({
         url : 'controller/confirmarCadLanding.php?email='+$("#emailPreInsc").val(),
         type : 'GET',
         /*data: {
            "email": $('#email').val()
         },*/
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].found == 'S'){
                if (data[0].jaCadastrado == 'N'){
                    window.location.href = "criar-conta.php?email="+data[0].emailPreInsc+"&player="+data[0].nomePreInsc;
                } else {
                    $("#emailLogin").val(data[0].emailPreInsc);
                    $("#mnsAguard").html("<br/><small><div>Olá, <strong>"+data[0].nomePreInsc+"</strong>. Você já criou a sua conta NEXT PLAYER. Se ainda não confirmou participação no campeonato, entre na sua conta e confirma sua participação: <br/><button class='btn btn-warning btn-sm' data-bs-dismiss='modal' data-bs-toggle='modal' data-bs-target='#modalEntrar'><strong>ENTRAR</strong></button></div><small>");       
                }
            } else {
                $("#mnsAguard").html("<br/><small><div>Este e-mail não está na lista de pré-inscritos! Mas não se preocupe, você pode se inscrever criando a uma conta: <br/><button class='btn btn-warning btn-sm' onclick='abreModalRegistrarNormal()'><strong>CRIAR CONTA</strong></button></div><small>");
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    }
}

// Valida Nova conta apos verificacao de pre-inscrito
function validarNovaConta(){
    var validado = true;
    var pass1 = $("#passWordRegPreInsc").val();
    var pass2 = $("#passWordRegPreInscConfirm").val();

    if (pass1 == ""){
        $("#msnErroPassWordReg").show(500);
        validado = false;
    } else {
        $("#msnErroPassWordReg").hide(500);
    }

    if (pass1 != pass2){
        $("#msnErroPassWordRegConfirm").show(500);
        validado = false;
    } else {
        $("#msnErroPassWordRegConfirm").hide(500);
    }


    if (validado){
        $("#loadingCriarContaPreInsc").show();
        var formulario = document.getElementById('formNovaConta');
        formulario.submit();
    }
}

// Quando o cara informa o email e nao se pre-inscreveu, mas pode criar uma conta nova
function abreModalRegistrarNormal(){
    $('#modalAtencaoCamp').modal('toggle');
    $('#modalRegistrar').modal('toggle');
    $('#DivRegisterCont').hide();
    $('#divRegister').show();
    $("#btnCriarConta").show();
    $("#emailReg").val($("#emailPreInsc").val());
    $("#emailRegConfirm").val($("#emailPreInscConf").val());

}


// ======================== REGISTRO PLAYER 
// Valida Nova conta FLuxo Padrao
function validarNovaContaPadrao(){
    var validado = true;
    var namePlayer = $("#nameReg").val();
    var emailPlayer = $("#emailReg").val();
    var emailConfPlayer = $("#emailRegConfirm").val();
    var passPlayer = $("#passWordReg").val();
    var passConfPlayer = $("#passWordRegConfirm").val();

    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(emailPlayer))||emailPlayer.match(illegalChars)){
        $("#msnErroEmailRegPadrao").show(500);
        validado = false;
    }else{
        $("#msnErroEmailRegPadrao").hide(500);
    }

    if (emailConfPlayer != emailPlayer){
        $("#msnErroEmailRegConfirmPadrao").show(500);
        validado = false;
    } else {
        $("#msnErroEmailRegConfirmPadrao").hide(500);
    }

    if (namePlayer == ""){
        $("#msnErroNameRegPadrao").show(500);
        validado = false;
    } else {
        $("#msnErroNameRegPadrao").hide(500);
    }

    if (passPlayer == ""){
        $("#msnErroPassWordRegPadrao").show(500);
        validado = false;
    } else {
        $("#msnErroPassWordRegPadrao").hide(500);
    }

    if (passPlayer != passConfPlayer){
        $("#msnErroPassWordRegConfirmPadrao").show(500);
        validado = false;
    } else {
        $("#msnErroPassWordRegConfirmPadrao").hide(500);
    }

    /*if($("#confirTermos").is(":checked")) {
        $("#msnErroConfirmTermos").hide(500);
    } else {
        $("#msnErroConfirmTermos").show(500);
        validado = false;
    }*/


    if (validado){
        $("#loadingCriarContaPadrao").show();
        var formulario = document.getElementById('formNovaContaPadrao');
        formulario.submit();
    }
}

// Quando o cara ja tem cadastro e acaba tentando se cadastrar novamente
// Ensinar ao usuario a diferenca entre REGISTRO e LOGIN
function chamaModalLoginJaCadastrado(email){
    $('#modalEntrar').modal('toggle');
    $("#emailLogin").val(email);
}


function chamaModalCriarConta(){
    $('#modalEntrar').modal('toggle');
    $("#modalRegistrar").modal('toggle');
}


// ====================== LOGIN
function verificaLogin() {
    var validado = true;
    var emailPlayer = $("#emailLogin").val();
    var passPlayer = $("#passWordLogin").val();

    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(emailPlayer))){
        $("#msnErroEmailLogin").show(500);
        validado = false;
    }else{
        $("#msnErroEmailLogin").hide(500);
    }

    if (passPlayer == ""){
        $("#msnErroPassWordLogin").show(500);
        validado = false;
    } else {
        $("#msnErroPassWordLogin").hide(500);
    }

    if (validado){
        $("#loadingLogin").show();
        var formulario = document.getElementById('formLogin');
        formulario.submit();
    }
}


function criaContaAposFalhaLogin(email){
    $('#modalAtencaoCamp').modal('toggle');
    $('#modalRegistrar').modal('toggle');
    $('#DivRegisterCont').hide();
    $('#divRegister').show();
    $("#btnCriarConta").show();
    $("#emailReg").val(email);
    $("#emailRegConfirm").val(email);
}


function loginAposFalhaLogin(email){
    $('#modalEntrar').modal('toggle');
    $("#emailLogin").val(email);
}


//  Recuperar Senha
function recuperarAcesso(){

    $("#loadingRecuperarAcesso").show();
    
    var validado = true;

    var sEmail  = $("#emailRecuperar").val();
    var emailConfirm  = $("#emailRecuperarConfirm").val();
    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(sEmail))||sEmail.match(illegalChars)){
        $("#msnErroEmailRec").show(500);
        validado = false;
    }else{
        $("#msnErroEmailRec").hide(500);
    }

    if (emailConfirm != sEmail){
        $("#msnErroEmailRecConfirm").show(500);
        validado = false;
    } else {
        $("#msnErroEmailRecConfirm").hide(500);
    }

    if (validado){ // Busca e-mail no sistema
        $.ajax({
         url : 'controller/buscar-email-cadastrado.php?email='+sEmail,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].found == 'S'){
               
                $("#msnRetorno").show();
                $("#btnRecAcesso").hide();
                $("#msnRetorno").html("<div class='alert alert-info'>Enviamos um e-mail para <strong>"+data[0].playerEmail+"</strong> contendo o link para criação de sua nova senha. Caso o e-mail não tenha chegado, é provável que ele tenha sido destinado à <strong>caixa de SPAM</strong> ou na aba de <strong>Promoções (para quem usa Gmail)</strong>. Para que isso não ocorre novamente, <strong>marque nossos e-mails como NÃO SPAM</strong>    </div>");
                $("#loadingRecuperarAcesso").hide();
                envialEmailViaAjax(data[0].playerEmail);
                
            } else {
                $("#loadingRecuperarAcesso").hide();
                $('#DivRegisterCont').hide();
                $('#divRegister').show();
                $("#btnCriarConta").show();
                $("#emailReg").val(sEmail);
                $("#emailRegConfirm").val(sEmail);
                $("#msnRetorno").show();
                $("#msnRetorno").html("<div class='alert alert-warning'><big><i class='fa fa-exclamation-triangle fa-lg'></i> <strong>E-mail não encontrado!</strong></big> <hr/><strong class='text-danger'>IMPORTANTE</strong>:<br/> O e-mail <strong>"+sEmail+"</strong> não foi encontrado em nossa base de jogadores cadastrados. Neste caso, você precisa criar uma conta NEXT PLAYER. Para criar uma conta, <a href='#' data-bs-toggle='modal' data-bs-target='#modalRegistrar'>clique aqui</a></div>");
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    } else {
        $("#loadingRecuperarAcesso").hide();
    }
}

// Dispara e-mail com link para recuparar acesso
function envialEmailViaAjax(email){
    $.ajax({
         url : 'controller/email-recuparar-acesso.php?email='+email,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].enviado == 'S'){
                
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
}


//  Recuperar Senha - NOVA SENHA
function recuperarAcessoNovaSenha(hash){

    $("#loadingRecuperarNewPassWord").show();
    
    var validado = true;

    var newPass = $("#newPassWord").val();
    var newPassConfirm = $("#newPassWordConfirm").val();
    
    if (newPass == ""){
        $("#msnErroNewPassWord").show(500);
        validado = false;
        $("#loadingRecuperarNewPassWord").hide();
    } else {
        $("#msnErroNewPassWord").hide(500);
    }


    if (newPass != newPassConfirm){
        $("#msnErroNewPassWordConfirm").show(500);
        validado = false;
        $("#loadingRecuperarNewPassWord").hide();
    } else {
        $("#msnErroNewPassWordConfirm").hide(500);
    }


    if (validado){
        $.ajax({
         url : 'controller/alterar-senha.php?hash='+hash+'&newPass='+newPass,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].success == 'S'){
                $("#msnRetornoNewPass").show();
                $("#btnRecAcessoNewPass").hide();
                $("#msnRetornoNewPass").html("<div class='alert alert-info'><strong>Sucesso!</strong>  Agora, efetue login no botão abaixo: <br/><br/><button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalEntrar'>ENTRAR</button>   </div>");
                $("#loadingRecuperarNewPassWord").hide();       
            } else {
                $("#loadingRecuperarNewPassWord").hide();
                $("#msnRetornoNewPass").show();
                $("#msnRetornoNewPass").html("<div class='alert alert-warning'><big><i class='fa fa-exclamation-triangle fa-lg'></i> <strong>Erro! Tente novamente...</strong></big> </div>");
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    } else {
        $("#loadingRecuperarAcesso").hide();
    }
}


// ================ CAMPEONATOS

function confirmarCamp(camp, player, soloOrTeam){

    $("#loadingPartCamp").show();

    var squad;

    if (soloOrTeam == 'T'){
        squad = $("#meuSquad").val();
    } else {
        squad = 0;
    }

        $.ajax({
         url : 'controller/confirmarPartCamp.php?camp='+camp+'&player='+player+'&squad='+squad,
         type : 'GET',
         /*data: {
            "email": $('#email').val()
         },*/
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].success == 'S'){
               
                $("#botaoConfirmCamp").hide();
                $("#btnFecharConf").show(500);
                $("#loadingPartCamp").hide(500);

                if(data[0].free == 'N'){ // Se for camp COM TAXA
                    $("#bodyCamp").html("<div class='alert alert-info'><big><i class='fa fa-exclamation-triangle fa-lg'></i> <strong>EFETUAR PAGAMENTO</strong></big> <hr/><a class='btn btn-danger' href='campeonatos-enviar-comp-pgto.php?camp="+camp+"'><strong>PAGAR E ENVIAR COMPROVANTE</strong></a><hr/> <strong class='text-danger'>AVISO 1:</strong>:<br/> Agora, para concluir requisição, <strong>EFETUE O PAGAMENTO</strong> da taxa de <strong>"+data[0].taxa+"</strong> e <strong>ENVIE O COMPROVANTE</strong> para o organizador, clicando no botão vermelho acima. <br/><br/><strong class='text-danger'>AVISO 2:</strong>:<br/> O link da sala para o campeonato ficará disponível nesta página, 15 min antes das partidas. <br/><br/>Ah, você tbm acabou de ganhar $NP 100,00 por solicitar sua participação :)</div> ");
                    $("#btnAmareloConf").hide();
                    $("#anchorVermelhoUploadCompPgto").show();
                }
                if(data[0].free == 'S'){ // Se for camp GRATUITO
                    $("#bodyCamp").html("<div class='alert alert-info'><big><i class='fa fa-thumbs-up fa-lg'></i> <strong>Participação Confirmada com Sucesso!</strong></big> <hr/><strong class='text-danger'>IMPORTANTE</strong>:<br/> O link da sala para o campeonato ficará disponível nesta página, 15 min antes das partidas. <br/><br/>Ah, você tbm acabou de ganhar $NP 100,00 por confirmar sua participação :)</div> ");
                    $("#btnAmareloConf").hide();
                    $("#btnAzulConfirmado").show();
                }    
                
            } else {
                $("#loadingPartCamp").hide(500);
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });

}


// Criar TIME
function validarCriarTime() {

    $("#loadingCriarNovoTime").show();

    var validado = true;
    var game = $("#gameId").val();
    var team = $("#teamName").val();
    var tag = $("#teamTag").val();

    if (game == ""){
        $("#msnErroGame").show(500);
        validado = false;
    } else {
        $("#msnErroGame").hide(500);
    }

    if (team == ""){
        $("#msnErroTeamName").show(500);
        validado = false;
    } else {
        $("#msnErroTeamName").hide(500);
    }

    if (tag == ""){
        $("#msnErroTeamTag").show(500);
        validado = false;
    } else {
        $("#msnErroTeamTag").hide(500);
    }


    if ($("#logotipoTime").val() == ""){
        
    } else {
        var oFile = document.getElementById("logotipoTime").files[0];
        if (oFile.size > 5097152) { // 2 mb for bytes.
            $("#msnErroFileSize").show(500);
            validado = false;
        } else {
            $("#msnErroFileSize").hide(500);
        }
    }
    

    if (validado){
        $("#btnCriarLineTime").hide();
        var formulario = document.getElementById('formNovoTime');
        formulario.submit();
    } else {
        $("#loadingCriarNovoTime").hide();
    }
}


// Editar TIME
function validarEditarTime(time) {

    $("#loadingEditarNovoTime").show();

    var validado = true;
    var game = $("#gameId").val();
    var team = $("#teamName").val();
    var tag = $("#teamTag").val();

    if (game == ""){
        $("#msnErroGame").show(500);
        validado = false;
    } else {
        $("#msnErroGame").hide(500);
    }

    if (team == ""){
        $("#msnErroTeamName").show(500);
        validado = false;
    } else {
        $("#msnErroTeamName").hide(500);
    }

    if (tag == ""){
        $("#msnErroTeamTag").show(500);
        validado = false;
    } else {
        $("#msnErroTeamTag").hide(500);
    }


    if ($("#logotipoTime").val() == ""){
        
    } else {
        var oFile = document.getElementById("logotipoTime").files[0];
        if (oFile.size > 5097152) { // 2 mb for bytes.
            $("#msnErroFileSize").show(500);
            validado = false;
        } else {
            $("#msnErroFileSize").hide(500);
        }
    }
    

    if (validado){
        $("#btnCriarLineTime").hide();
        var formulario = document.getElementById('formEditarTime');
        formulario.submit();
    } else {
        $("#loadingEditarNovoTime").hide();
    }
}


// Buscar Membro
function buscarMembro(gameId){

    $("#loadingBusca").show();

    var teamId = $("#temaIdHidden").val();

    $.ajax({
     url : 'controller/buscar-player.php?gameId='+gameId+'&teamId='+teamId+'&playerOrEmail='+$("#membroBuscado").val(),
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);

        $("#membrosAppend").html("");
            
        if (data[0] == null){
            $("#membrosAppend").html("<div class='alert alert-danger'><strong>Opa, não encontramos nenhum player com este nome ou e-mail.</strong><br/><br/> O membro precisa estar cadastrado na plataforma NEXT PLAYER. Caso ele ainda não esteja, peça para ele se cadastrar para que depois, você possa recrutá-lo para seu time.</div>")
            $("#loadingBusca").hide(500);
        } else {
            for (var i=0; i < data.length; i++) {
                if (data[i].hasTeam == 'N'){
                    $("#membrosAppend").append("<div class='alert alert-info' align='center'><h5>"+data[i].playerName+"</h5><button class='btn btn-primary btn-sm' onclick='recrutarPlayer("+teamId+", "+data[i].playerId+")'><i class='fa fa-plus-circle'></i> RECRUTAR</button></div>");
                    $("#loadingBusca").hide(500);
                }

                if (data[i].hasTeam == 'S'){ // Se o cara ja estiver nesse time
                    $("#membrosAppend").append("<div class='alert alert-success' align='center'><h5>"+data[i].playerName+"</h5><button class='btn btn-success btn-sm' disabled='disabled'><i class='fa fa-check-circle'></i> JÁ RECRUTADO para este ou outro time do mesmo jogo</button></div>");
                    $("#loadingBusca").hide(500);
                }
            }
        }
        
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}


// Recruta Membro
function recrutarPlayer(teamId, playerId){

    $("#loadingBusca").show();
    $("#membrosAppend").html("");

    $.ajax({
     url : 'controller/recrutar-membro.php?teamId='+teamId+'&playerId='+playerId,
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].success == 'S'){
           
            $("#membrosAppend").html("<div class='alert alert-info' align='center'><i class='fa fa-thumbs-up'></i> Membro Recrutado Com sucesso!</div>");
            $("#loadingBusca").hide(500);       
            
        } else {
            $("#loadingBusca").hide(500);
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}

// PRE Remover Membro
function preRemoveMembro(teamId, playerId){
    $("#removidoSucesso").hide();
    $('#modalRemovarMembro').modal('toggle');
    $("#btnRemoverMembro").removeAttr("onclick");
    $("#btnRemoverMembro").attr("onclick", "removerMembro("+teamId+", "+playerId+")");
}

// Remover Membro
function removerMembro(teamId, playerId){

    $("#loadingRemoverMembro").show();

    $.ajax({
     url : 'controller/remover-membro.php?teamId='+teamId+'&playerId='+playerId,
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].success == 'S'){
           
            $("#membro-"+playerId).removeAttr("class");
            $("#membro-"+playerId).removeAttr("onclick");
            $("#membro-"+playerId).attr("class", "btn btn-sm btn-primary");
            $("#membro-"+playerId).attr("disabled", "disabled");
            $("#membro-"+playerId).html("<small>Removido</small>");
            $("#removidoSucesso").show(500);
            $("#loadingRemoverMembro").hide(500);   
            
        } else {
            $("#removidoSucesso").hide();
            $("#loadingRemoverMembro").hide(500);
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}


// Sair de time
function sairTime(teamId, playerId){

    $("#loadingSairTime").show();

    $.ajax({
     url : 'controller/sair-time.php?teamId='+teamId+'&playerId='+playerId,
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].success == 'S'){
           
            $("#btnSairTime").hide(500);
            $("#btnSairTime").html("Fechar");
            $("#bodySairTime").html("<div class='alert alert-info'><big>Você saiu com sucesso deste time!</big></div>");
            $("#loadingSairTime").hide(500);       
            
        } else {
            $("#loadingSairTime").hide(500);
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}


// Editar MEU PERFIL
function validarEditarPerfil() {

    $("#loadingEditarPerfil").show();

    var validado = true;
    var name = $("#perfilName").val();
    var birthDay = $("#perfilBirth").val();
    var gander = $("#perfilGander").val();
    var state = $("#perfilState").val();
    var phone = $("#perfilPhone").val();

    if (name == ""){
        $("#msnErroPerfilName").show(500);
        validado = false;
    } else {
        $("#msnErroPerfilName").hide(500);
    }

    if (birthDay == ""){
        $("#msnErroPerfilBirth").show(500);
        validado = false;
    } else {
        $("#msnErroPerfilBirth").hide(500);
    }

    if (gander == ""){
        $("#msnErroPerfilGander").show(500);
        validado = false;
    } else {
        $("#msnErroPerfilGander").hide(500);
    }

    if (state == ""){
        $("#msnErroPerfilGander").show(500);
        validado = false;
    } else {
        $("#msnErroPerfilGander").hide(500);
    }

    if (phone == ""){
        $("#msnErroPerfilPhone").show(500);
        validado = false;
    } else {
        $("#msnErroPerfilPhone").hide(500);
    }
    
    if (validado){
        $("#btnEditarPerfil").hide();
        var formulario = document.getElementById('formEditarPerfil');
        formulario.submit();
    } else {
        $("#loadingEditarPerfil").hide();
    }
}



// Editar MEU PERFIL - DADOS IN GAMES
function atualizarInfo() {

    $("#loadingAtualizarDadosInGame").show();

    var validado = true;
    var nickInGame = $("#nickInGame").val();
    var idInGame = $("#idInGame").val();
    var levelInGame = $("#levelInGame").val();

    if (nickInGame == ""){
        $("#msnErroNickInGame").show(500);
        validado = false;
    } else {
        $("#msnErroNickInGame").hide(500);
    }

    if (idInGame == ""){
        $("#msnErroIdInGame").show(500);
        validado = false;
    } else {
        $("#msnErroIdInGame").hide(500);
    }

    if (levelInGame == ""){
        $("#msnErroLevelInGame").show(500);
        validado = false;
    } else {
        $("#msnErroLevelInGame").hide(500);
    }
    
    if (validado){
        var formulario = document.getElementById('formDadosInGame');
        formulario.submit();
    } else {
        $("#loadingAtualizarDadosInGame").hide();
    }
}


// ========================= ORGANIZACAO

// Editar Organização
function validarEditarOrg(org) {

    $("#loadingEditarOrg").show();

    var validado = true;
    var orgName = $("#orgName").val();
    var orgInstagram = $("#orgInstagram").val();
    var orgBroadCast = $("#orgBroadCast").val();
    var orgDesc = $("#orgDesc").val();

    if (orgName == ""){
        $("#msnErroOrgName").show(500);
        validado = false;
    } else {
        $("#msnErroOrgName").hide(500);
    }

    if (orgInstagram == ""){
        $("#msnErroOrgInstagram").show(500);
        validado = false;
    } else {
        $("#msnErroOrgInstagram").hide(500);
    }

    if (orgBroadCast == ""){
        $("#msnErroOrgBroadCast").show(500);
        validado = false;
    } else {
        $("#msnErroOrgBroadCast").hide(500);
    }

    if (orgDesc == ""){
        $("#msnErroOrgDesc").show(500);
        validado = false;
    } else {
        $("#msnErroOrgDesc").hide(500);
    }


    if ($("#logotipoOrg").val() == ""){
        
    } else {
        var oFile = document.getElementById("logotipoOrg").files[0];
        if (oFile.size > 5097152) { // 5 mb for bytes.
            $("#msnErroFileSize").show(500);
            validado = false;
        } else {
            $("#msnErroFileSize").hide(500);
        }
    }
    

    if (validado){
        $("#btnEditarOrg").hide();
        var formulario = document.getElementById('formEditarOrg');
        formulario.submit();
    } else {
        $("#loadingEditarOrg").hide();
    }
}


// =================== CAMPEONATOS


// Enviar Comprovante PGTO inscricao
function validarEnvioCompPgto(camp) {

    $("#loadingEnvioCompPgto").show();

    var validado = true;
    var campId = $("#campId").val();
    var arquivoCompPgto = $("#arquivoCompPgto").val();

    if (campId == ""){
        $("#msnErroOrgDesc").show(500);
        validado = false;
    }

    if (arquivoCompPgto == ""){
        $("#msnErroFileSize").show(500);
        validado = false;
    } else {
        var oFile = document.getElementById("arquivoCompPgto").files[0];
        if (oFile.size > 5097152) { // 5 mb for bytes.
            $("#msnErroFileSize").show(500);
            validado = false;
        } else {
            $("#msnErroFileSize").hide(500);
        }
    }
    
    if (validado){
        $("#btnEnvioCompPgto").hide();
        var formulario = document.getElementById('formEnvioCompPgto');
        formulario.submit();
    } else {
        $("#loadingEnvioCompPgto").hide();
    }
}


// Organizador CONFIRMAR PGTO - SOLO
function confirmarCompPgtoSolo(camp, player){

    $("#loadingConfirCompEnvioSolo-"+player).show();

    $.ajax({
     url : 'controller/confirmar-pgto-solo.php?playerId='+player+'&campId='+camp,
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].success == 'S'){
           
            $("#btnConfPgtoSolo-"+player).hide(500);
            $("#bodyModalSolo-"+player).html("<div class='alert alert-info'><strong><i class='fa fa-check-circle fa-lg'></i></strong> Pagamento Confirmado com Sucesso!</div>");
            $("#loadingConfirCompEnvioSolo-"+player).hide(500);       
            
        } else {
            $("#loadingConfirCompEnvioSolo-"+player).hide(500);
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}


// Organizador CONFIRMAR PGTO - TEAM
function confirmarCompPgtoTime(camp, team){

    $("#loadingConfirCompEnvioTime-"+team).show();

    $.ajax({
     url : 'controller/confirmar-pgto-time.php?teamId='+team+'&campId='+camp,
     type : 'GET',
     /*data: {
        "email": $('#email').val()
     },*/
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].success == 'S'){
           
            $("#btnConfPgtoTime-"+team).hide(500);
            $("#bodyModalTime-"+team).html("<div class='alert alert-info'><strong><i class='fa fa-check-circle fa-lg'></i></strong> Pagamento Confirmado com Sucesso!</div>");
            $("#loadingConfirCompEnvioTime-"+team).hide(500);       
            
        } else {
            $("#loadingConfirCompEnvioTime-"+team).hide(500);
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}


// SORTEAR GRUPOS

function validaSorteio(camp, soloOrTeam){

    var qntdGrupos = $("#qntdGrupos").val();
    var validado = true;

    if (qntdGrupos == ""){
        $("#msnErroQntdGrupos").show(500);
        validado = false;
    } else {
        $("#msnErroQntdGrupos").hide(500);
    } 


    if (validado){

        $("#loadingSorteio").show();

        $.ajax({
         url : 'controller/sortear-grupos.php?soloOrTeam='+soloOrTeam+'&qntdGrupos='+qntdGrupos+'&campId='+camp,
         type : 'GET',
         /*data: {
            "email": $('#email').val()
         },*/
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].success == 'S'){
               
                $("#btnSortearGrupo").hide(500);
                $("#bodyModalSorteio").html("<div class='alert alert-info'><strong><i class='fa fa-check-circle fa-lg'></i></strong> Sorteio realizado! <br/><br/><a class='btn btn-primary btn-sm' href='campeonatos-dash.php?camp="+camp+"'>Atualizar a página</a></div>");
                $("#loadingSorteio").hide(500);       
                
            } else {
                $("#loadingSorteio").hide(500);
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });

    }

}


// ABRIR SALA

function abrirSala(){

    var validado = true;
    var camp = $("#campIdHidden").val();
    var linkSala = $("#linkSala").val();
    var grupoLiberado = $("#grupoLiberado").val();

    if (linkSala == ""){
        $("#msnErroLinkSala").show(500);
        validado = false;
    } else {
        $("#msnErroLinkSala").hide(500);
    }


    if (grupoLiberado == ""){
        $("#msnErroGrupoLiberado").show(500);
        validado = false;
    } else {
        $("#msnErroGrupoLiberado").hide(500);
    } 


    if (validado){

        $("#loadingAbrirSala").show();
        var formulario = document.getElementById('formAbrirSala');
        formulario.submit();

    }

}


// =========== PONTUACAO 


// FASE GRUPOS
function chamaModalPontuacaoGrupos(ativo, camp){
    $('#msnSuccessPoints').hide();
    $('#valorKills').val('');
    $('#valorKills').hide();
    $('#textoFase').html("FASE DE GRUPOS");
    $('#valorPontuacao').val('');
    $('#modalPontuacaoCamp').modal('toggle');
    $('#btnPontuar').removeAttr("onclick");
    $('#btnPontuar').attr("onclick", "pontuarFaseGrupos("+ativo+", "+camp+")");
}


function pontuarFaseGrupos(ativo, camp){

    var soloOrTeam = $("#solorOrTeam").val();
    var pontuacao = $("#valorPontuacao").val();
    var validado = true;

    if (pontuacao == "" || pontuacao == 0){
        $("#msnErroPontos").show(500);
        validado = false;
    } else {
        $("#msnErroPontos").hide(500);
    } 


    if (validado){

        $("#loadingPontuacao").show();

        if (soloOrTeam == 'T'){

            $.ajax({
             url : 'controller/pontuarTime.php?points='+pontuacao+'&camp='+camp+'&ativo='+ativo,
             type : 'GET',
             /*data: {
                "email": $('#email').val()
             },*/
             dataType: 'json',
             success: function(data){
                console.log(data);
                if (data[0].success == 'S'){
                   
                    $('#msnSuccessPoints').show(500);
                    $("#loadingPontuacao").hide(500);       
                    
                } else {
                    $("#loadingPontuacao").hide(500);
                }
             },
             error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
             }
            });

        }


        if (soloOrTeam == 'S'){

            $.ajax({
             url : 'controller/pontuarSolo.php?points='+pontuacao+'&camp='+camp+'&ativo='+ativo,
             type : 'GET',
             /*data: {
                "email": $('#email').val()
             },*/
             dataType: 'json',
             success: function(data){
                console.log(data);
                if (data[0].success == 'S'){
                   
                    $('#msnSuccessPoints').show(500);
                    $("#loadingPontuacao").hide(500);       
                    
                } else {
                    $("#loadingPontuacao").hide(500);
                }
             },
             error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
             }
            });

        }

    }

}


// FASE FINAL
function chamaModalPontuacaoFinal(ativo, camp){
    $('#msnSuccessPoints').hide();
    $('#valorKills').val('');
    $('#valorKills').show();
    $('#textoFase').html("FASE FINAL");
    $('#valorPontuacao').val('');
    $('#modalPontuacaoCamp').modal('toggle');
    $('#btnPontuar').removeAttr("onclick");
    $('#btnPontuar').attr("onclick", "pontuarFaseFinal("+ativo+", "+camp+")");
}


function pontuarFaseFinal(ativo, camp){

    var soloOrTeam = $("#solorOrTeam").val();
    var pontuacao = $("#valorPontuacao").val();
    var kills = $("#valorKills").val();
    var validado = true;

    if (pontuacao == "" || pontuacao == 0){
        $("#msnErroPontos").show(500);
        validado = false;
    } else {
        $("#msnErroPontos").hide(500);
    }

    if (kills == ""){
        $("#msnErroKills").show(500);
        validado = false;
    } else {
        $("#msnErroKills").hide(500);
    } 


    if (validado){

        $("#loadingPontuacao").show();

        if (soloOrTeam == 'T'){

            $.ajax({
             url : 'controller/pontuarTimeFinal.php?points='+pontuacao+'&kills='+kills+'&camp='+camp+'&ativo='+ativo,
             type : 'GET',
             /*data: {
                "email": $('#email').val()
             },*/
             dataType: 'json',
             success: function(data){
                console.log(data);
                if (data[0].success == 'S'){
                   
                    $('#msnSuccessPoints').show(500);
                    $("#loadingPontuacao").hide(500);       
                    
                } else {
                    $("#loadingPontuacao").hide(500);
                }
             },
             error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
             }
            });

        }


        if (soloOrTeam == 'S'){

            $.ajax({
             url : 'controller/pontuarSoloFinal.php?points='+pontuacao+'&kills='+kills+'&camp='+camp+'&ativo='+ativo,
             type : 'GET',
             /*data: {
                "email": $('#email').val()
             },*/
             dataType: 'json',
             success: function(data){
                console.log(data);
                if (data[0].success == 'S'){
                   
                    $('#msnSuccessPoints').show(500);
                    $("#loadingPontuacao").hide(500);       
                    
                } else {
                    $("#loadingPontuacao").hide(500);
                }
             },
             error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
             }
            });

        }

    }

}


// TRADUCAO DO SITE
function translateSite(lang){

}