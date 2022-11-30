<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
      <title>Thiago Mota - Teste Investidor10</title>
      <link rel="icon" type="image/x-icon" href="" />
      <!-- Core theme CSS (includes Bootstrap)-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="css/styles.css" rel="stylesheet" />
  </head>

  <body id="page-top">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
          <div class="container px-4">
            <a class="navbar-brand" href="#">
              <img src="https://investidor10.com.br/assets/front/images/logo.svg">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#" onclick="modalAddNew()">
                    <strong>CADASTRAR NOTÍCIAS</strong>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" onclick="getAllNews()">
                    <strong>EXIBIR NOTÍCIAS</strong>
                  </a>
                </li>
              </ul>
              <input type="text" class="form-control" id="search-news" placeholder="Busque e tecle ENTER">
            </div>
          </div>
      </nav>

      <main role="main">

        <div class="container" id="content-div">
          <div id="msnSystem"></div>
          <div align="right">
            <div align="right">Olá, <i class="fa fa-user"></i> <strong>{{ Auth::user()->name }}</strong>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fa fa-sign-out"></i> Logoff
                </x-responsive-nav-link>
            </form>
            </div>
          </div>
          <hr/>

          <div class="row" id="listNews">
            
          </div>
            
        </div>
      </div>

      </main>

      <footer class="footer">
        <div class="container" align="center">
          <span class="text-muted"><strong>DESENVOLVIDO POR THIAGO MOTA</strong></span>
        </div>
      </footer>

      <!-- Modal -->
      <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastrar Notícia</h5>
            </div>
            <div class="modal-body">
              <form id="formClientsEdit">
                <div class="form-row">
                  <div class="col-12">
                    <label>Título*</label>
                    <input type="text" class="form-control" id="title">
                  </div><br/>
                  <div class="col-12">
                    <label>Resumo*</label>
                    <textarea class="form-control" id="resume"></textarea>
                  </div><br/>
                  <div class="col-12">
                    <label>Notícia*</label>
                    <textarea rows="6" class="form-control" id="description"></textarea>
                  </div><br/>
                  <div class="col-12">
                    <label>Categoria*</label>
                    <select id="category" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                  </div><br/>
                  <div class="col-12">
                    <label>Deseja Publicar?</label>
                    <input type="checkbox" id="publish" checked />
                  </div>
                </div>
              </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="addNew()">Cadastrar</button>
                <i id="loadAddNew" class="fa fa-spin fa-spinner" style="display: none;"></i>
            </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete -->
      <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Deletar Notícia</h5>
            </div>
            <div class="modal-body">
              Deseja realmente deletar esta notícia?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="modalDeleteItem">Deletar</button>
                <i id="loadDelete" class="fa fa-spin fa-spinner" style="display: none;"></i>
            </div>
          </div>
        </div>
      </div>

    <!-- Modal Edicao -->
      <div class="modal fade" id="editNew" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Notícia</h5>
            </div>
            <div class="modal-body">
              <form id="formClientsEdit">
                <div class="form-row">
                  <div class="col-12">
                    <label>Título*</label>
                    <input type="text" class="form-control" id="titleEdit">
                  </div><br/>
                  <div class="col-12">
                    <label>Resumo*</label>
                    <textarea class="form-control" id="resumeEdit"></textarea>
                  </div><br/>
                  <div class="col-12">
                    <label>Notícia*</label>
                    <textarea rows="6" class="form-control" id="descriptionEdit"></textarea>
                  </div><br/>
                  <div class="col-12">
                    <label>Categoria*</label>
                    <select id="categoryEdit" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                  </div><br/>
                  <div class="col-12">
                    <label>Deseja Publicar?</label>
                    <input type="checkbox" id="publishEdit" checked />
                  </div>
                </div>
              </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnEditNew" class="btn btn-secondary">Editar</button>
                <i id="loadEditNew" class="fa fa-spin fa-spinner" style="display: none;"></i>
            </div>
        </div>
      </div>
    </div>

  </body>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <script src="js/jquery-3.6.1.min.js"></script>
  <!-- System Features -->
  <script src="js/geral.js"></script>

  <!-- For modal ONLY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $( document ).ready(function() {
        getAllNews();
    });
  </script>
</html>

