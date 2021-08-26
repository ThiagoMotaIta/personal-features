$(function () {
    $('#btnYes').click(function () {
        $('#form-protocolo').submit();
    });

    //Esconde campos caso não seja PJ
    $('input[type=radio][name=licenca]').change(function () {
        if (this.value == 'pj') {
            $('.pj').show();
            $(".requerent").hide();
            $(".proprietario").show();
            $(".pf").hide();
            $('.requerente').prop('checked', false);
        } else if (this.value == 'pf') {
            $('.pj').hide();
            $(".requerent").show();
            $("#razao_social").val("");
            $("#cnpj").val("");
            //console.log($('input[type=radio][name=requerente]:checked').val());
        }
    });

    $('input[type=radio][name=requerente]').change(function () {
        if (this.value == '1') {
            $('.proprietario').hide();
            $("#empreendimento").val("");
            $("#cpf").val("");
        } else if (this.value == '0') {
            $('.proprietario').show();
        }
    });

    $("input[name='licenca']:checked").change();
    $("input[name='requerente']:checked").change();
});
