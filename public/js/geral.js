function modalAddNew(){
    $("#msnSystem").hide();
    $('#addNew').modal('show');
}


function getAllNews(){
    $("#listNews").html("<div class='col-md-4'><h4><i class='fa fa-spin fa-spinner fa-lg'></i></h4><p></p>");

    $.ajax({
    url : 'news',
    type : 'GET',

    dataType: 'json',
    success: function(data){
        console.log(data);

        if (data[0] == null){
            $("#listNews").html("<div class='col-md-12'><h4>Nenhuma notícia cadastrada!</h4></div>");
        } else {

            $("#listNews").html("");

            for (var i=0; i < data.length; i++) {

                $("#listNews").append("<div class='col-md-3 item-new'><h2>"+data[i].title+"</h2>"+
                                      "<p align='justify'>"+data[i].resume+"</p>"+
                                      "<p align='center' id='seeMoreBtn-"+data[i].id+"'><button class='btn btn-secondary' onclick='seeMore("+data[i].id+")'>Veja Mais</button></p>"+
                                      "<p id='new-more-"+data[i].id+"' align='justify' style='display: none;'>"+data[i].description+" <hr/> Escrita por: <strong>"+data[i].author+"</strong> <br/> <small>"+data[i].published+"</small></p>"+
                                      "<button class='btn btn-danger btn-sm' onclick='deleteNew("+data[i].id+")'><i class='fa fa-trash'></i></button>"+
                                      " <button class='btn btn-dark btn-sm' onclick='editNew("+data[i].id+")'><i class='fa fa-edit'></i></button>"+
                                      "</div>");
            }

        }

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });

}


$("#search-news").keyup(function(event) {
    if (event.keyCode === 13) {
        getAllNewsBySearch($("#search-news").val());
    }
});

function getAllNewsBySearch(param){

    if (param != ""){

        $("#listNews").html("<div class='col-md-4'><h4><i class='fa fa-spin fa-spinner fa-lg'></i></h4><p></p>");

        $.ajax({
        url : 'news-search',
        type : 'POST',
        data: {
                "param":$('#search-news').val(),
                "_token": $('#csrf-token')[0].content,
            },

        dataType: 'json',
        success: function(data){
            console.log(data);

            if (data[0] == null){
                $("#listNews").html("<div class='col-md-12'><h4>Nenhuma notícia encontrada com o parâmetro de busca '"+param+"'!</h4></div>");
            } else {

                $("#listNews").html("");

                for (var i=0; i < data.length; i++) {

                    $("#listNews").append("<div class='col-md-4 item-new'><h2>"+data[i].title+"</h2>"+
                                          "<p align='justify'>"+data[i].resume+"</p>"+
                                          "<p align='center' id='seeMoreBtn-"+data[i].id+"'><button class='btn btn-secondary' onclick='seeMore("+data[i].id+")'>Veja Mais</button></p>"+
                                          "<p id='new-more-"+data[i].id+"' align='justify' style='display: none;'>"+data[i].description+" <hr/> Escrita por: <strong>"+data[i].author+"</strong> <br/> <small>"+data[i].published+"</small></p>"+
                                          "<button class='btn btn-danger btn-sm' onclick='deleteNew("+data[i].id+")'><i class='fa fa-trash'></i></button>"+
                                          " <button class='btn btn-dark btn-sm' onclick='editNew("+data[i].id+")'><i class='fa fa-edit'></i></button>"+
                                          "</div>");
                }

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
        });

    }

}


function seeMore(id){
    $("#new-more-"+id).show(500);
    $("#seeMoreBtn-"+id).hide(500);
}


// Add news
function addNew(){

    var validado = true;

    if ($('#title').val() == "" || $('#resume').val() == "" || $('#description').val() == "" || $('#category').val() == ""){
        validado = false;
        $("#msnSystem").html("Campo(s) obrigatório(s) ausente(s)! Tente novamente.");
        $("#msnSystem").removeAttr("class");
        $("#msnSystem").attr("class", "alert alert-danger");
        $("#msnSystem").show(500);
        $('#addNew').modal('hide');
    } else {
        $("#msnSystem").html("");
        $("#msnSystem").removeAttr("class");
        $("#msnSystem").hide(500);
    }

    if(validado){

        var published;
        if ($('#publish').is(':checked')) {
          published = "P";
        } else {
          published = "N";
        }

        $.ajax({
        url : 'add-new',
        type : 'POST',
        data: {
            "title":$('#title').val(),
            "resume": $("#resume").val(),
            "description": $("#description").val(),
            "category_id": $("#category").val(),
            "published": published,
            "_token": $('#csrf-token')[0].content,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);

            $('#addNew').modal('hide');
            $("#msnSystem").html(data.message);
            $("#msnSystem").removeAttr("class");
            $("#msnSystem").attr("class", "alert alert-success");
            $("#msnSystem").show(500);
            $("#msnSystem").hide(5000);
            getAllNews();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
        });
    }

}


function deleteNew(id){
    $('#modalDelete').modal('show');
    $("#modalDeleteItem").removeAttr("onclick");
    $("#modalDeleteItem").attr("onclick", "deleteNewAction("+id+")");
}

// Delete new
function deleteNewAction(id){
    $.ajax({
    url : 'delete-new',
    type : 'DELETE',
    data: {
            "new_id":id,
            "_token": $('#csrf-token')[0].content,
        },
    dataType: 'json',
    success: function(data){
        console.log(data);

        if (data == null){
            $('#modalDelete').modal('hide');
            $("#msnSystem").html(data.message);
            $("#msnSystem").removeAttr("class");
            $("#msnSystem").attr("class", "alert alert-danger");
        } else {
            $('#modalDelete').modal('hide');
            $("#msnSystem").html(data.message);
            $("#msnSystem").removeAttr("class");
            $("#msnSystem").attr("class", "alert alert-success");
        }

        $("#msnSystem").show(500);
        $("#msnSystem").hide(5000);
        getAllNews();

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });

}


function editNew(id){
    $('#editNew').modal('show');
    $("#btnEditNew").removeAttr("onclick");
    $("#btnEditNew").attr("onclick", "editNewAction("+id+")");

    $.ajax({
    url : 'new-by-id',
    type : 'GET',
    data: {
            "new_id":id,
            "_token": $('#csrf-token')[0].content,
        },
    dataType: 'json',
    success: function(data){
        console.log(data);

        $("#titleEdit").val(data.title);
        $("#resumeEdit").val(data.resume);
        $("#descriptionEdit").val(data.description);
        $("#categoryEdit").val(data.category);

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });
}


// Add news
function editNewAction(id){

    var validado = true;

    if ($('#titleEdit').val() == "" || $('#resumeEdit').val() == "" || $('#descriptionEdit').val() == "" || $('#categoryEdit').val() == ""){
        validado = false;
        $("#msnSystem").html("Campo(s) obrigatório(s) ausente(s)! Tente novamente.");
        $("#msnSystem").removeAttr("class");
        $("#msnSystem").attr("class", "alert alert-danger");
        $("#msnSystem").show(500);
        $('#editNew').modal('hide');
    } else {
        $("#msnSystem").html("");
        $("#msnSystem").removeAttr("class");
        $("#msnSystem").hide(500);
    }

    if(validado){

        var published;
        if ($('#publishEdit').is(':checked')) {
          published = "P";
        } else {
          published = "N";
        }

        $.ajax({
        url : 'edit-new',
        type : 'PUT',
        data: {
            "new_id":id,
            "title":$('#titleEdit').val(),
            "resume": $("#resumeEdit").val(),
            "description": $("#descriptionEdit").val(),
            "category_id": $("#categoryEdit").val(),
            "published": published,
            "_token": $('#csrf-token')[0].content,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);

            $('#editNew').modal('hide');
            $("#msnSystem").html(data.message);
            $("#msnSystem").removeAttr("class");
            $("#msnSystem").attr("class", "alert alert-success");
            $("#msnSystem").show(500);
            $("#msnSystem").hide(5000);
            getAllNews();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
        });
    }

}