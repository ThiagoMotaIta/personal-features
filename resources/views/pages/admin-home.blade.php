@extends('layouts.webapp')

@section('content')

    <div class="navbar">
        <img src="img/logo.png" />
    </div>

    <hr/>

    <div>
        @auth
        <div align="right">Bem-vindo(a), <i class="fa fa-user"></i> <strong>{{ Auth::user()->name }}</strong>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fa fa-sign-out"></i> Sair
                </x-responsive-nav-link>
            </form>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">Home</a>
                        @if (Auth::user()->type == 'V')
                        <a class="nav-link" href="#" onclick="getAllProducts()">Produtos</a>
                        <a class="nav-link" href="#" onclick="getAllClients()">Clientes</a>
                        <a class="nav-link" href="#" onclick="getAllSailers()">Vendedores</a>
                        <a class="nav-link" href="#" onclick="getAllOportunities()">Oportunidades</a>
                        @endif
                    </div>
                    </div>
                </div>
            </nav>

            <hr/>

            <div class="row">
                <div class="col" id="table-title">

                </div>
                <div class="col" align="right">
                    <button type="button" class="btn btn-primary" id="cad-item" style="display: none;" data-bs-toggle="modal">
                        <i class="fa fa-plus-circle"></i> Cadastrar
                    </button>
                </div>
            </div>

            <div class="navbar">
                <table class="table table-striped table-responsive" id="table-list">
                    <thead class="alert-info">
                        <tr>
                            <tr id="table-trs"></tr>
                        </tr>
                    </thead>
                    <tbody id="table-results">
                    </tbody>
                </table>
            </div>
        @else
            Você não deveria estar aqui! <a href="{{ route('logout') }}" class="btn btn-primary">Sair</a>
        @endauth
    </div>


    <!-- MODALS -->
    <div class="modal fade" id="product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                      <div class="alert alert-danger" id="error-cad-prod" style="display: none;">
                     </div>
                      <div class="mb-3">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" id="product" name="product" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Preço R$</label>
                        <input type="text" id="price" name="price" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Quantidade em Estoque</label>
                        <input type="number" id="quantity" name="quantity" class="form-control">
                      </div>
                    </fieldset>
                  </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadNewProduct()">Cadastrar</button>
            </div>
        </div>
        </div>
    </div>


    <div class="modal fade" id="oportunity-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Oportunidade de Venda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                      <div class="alert alert-danger" id="error-cad-prod" style="display: none;">
                     </div>
                      <div class="mb-3">
                        <label class="form-label">Produto</label>
                        <select id="product-sel" name="product-sel" class="form-control">
                            <option value="">Selecione</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->product}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select id="client-sel" name="client-sel" class="form-control">
                            <option value="">Selecione</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Vendedor</label>
                        <select id="sailer-sel" name="sailer-sel" class="form-control">
                            <option value="">Selecione</option>
                            @foreach ($sailers as $sailer)
                                <option value="{{$sailer->id}}">{{$sailer->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </fieldset>
                  </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadNewOportunity()">Cadastrar</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="oportunity-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atualizar Oportunidade de Venda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                      <div class="alert alert-danger" id="error-edit-opor" style="display: none;">
                     </div>
                      <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="oportunity-status-sel" name="oportunity-status-sel" class="form-control">
                            <option value="">Selecione</option>
                            <option value="A">APROVADA</option>
                            <option value="P">PERDIDA</option>
                            <option value="V">VENCIDA</option>
                            <option value="R">REPROVADA</option>
                        </select>
                      </div>
                    </fieldset>
                  </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" id="edit-oport">Editar</button>
            </div>
        </div>
        </div>
    </div>

    <button type="button" style="display: none;" id="oportunity-update-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#oportunity-update">
    </button>


    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- API Calls -->
    <script type="text/javascript">

        // All Clients
        function getAllClients(){
            $("#table-title").html("Carregando...");
            $("#table-results").html("");
            $("#table-trs").html("");
            $("#cad-item").hide();

            $.ajax({
            url : 'api/clients',
            type : 'GET',

            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data[0] == null){
                    $("#table-results").html("<div class='alert alert-warning'>Opa, não encontramos nenhum registro.</div>")
                    $("#table-title").html("<h4>CLIENTES</h4>");
                } else {

                    $("#table-trs").append("<th>#</th><th>NOME</th><th>E-MAIL</th><th>AÇÕES</th>");

                    for (var i=0; i < data.length; i++) {

                        $("#table-results").append("<tr>"+
                                                            "<td>"+data[i].id+""+
                                                            "<td>"+data[i].name+"</td>"+
                                                            "<td>"+data[i].email+"</td>"+
                                                            "<td></td>"+
                                                            "</tr>");
                    }

                    $("#table-title").html("<h4>CLIENTES</h4>");

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }

        // All Sailers
        function getAllSailers(){
            $("#table-title").html("Carregando...");
            $("#table-results").html("");
            $("#table-trs").html("");
            $("#cad-item").hide();

            $.ajax({
            url : 'api/sailers',
            type : 'GET',

            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data[0] == null){
                    $("#table-results").html("<div class='alert alert-warning'>Opa, não encontramos nenhum registro.</div>")
                    $("#table-title").html("<h4>VENDEDORES</h4>");
                } else {

                    $("#table-trs").append("<th>#</th><th>NOME</th><th>E-MAIL</th><th>AÇÕES</th>");

                    for (var i=0; i < data.length; i++) {

                        $("#table-results").append("<tr>"+
                                                            "<td>"+data[i].id+""+
                                                            "<td>"+data[i].name+"</td>"+
                                                            "<td>"+data[i].email+"</td>"+
                                                            "<td></td>"+
                                                            "</tr>");
                    }

                    $("#table-title").html("<h4>VENDEDORES</h4>");

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }


        // All Products
        function getAllProducts(){
            $("#table-title").html("Carregando...");
            $("#table-results").html("");
            $("#table-trs").html("");
            $("#cad-item").show();

            $("#cad-item").removeAttr("data-bs-target");
            $("#cad-item").attr("data-bs-target", "#product-modal");

            $.ajax({
            url : 'api/products',
            type : 'GET',

            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data[0] == null){
                    $("#table-results").html("<div class='alert alert-warning'>Opa, não encontramos nenhum registro</strong>.</div>")
                    $("#table-title").html("<h4>PRODUTOS</h4>");
                } else {

                    $("#table-trs").append("<th>#</th><th>PRODUTO</th><th>PREÇO</th><th>QUANTIDADE</th><th>AÇÕES</th>");

                    for (var i=0; i < data.length; i++) {

                        $("#table-results").append("<tr>"+
                                                            "<td>"+data[i].id+""+
                                                            "<td>"+data[i].product+"</td>"+
                                                            "<td>"+data[i].price+"</td>"+
                                                            "<td>"+data[i].quantity+"</td>"+
                                                            "<td><button class='btn btn-sm btn-danger' onclick='deleteProduct("+data[i].id+")'><i class='fa fa-trash'></i></button></td>"+
                                                            "</tr>");
                    }

                    $("#table-title").html("<h4>PRODUTOS</h4>");

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }


        // Cad New Product
        function cadNewProduct(){

            var validado = true;

            if ($('#product').val() == "" || $('#price').val() == "" || $('#quantity').val() == ""){
                validado = false;
                $("#error-cad-prod").html("Preencha todos os campos!");
                $("#error-cad-prod").show(500);
            } else {
                $("#error-cad-prod").hide(500);
                $("#table-title").html("Carregando...");
                $("#cad-item").hide();
                $("#table-results").html("");
                $("#table-trs").html("");
            }

            if(validado){
                $.ajax({
                url : 'api/cad-product',
                type : 'POST',
                data: {
                    "product":$('#product').val(),
                    "price": $("#price").val(),
                    "quantity": $("#quantity").val()
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);

                    if (data == null){
                        $("#table-results").html("<div class='alert alert-warning'>Opa, não conseguimos cadastrar o Produto. Tente novamente!</div>")
                        $("#table-title").html("<h4>PRODUTOS</h4>");
                    } else {
                        $("#table-results").html("<div class='alert alert-success'>"+data.message+"</div>")
                        $("#table-title").html("<h4>PRODUTOS</h4>");
                        $("#cad-item").click();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
                });
            }

        }


        // Cad New Product
        function deleteProduct(id){
            $.ajax({
            url : 'api/delete-product/'+id,
            type : 'DELETE',
            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data == null){
                    $("#table-results").html("");
                    $("#table-trs").html("");
                    $("#table-results").html("<div class='alert alert-warning'>"+data.message+"</div>")
                    $("#table-title").html("<h4>PRODUTOS</h4>");
                } else {
                    $("#table-results").html("");
                    $("#table-trs").html("");
                    $("#table-results").html("<div class='alert alert-success'>"+data.message+"</div>")
                    $("#table-title").html("<h4>PRODUTOS</h4>");
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }


        // All Oportunities
        function getAllOportunities(){
            $("#table-title").html("Carregando...");
            $("#table-results").html("");
            $("#table-trs").html("");
            $("#cad-item").show();

            $("#cad-item").removeAttr("data-bs-target");
            $("#cad-item").attr("data-bs-target", "#oportunity-modal");

            $.ajax({
            url : 'api/oportunities',
            type : 'GET',

            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data[0] == null){
                    $("#table-results").html("<div class='alert alert-warning'>Opa, não encontramos nenhum registro</strong>.</div>")
                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");
                } else {

                    $("#table-trs").append("<th>#</th><th>PRODUTO</th><th>CLIENTE</th><th>VENDEDOR</th><th>STATUS</th><th>AÇÕES</th>");

                    for (var i=0; i < data.length; i++) {

                        $("#table-results").append("<tr>"+
                                                            "<td>"+data[i].id+""+
                                                            "<td>"+data[i].produto+"</td>"+
                                                            "<td>"+data[i].cliente+"</td>"+
                                                            "<td>"+data[i].vendedor+"</td>"+
                                                            "<td>"+data[i].status+"</td>"+
                                                            "<td><button class='btn btn-sm btn-danger' onclick='deleteOportunity("+data[i].id+")'><i class='fa fa-trash'></i></button> <button class='btn btn-sm btn-primary' onclick='modalUpdateOportunity("+data[i].id+")'><i class='fa fa-edit'></i></button></td>"+
                                                            "</tr>");
                    }

                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }


        // Cad New Oportunity
        function cadNewOportunity(){

            var validado = true;

            if ($('#product-sel').val() == "" || $('#client-sel').val() == "" || $('#sailer-sel').val() == ""){
                validado = false;
                $("#error-cad-opor").html("Preencha todos os campos!");
                $("#error-cad-opor").show(500);
            } else {
                $("#error-cad-opor").hide(500);
                $("#table-title").html("Carregando...");
                $("#cad-item").hide();
                $("#table-results").html("");
                $("#table-trs").html("");
            }

            if(validado){
                $.ajax({
                url : 'api/cad-oportunity',
                type : 'POST',
                data: {
                    "product":$('#product-sel').val(),
                    "client": $("#client-sel").val(),
                    "sailer": $("#sailer-sel").val()
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);

                    if (data == null){
                        $("#table-results").html("<div class='alert alert-warning'>Opa, não conseguimos cadastrar o Produto. Tente novamente!</div>")
                        $("#table-title").html("<h4>OPORTUNIDADE</h4>");
                    } else {
                        $("#table-results").html("<div class='alert alert-success'>"+data.message+"</div>")
                        $("#table-title").html("<h4>OPORTUNIDADE</h4>");
                        $("#cad-item").click();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
                });
            }

        }


        // Delete Oportunity
        function deleteOportunity(id){
            $.ajax({
            url : 'api/delete-oportunity/'+id,
            type : 'DELETE',
            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data == null){
                    $("#table-results").html("");
                    $("#table-trs").html("");
                    $("#table-results").html("<div class='alert alert-warning'>"+data.message+"</div>")
                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");
                } else {
                    $("#table-results").html("");
                    $("#table-trs").html("");
                    $("#table-results").html("<div class='alert alert-success'>"+data.message+"</div>")
                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }

        function modalUpdateOportunity(id){
            $("#edit-oport").removeAttr("onclick");
            $("#edit-oport").attr("onclick", "editOportunity("+id+")");
            $("#oportunity-update-button").click();
        }


        // Update Oportunity
        function editOportunity(id){

            var validado = true;

            if ($('#oportunity-status-sel').val() == ""){
                validado = false;
                $("#error-edit-opor").html("Preencha todos os campos!");
                $("#error-edit-opor").show(500);
            } else {
                $("#error-edit-opor").hide(500);
                $("#table-title").html("Carregando...");
                $("#cad-item").hide();
                $("#table-results").html("");
                $("#table-trs").html("");
            }

            if(validado){
                $.ajax({
                url : 'api/edit-oportunity/'+id,
                type : 'PUT',
                data: {
                    "status":$('#oportunity-status-sel').val(),
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);

                    if (data == null){
                        $("#table-results").html("<div class='alert alert-warning'>Opa, não conseguimos editar. Tente novamente!</div>")
                        $("#table-title").html("<h4>OPORTUNIDADE</h4>");
                    } else {
                        $("#table-results").html("<div class='alert alert-success'>"+data.message+"</div>")
                        $("#table-title").html("<h4>OPORTUNIDADE</h4>");
                        $("#oportunity-update-button").click();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
                });
            }

        }


        // All Oportunities by Sailer
        function getAllOportunitiesBySailer(){
            $("#table-title").html("Carregando...");
            $("#table-results").html("");
            $("#table-trs").html("");
            $("#cad-item").show();

            $("#cad-item").removeAttr("data-bs-target");
            $("#cad-item").attr("data-bs-target", "#oportunity-modal");

            var sailer = $("#search-vendedor").val();

            $.ajax({
            url : 'api/oportunities/'+sailer,
            type : 'GET',

            dataType: 'json',
            success: function(data){
                console.log(data);

                if (data[0] == null){
                    $("#table-results").html("<div class='alert alert-warning'>Opa, não encontramos nenhum registro</strong>.</div>")
                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");
                } else {

                    $("#table-trs").append("<th>#</th><th>PRODUTO</th><th>CLIENTE</th><th>VENDEDOR</th><th>STATUS</th><th>AÇÕES</th>");

                    for (var i=0; i < data.length; i++) {

                        $("#table-results").append("<tr>"+
                                                            "<td>"+data[i].id+""+
                                                            "<td>"+data[i].produto+"</td>"+
                                                            "<td>"+data[i].cliente+"</td>"+
                                                            "<td>"+data[i].vendedor+"</td>"+
                                                            "<td>"+data[i].status+"</td>"+
                                                            "<td><button class='btn btn-sm btn-danger' onclick='deleteOportunity("+data[i].id+")'><i class='fa fa-trash'></i></button> <button class='btn btn-sm btn-primary' onclick='modalUpdateOportunity("+data[i].id+")'><i class='fa fa-edit'></i></button></td>"+
                                                            "</tr>");
                    }

                    $("#table-title").html("<h4>OPORTUNIDADES</h4>");

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
            });

        }
    </script>

@endsection
