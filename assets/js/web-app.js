// ====================== LOGIN
function verificaLogin() {
    var validado = true;
    var login = $("#login").val();
    var pass = $("#passWord").val();

    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
    
    if(!(emailFilter.test(login))){
        validado = false;
        //Notifications
        $.notify({
            icon: "nc-icon nc-chat-round",
            message: "<strong>E-mail</strong> invÃ¡lido"

        }, {
            type: type[4],
            timer: 8000,
        });
    }

    if (pass == ""){
        validado = false;
        //Notifications
        $.notify({
            icon: "nc-icon nc-chat-round",
            message: "<strong>Senha</strong> invÃ¡lida"

        }, {
            type: type[4],
            timer: 8000,
        });
    }

    if (validado){
        
        $("#mnsAguard").html("<br/><i class='fa fa-spinner fa-spin'></i> Carregando...");

        $.ajax({
         url : 'controller/login.php?login='+login+'&passWord='+pass,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].success == 'S'){
                window.location.href = "home.php";
            } else {
                $.notify({
                    icon: "nc-icon nc-chat-round",
                    message: "<strong>Erro</strong>: UsuÃ¡rio nÃ£o encontrado no sistema"

                }, {
                    type: type[4],
                    timer: 8000,
                });
                $("#mnsAguard").html("");
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });

    }
}


// Aprovar ou Reprovar individual
function aprovarReprovarItem(idSol, tipoBenef, aprovaReprova){

    $("#loading-"+idSol).show();

    // AUX EMERGENCIAL
    if (tipoBenef == 'aux' && aprovaReprova == 'A'){
        $("#btnAuxApr-"+idSol).removeAttr("class");
        $("#btnAuxApr-"+idSol).attr("class", "btn btn-primary");
        $("#btnAuxRep-"+idSol).removeAttr("class");
        $("#btnAuxRep-"+idSol).attr("class", "btn btn-secondary");
    }

    if (tipoBenef == 'aux' && aprovaReprova == 'R'){
        $("#btnAuxRep-"+idSol).removeAttr("class");
        $("#btnAuxRep-"+idSol).attr("class", "btn btn-danger");
        $("#btnAuxApr-"+idSol).removeAttr("class");
        $("#btnAuxApr-"+idSol).attr("class", "btn btn-secondary");
    }

    // AUX ALIMENTACAO
    if (tipoBenef == 'alim' && aprovaReprova == 'A'){
        $("#btnAlimApr-"+idSol).removeAttr("class");
        $("#btnAlimApr-"+idSol).attr("class", "btn btn-primary");
        $("#btnAlimRep-"+idSol).removeAttr("class");
        $("#btnAlimRep-"+idSol).attr("class", "btn btn-secondary");
    }

    if (tipoBenef == 'alim' && aprovaReprova == 'R'){
        $("#btnAlimRep-"+idSol).removeAttr("class");
        $("#btnAlimRep-"+idSol).attr("class", "btn btn-danger");
        $("#btnAlimApr-"+idSol).removeAttr("class");
        $("#btnAlimApr-"+idSol).attr("class", "btn btn-secondary");
    }

    // AUX TABLET
    if (tipoBenef == 'tablet' && aprovaReprova == 'A'){
        $("#btnTablApr-"+idSol).removeAttr("class");
        $("#btnTablApr-"+idSol).attr("class", "btn btn-primary");
        $("#btnTablRep-"+idSol).removeAttr("class");
        $("#btnTablRep-"+idSol).attr("class", "btn btn-secondary");
    }

    if (tipoBenef == 'tablet' && aprovaReprova == 'R'){
        $("#btnTablRep-"+idSol).removeAttr("class");
        $("#btnTablRep-"+idSol).attr("class", "btn btn-danger");
        $("#btnTablApr-"+idSol).removeAttr("class");
        $("#btnTablApr-"+idSol).attr("class", "btn btn-secondary");
    }

    $.ajax({
     url : 'controller/aprova-reprova-item.php?idSol='+idSol+'&tipoBenef='+tipoBenef+'&aprovaReprova='+aprovaReprova,
     type : 'GET',
     dataType: 'json',
     success: function(data){
        console.log(data);
        if (data[0].sucesso == 'S'){
            $("#loading-"+idSol).hide();
        } else {
            $("#loading-"+idSol).hide();
        }
     },
     error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
     }
    });

}

// Busca solicitacao
$('#searchSol').on('blur', function(event) {

    $("#loadingSearch").show();
    var param = $("#searchSol").val();

    if (param == "" || param == null){
        $.notify({
            icon: "nc-icon nc-chat-round",
            message: "Informe um valor para busca"
        }, {
            type: type[4],
            timer: 8000,
        });
    } else {
        $.ajax({
         url : 'controller/search-sol.php?param='+param,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].sucesso == 'S'){
                $("#loadingSearch").hide();
                $("#listaSol").hide();
                $("#listaSolBusca").show(500);
                $("#bodyBuscaSol").append("<td><small>"+data[0].matricula+"</small></td>"+
                                          "<td><small>"+data[0].aluno+"</small></td>"+
                                          "<td><small>"+data[0].nascimento+"</small></td>"+
                                          "<td><small>"+data[0].cpf+"</small></td>"+
                                          "<td><small>"+data[0].situacaoBen+"</small></td>"+
                                          "<td><small>"+data[0].situacaoAli+"</small></td>"+
                                          "<td><small>"+data[0].situacaoTab+"</small></td>"+
                                          "<td><small><button class='btn btn-sm btn-secondary' onclick='chamaModalInfo("+data[0].idSol+")'><i class='fa fa-list'></i></button></small></td>"+
                                          "<td><small><button class='btn btn-sm btn-primary' onclick='chamaModalAprov("+data[0].idSol+")'><i class='fa fa-check-circle'></i></button></small></td>");
                $("#revert").html("<button class='btn btn-sm btn-primary' onclick='revertTable()'><i class='fa fa-refresh'></i></button>");
            } else {
                $("#loadingSearch").hide();
                $.notify({
                    icon: "nc-icon nc-chat-round",
                    message: "Nenhuma matrÃ­cula Encontrada"
                }, {
                    type: type[4],
                    timer: 8000,
                });
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });
    }

});

function confirmarAproRepr(sol){
    $('#modalAprov-'+sol).modal('toggle');
    window.location.href = "solicitacoes.php";
}


function revertTable(){
    $("#revert").hide();
    $("#listaSolBusca").hide();
    $("#listaSol").show(500);
}