<!DOCTYPE html>
<html lang="en">
    <?php include "view/head.php"?>

    <body id="page-top">
        
        <?php include "view/menu-top.php"?>

        <!-- About section-->
        <section id="formSolLink">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 alert div-area" id="etapa1">
                        <div class="alert alert-danger" style="display:none;" id="msnErro"></div>
                        <div id="descEtapa1" style="display: block;">
                            <h2>SOLICITAR BENEFÍCIO <br/><small class="text-success">Etapa 1: Dados do Responsável</small></h2>
                            <hr/>
                            <p class="lead"><strong>Leia com atenção</strong> as informações abaixo:</p>

                            <p class="lead"><small><i class="fas fa-check-circle text-success">
                                </i> O Aluno precisa estar matriculado na Rede Municipal de Caucaia/CE.
                                <br/>
                                <i class="fas fa-check-circle text-success"></i> O solicitante precisa ser o Responsável legal do(s) alunos(s) informado(s) no cadastro de solicitação.</small>
                            </p>
                        </div>

                        <div id="descEtapa2" style="display: none;">
                            <h2>SOLICITAR BENEFÍCIO <br/><small class="text-success">Etapa 2: Endereço</small></h2>
                            <hr/>
                        </div>

                        <div id="descEtapa3" style="display: none;">
                            <h2>SOLICITAR BENEFÍCIO <br/><small class="text-success">Etapa 3: Dados do(s) Aluno(s)</small></h2>
                            <hr/>
                        </div>

                        <div id="descEtapa4" style="display: none;">
                            <h2>SOLICITAR BENEFÍCIO <br/><small class="text-success">Etapa 4: Finalização</small></h2>
                            <hr/>
                        </div>

                        <form id="formSol" method="POST" action="controller/send-sol.php">
                          
                          <!-- ==== etapa 1 === -->

                          <div id="formEtapa1">
                              
                              <strong>*SELECIONE O(S) BENEFÍCIO(S):</strong><br/>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check-tablet" name="check-tablet">
                                <label class="form-check-label" for="exampleCheck1">Benefício Tablet.</label>
                              </div>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check-alim" name="check-alim">
                                <label class="form-check-label" for="exampleCheck1">Benefício Alimentação.</label>
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="cpfResp">*CPF do Responsável</label>
                                <input type="text" class="form-control" id="cpfResp" name="cpfResp" placeholder="Informe o CPF" data-mask="000.000.000-00">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="nomeResp">*Nome do Responsável</label>
                                <input type="text" class="form-control" id="nomeResp" name="nomeResp" placeholder="Informe o Nome completo do Responsável">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="rgResp">*RG do Responsável</label>
                                <input type="number" class="form-control" id="rgResp" name="rgResp" placeholder="Informe o RG">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="dataNascResp">*Data de Nascimento do Responsável</label>
                                <input type="date" class="form-control" id="dataNascResp" name="dataNascResp" placeholder="Informe a data de Nascimento">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="celularResp">Telefone Celular do Responsável (opcional)</label>
                                <input type="text" class="form-control" id="celularResp" name="celularResp" placeholder="Informe o Celular" data-mask="(00)00000-0000">
                              </div>
                              <br/>
                              <button type="button" id="btnEtapa1" class="btn btn-danger" onclick="validaEtapa1()">Continuar <i class="fa fa-chevron-right"></i></button>
                              <span id="loadinValidaEtapa1" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                            </div>

                            <!-- ==== etapa 2 === -->

                            <div id="formEtapa2" style="display: none;">
                              <div class="form-group">
                                <label for="cepResp">*CEP do Responsável</label>
                                <span id="loadingCEP" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                                <input type="text" class="form-control" id="cepResp" name="cepResp" placeholder="Informe o CEP" data-mask="00.000-000">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="cidadeResp">*Cidade</label>
                                <input type="text" class="form-control" id="cidadeResp" name="cidadeResp" disabled="disabled">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="logradouroResp">*Logradouro</label>
                                <input type="text" class="form-control" id="logradouroResp" name="logradouroResp" disabled="disabled">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="bairroResp">*Bairro</label>
                                <input type="text" class="form-control" id="bairroResp" name="bairroResp" disabled="disabled">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="numeroResp">*Número</label>
                                <input type="text" class="form-control" id="numeroResp" name="numeroResp">
                              </div>
                              <br/>
                              <div class="form-group">
                                <label for="complementoResp">Complemento (Opcional)</label>
                                <input type="text" class="form-control" id="complementoResp" name="complementoResp" placeholder="Informe o Complemento">
                              </div>
                              <br/>
                              <button type="button" class="btn btn-secondary" onclick="voltarEtapa1()"><i class="fa fa-chevron-left"></i> Voltar</button>
                              <button type="button" class="btn btn-danger" onclick="validaEtapa2()">Continuar <i class="fa fa-chevron-right"></i></button>
                              <span id="loadinValidaEtapa2" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                            </div>

                            <!-- ==== etapa 3 // ALUNO(S) === -->

                            <div id="formEtapa3" style="display: none;">
                              <div id="aluno-1">
                                <h5 class="hAluno">ALUNO 1</h5>
                                <hr/>
                                
                                <!-- FOTO EDUCACENSO -->
                                <div id="fotoEducaCenso" style="display: none;">
                                  <button type="button" class="btn btn-secondary btn-sm" onclick="fotoEducaCenso('fechar')">Fechar Imagem</button><br/><br/>
                                  <img src="onde-id-aluno.png" class="img-thumbnail" />
                                  <hr/>
                                </div>
                                
                                <input type="hidden" id="aluno-qntd" name="aluno-qntd">
                                <div class="form-group">
                                  <label for="idAluno-1">*Identificador do Aluno (12 dígitos) - 
                                    <i class="fa fa-question-circle text-danger" onclick="fotoEducaCenso('abrir')"></i>
                                  </label>
                                  <input type="text" class="form-control" id="idAluno-1" name="idAluno-1" placeholder="Informe o identificador do Aluno (são 12 dígitos)" data-mask="000000000000">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="escolaAluno-1">*Escola</label>
                                  <input type="hidden" id="escolaAlunoId-1" name="escolaAlunoId-1">
                                  <input type="text" class="form-control" id="escolaAluno-1" placeholder="Informe a Escola onde o Aluno está Matriculado" onkeyup="buscaEscolas(1)">

                                  <div id="autoCompleteEscolas-1" class="alert" style="display:none; padding-bottom: 0px; margin-bottom: 0px;">
                                    
                                  </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="serieAluno-1">*Série</label>
                                  <select class="form-control" id="serieAluno-1" name="serieAluno-1">
                                    <option value="">Selecione</option>
                                    <option value="1">1º ano</option>
                                    <option value="2">2º ano</option>
                                    <option value="3">3º ano</option>
                                    <option value="4">4º ano</option>
                                    <option value="5">5º ano</option>
                                    <option value="6">6º ano</option>
                                    <option value="7">7º ano</option>
                                    <option value="8">8º ano</option>
                                    <option value="9">9º ano</option>
                                    <option value="21">EJA I (1° ao 3° ano)</option>
                                    <option value="22">EJA II (4° e 5° ano)</option>
                                    <option value="23">EJA III (6° e 7° ano)</option>
                                    <option value="24">EJA IV (8° e 9° ano)</option>
                                  </select>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="nomeAluno-1">*Nome</label>
                                  <input type="text" class="form-control" id="nomeAluno-1" name="nomeAluno-1" placeholder="Informe o Nome Completo do Aluno">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="cpfAluno-1">CPF (Opcional)</label>
                                  <input type="text" class="form-control" id="cpfAluno-1" name="cpfAluno-1" placeholder="Informe o CPF do Aluno, caso possua" data-mask="000.000.000-00">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="dataNascAluno-1">*Data de Nascimento</label>
                                  <input type="date" class="form-control" id="dataNascAluno-1" name="dataNascAluno-1" placeholder="Informe a data de Nascimento do Aluno">
                                </div>
                                <br/>

                                <div id="novosAlunos"></div><!-- Append Alunos -->

                                <button type="button" class="btn btn-secondary" onclick="outroAluno(2)" id="btnAddAluno">Adicionar outro Aluno <i class="fa fa-plus-circle"></i></button> <button type="button" class="btn btn-danger" onclick="validaEtapa3()" id="seguirEtapa4-1">Continuar <i class="fa fa-chevron-right"></i></button>
                                
                              </div> <!-- Fim Aluno 1 -->
                            </div>

                            <!-- FINALIZACAO -->
                            <div id="formEtapa4" style="display: none;">
                              
                              <input type="hidden" id="check-1-val" name="check-1-val">
                              <input type="hidden" id="check-2-val" name="check-2-val">
                              
                              <strong>TERMO DE CIÊNCIA E AUTORIZAÇÃO:</strong><br/>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check-1" name="check-1">
                                <label class="form-check-label" for="exampleCheck1">Declaro que li e tenho ciência que me enquadro em todas as condições listadas acima.</label>
                              </div>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check-2" name="check-2">
                                <label class="form-check-label" for="exampleCheck1">Autorizo o acesso e uso dos meus dados para validar as informações acima.</label>
                              </div>

                              <br/>
                              <button type="button" class="btn btn-secondary" onclick="voltarEtapa3()"><i class="fa fa-chevron-left"></i> Voltar</button>
                              <button type="button" class="btn btn-danger" onclick="validaEtapa4()">Continuar <i class="fa fa-chevron-right"></i></button>
                              <span id="loadinValidaEtapa4" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- Consultar Solicitacoes -->
        <section id="consultaSol-form" style="display:none;">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 alert div-area" id="etapa1">
                        <div class="alert alert-danger" style="display:none;" id="msnErroConsulta">
                          <strong>Erro:</strong>
                          <hr/>
                          O CPF informado não possui solicitação cadastrada ou está inválido.
                        </div>
                        
                          <h2>CONSULTAR SOLICITAÇÃO <br/><small class="text-success"></small></h2>
                          <hr/>
                          <p class="lead">Informe abaixo o <strong>CPF do Responsável</strong> (não é o CPF do aluno):</p>

                          <form>
                            <div class="form-group" id="inputBuscaSol">
                              <label for="cpfBusca">*CPF</label>
                              <input type="text" class="form-control" id="cpfBusca" placeholder="Informe o CPF do Responsável" data-mask="000.000.000-00">
                            </div>
                            <br/>
                            <div align="center" id="buscaSolLista" style="display:none;">
                              
                            </div>
                            <button type="button" class="btn btn-danger" onclick="buscaSol()">
                            <i class="fa fa-search"></i> Consultar
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="novaBuscaSol()" style="display:none;" id="limparBuscaSol">
                            <i class="fa fa-times-circle"></i> Limpar
                            </button>
                            <span id="loadingBuscaSol" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                          </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- EDICAO -->
        <section id="formSolEdit" style="display: none;">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 alert div-area" id="etapa1">
                        <div class="alert alert-danger" style="display:none;" id="msnErroEdit"></div>
                        <div>
                            <h2>CORRIGIR SOLICITAÇÃO<br/><small class="text-success">Dados do Aluno</small></h2>
                            <hr/>
                        </div>

                        <form id="formEditSol" method="POST" action="controller/edit-sol.php">
                         
                            <!-- ==== etapa CORRECAO // ALUNO(S) === -->

                            <div id="formEtapa3">
                              <div id="aluno-1">
                                <h5 class="hAluno">ALUNO </h5>
                                <hr/>
                                <div class="form-group">
                                  <input type="hidden" id="idTable-edit" name="idTable-edit">
                                  <label for="idAluno-edit">*Identificador do Aluno (12 dígitos)</label>
                                  <input type="text" class="form-control" id="idAluno-edit" name="idAluno-edit" placeholder="Informe o identificador do Aluno (são 12 dígitos)" data-mask="000000000000">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="escolaAluno-edit">*Escola</label>
                                  <input type="hidden" id="escolaAlunoId-edit" name="escolaAlunoId-edit">
                                  <input type="text" class="form-control" id="escolaAluno-edit" placeholder="Informe a Escola onde o Aluno está Matriculado" onkeyup="buscaEscolasEdit()">

                                  <div id="autoCompleteEscolas-edit" class="alert" style="display:none; padding-bottom: 0px; margin-bottom: 0px;">
                                    
                                  </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="serieAluno-edit">*Série</label>
                                  <select class="form-control" id="serieAluno-edit" name="serieAluno-edit">
                                    <option value="">Selecione</option>
                                    <option value="1">1º ano</option>
                                    <option value="2">2º ano</option>
                                    <option value="3">3º ano</option>
                                    <option value="4">4º ano</option>
                                    <option value="5">5º ano</option>
                                    <option value="6">6º ano</option>
                                    <option value="7">7º ano</option>
                                    <option value="8">8º ano</option>
                                    <option value="9">9º ano</option>
                                    <option value="21">EJA I (1° ao 3° ano)</option>
                                    <option value="22">EJA II (4° e 5° ano)</option>
                                    <option value="23">EJA III (6° e 7° ano)</option>
                                    <option value="24">EJA IV (8° e 9° ano)</option>
                                  </select>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="nomeAluno-edit">*Nome</label>
                                  <input type="text" class="form-control" id="nomeAluno-edit" name="nomeAluno-edit" placeholder="Informe o Nome Completo do Aluno">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="cpfAluno-edit">CPF (Opcional)</label>
                                  <input type="text" class="form-control" id="cpfAluno-edit" name="cpfAluno-edit" placeholder="Informe o CPF do Aluno, caso possua" data-mask="000.000.000-00">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="dataNascAluno-edit">*Data de Nascimento</label>
                                  <input type="date" class="form-control" id="dataNascAluno-edit" name="dataNascAluno-edit" placeholder="Informe a data de Nascimento do Aluno">
                                </div>
                                <br/>

                                <div id="novosAlunosEdit"></div><!-- Append Alunos -->

                                <button type="button" class="btn btn-secondary" onclick="cancelarEdit()" id="btnAddAluno"><i class="fa fa-chevron-left"></i></i> Voltar</button> <button type="button" class="btn btn-danger" onclick="validaEditSol()" id="seguirEtapa4-1">Continuar <i class="fa fa-chevron-right"></i></button>
                                <span id="loadinValidaEditSol" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                                
                              </div> <!-- Fim Aluno 1 -->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- NOVO ALUNO FROM BUSCA -->
        <section id="formNovoAluno" style="display: none;">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 alert div-area" id="etapa1">
                        <div class="alert alert-danger" style="display:none;" id="msnErroNovoAluno"></div>
                        <div>
                            <h2>INCLUIR ALUNO<br/><small class="text-success">Dados do Aluno</small></h2>
                            <hr/>
                        </div>

                        <form id="formNovoAlunoFromBusca" method="POST" action="controller/send-sol-new-aluno.php">
                         
                            <!-- ==== etapa CORRECAO // ALUNO(S) === -->

                            <div id="formEtapa3">
                              <div id="aluno-novoAluno">
                                <h5 class="hAluno">NOVO ALUNO </h5>
                                <hr/>
                                <div class="form-group">
                                  <input type="hidden" id="id-solicitante-novoAluno" name="id-solicitante-novoAluno">
                                  <label for="idAluno-novoAluno">*Identificador do Aluno (12 dígitos)</label>
                                  <input type="text" class="form-control" id="idAluno-novoAluno" name="idAluno-novoAluno" placeholder="Informe o identificador do Aluno (são 12 dígitos)" data-mask="000000000000">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="escolaAluno-novoAluno">*Escola</label>
                                  <input type="hidden" id="escolaAlunoId-novoAluno" name="escolaAlunoId-novoAluno">
                                  <input type="text" class="form-control" id="escolaAluno-novoAluno" placeholder="Informe a Escola onde o Aluno está Matriculado" onkeyup="buscaEscolasNovoAluno()">

                                  <div id="autoCompleteEscolas-novoAluno" class="alert" style="display:none; padding-bottom: 0px; margin-bottom: 0px;">
                                    
                                  </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="serieAluno-novoAluno">*Série</label>
                                  <select class="form-control" id="serieAluno-novoAluno" name="serieAluno-novoAluno">
                                    <option value="">Selecione</option>
                                    <option value="1">1º ano</option>
                                    <option value="2">2º ano</option>
                                    <option value="3">3º ano</option>
                                    <option value="4">4º ano</option>
                                    <option value="5">5º ano</option>
                                    <option value="6">6º ano</option>
                                    <option value="7">7º ano</option>
                                    <option value="8">8º ano</option>
                                    <option value="9">9º ano</option>
                                  </select>
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="nomeAluno-novoAluno">*Nome</label>
                                  <input type="text" class="form-control" id="nomeAluno-novoAluno" name="nomeAluno-novoAluno" placeholder="Informe o Nome Completo do Aluno">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="cpfAluno-novoAluno">CPF (Opcional)</label>
                                  <input type="text" class="form-control" id="cpfAluno-novoAluno" name="cpfAluno-novoAluno" placeholder="Informe o CPF do Aluno, caso possua" data-mask="000.000.000-00">
                                </div>
                                <br/>
                                <div class="form-group">
                                  <label for="dataNascAluno-novoAluno">*Data de Nascimento</label>
                                  <input type="date" class="form-control" id="dataNascAluno-novoAluno" name="dataNascAluno-novoAluno" placeholder="Informe a data de Nascimento do Aluno">
                                </div>
                                <br/>

                                <div id="novosAlunosEdit"></div><!-- Append Alunos -->

                                <button type="button" class="btn btn-secondary" onclick="cancelarNovoAluno()" id="btnAddAluno"><i class="fa fa-chevron-left"></i></i> Voltar</button> <button type="button" class="btn btn-danger" onclick="validaNovoAluno()" id="seguirEtapa4-1">Continuar <i class="fa fa-chevron-right"></i></button>
                                <span id="loadinValidanNovoAluno" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
                                
                              </div> <!-- Fim Aluno 1 -->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
       
       <?php include "view/footer.php"?>

       <script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
       <script src="js/jquery.mask.js" type="text/javascript"></script>
       <script src="js/web-app-solicitante.js?10" type="text/javascript"></script>
    </body>
</html>
