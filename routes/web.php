<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('prevent-back-history')->group(function(){
    Auth::routes();
});

Route::get('/data', [App\Http\Controllers\ProtocoloVirtualController::class, 'data']);
Route::middleware('auth', 'prevent-back-history')->group(function () {

    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    

    // Permissões
    Route::get('/permission/{id?}', [App\Http\Controllers\PermissionController::class, 'getDadosUser'])->name('getDadosUser');
    // Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
    Route::post('/permission/save/{id?}', [App\Http\Controllers\PermissionController::class, 'postPermission'])->name('postPermission');
    Route::delete('/permission/delete/{id}', [App\Http\Controllers\PermissionController::class, 'deletePermission'])->name('deletePermission');


    // User
    Route::get('/user/{id?}', [App\Http\Controllers\UserController::class, 'getUser'])->name('getUser');
    Route::post('/user/save/{id?}', [App\Http\Controllers\UserController::class, 'postUser'])->name('postUser');
    Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/user/{id}/editPassword', [App\Http\Controllers\UserController::class, 'editPassword'])->name('edit.password');
    //Route::put('/user', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update.password');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update.password');

    // Login para user interno
    Route::view('/area-restrita', 'auth.login');

    //Proto virtual;
    //Route::resource('protocolo-virtual', App\Http\Controllers\ProtocoloVirtualController::class);
    Route::get('/protocolo-virtual', [App\Http\Controllers\ProtocoloVirtualController::class, 'index'])->name('protocolo-virtual.index');
    Route::get('/protocolo-virtual/create', [App\Http\Controllers\ProtocoloVirtualController::class, 'create'])->name('protocolo-virtual.create');
    Route::post('/protocolo-virtual', [App\Http\Controllers\ProtocoloVirtualController::class, 'store'])->name('protocolo-virtual.store');
    Route::get('/protocolo-virtual/listar', [App\Http\Controllers\ProtocoloVirtualController::class, 'listar'])->name('protocolo-virtual.listar');
    Route::get('/protocolo-virtual/listar-arquivados', [App\Http\Controllers\ProtocoloVirtualController::class, 'listarArquivados'])->name('protocolo-virtual.arquivados');
    Route::get('/protocolo-virtual/{protocolo_virtual}/restore', [App\Http\Controllers\ProtocoloVirtualController::class, 'restore'])->name('protocolo-virtual.restore');
    Route::get('/protocolo-virtual/{protocolo_virtual}/exportar-pdf', [App\Http\Controllers\ProtocoloVirtualController::class, 'exportarPDF'])->name('protocolo-virtual.exportarPDF');
    // Route::get('/protocolo-virtual/pdf', [App\Http\Controllers\ProtocoloVirtualController::class, 'createPDF'])->name('protocolo-virtual.createPDF');
    Route::get('/protocolo-virtual/licenca/{id}', [App\Http\Controllers\ProtocoloVirtualController::class, 'buscaLicenca'])->name('protocolo-virtual.licenca')->withoutMiddleware('auth');;
    Route::delete('/protocolo-virtual/{protocolo_virtual}', [App\Http\Controllers\ProtocoloVirtualController::class, 'destroy'])->name('protocolo-virtual.destroy');
    Route::get('/protocolo-virtual/{protocolo_virtual}/edit', [App\Http\Controllers\ProtocoloVirtualController::class, 'edit'])->name('protocolo-virtual.edit');
    Route::get('/protocolo-virtual/{protocolo_virtual}', [App\Http\Controllers\ProtocoloVirtualController::class, 'show'])->name('protocolo-virtual.show');
    Route::put('/protocolo-virtual/{protocolo_virtual}', [App\Http\Controllers\ProtocoloVirtualController::class, 'update'])->name('protocolo-virtual.update');
    Route::get('/protocolo-virtual/{protocolo_virtual}/modal', [App\Http\Controllers\ProtocoloVirtualController::class, 'getProtocolo'])->name('protocolo-virtual.getProtocolo');
    Route::post('/protocolo-virtual/{protocolo_virtual}/modal', [App\Http\Controllers\ProtocoloVirtualController::class, 'authorizeProtocol'])->name('protocolo-virtual.authorizeProtocol');    
    Route::post('/protocolo-virtual/anexar-licenca', [App\Http\Controllers\ProtocoloVirtualController::class, 'attachLicense'])->name('protocolo-virtual.attach.license');
    
    
    
    //Atendimentos Virtuais
    Route::get('/atendimento-virtual', [App\Http\Controllers\AtendimentoVirtualController::class, 'index'])->name('atendimento-virtual.index');
    //Route::get('/atendimento-virtual/create', [App\Http\Controllers\AtendimentoVirtualController::class, 'create'])->name('atendimento-virtual.create');
    Route::get('/atendimento-virtual/{atendimento_virtual}', [App\Http\Controllers\AtendimentoVirtualController::class, 'show'])->name('atendimento-virtual.show');
    Route::post('/atendimento-virtual', [App\Http\Controllers\AtendimentoVirtualController::class, 'store'])->name('atendimento-virtual.store')->withoutMiddleware('auth');;
    Route::post('/atendimento-virtual/{atendimento_virtual}/send-link', [App\Http\Controllers\AtendimentoVirtualController::class, 'sendLink'])->name('atendimento-virtual.send-link');
    

    //Horarios
    Route::get('/horario-virtual/{id}', [App\Http\Controllers\HorarioController::class, 'getDatas'])->name('horario-virtual.data')->withoutMiddleware('auth');
    Route::get('/horario-virtual/{setor_id}/{data_atend}/{old?}', [App\Http\Controllers\HorarioController::class, 'getHorarios'])->name('horario-virtual.horario')->withoutMiddleware('auth');

    Route::get('/horario', [App\Http\Controllers\HorarioController::class, 'index'])->name('horario.index');
    Route::get('/horario/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('horario.create');
    Route::get('/horario/{id}/edit', [App\Http\Controllers\HorarioController::class, 'edit'])->name('horario.edit');
    Route::post('/horario', [App\Http\Controllers\HorarioController::class, 'store'])->name('horario.store');
    Route::put('/horario/{id}', [App\Http\Controllers\HorarioController::class, 'update'])->name('horario.update');
    Route::delete('/horario/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])->name('horario.destroy');
    //Setores
    Route::get('/setor-virtual/{old?}', [App\Http\Controllers\SetorController::class, 'getSetores'])->name('horario-virtual.setor')->withoutMiddleware('auth');

    // Confirm responsibility
    Route::get('/confirm-responsibility/{id?}', [App\Http\Controllers\ConfirmResponsibilityController::class, 'show'])->name('getConfirmResponsibility');
    Route::post('/confirm-responsibility/save/{id?}', [App\Http\Controllers\ConfirmResponsibilityController::class, 'store'])->name('postConfirmResponsibility');
    Route::delete('/confirm-responsibility/delete/{id}', [App\Http\Controllers\ConfirmResponsibilityController::class, 'delete'])->name('delete');

    // Attach Documents
    Route::get('/attach-documents/{id?}', [App\Http\Controllers\AttachDocumentController::class, 'show'])->name('getAttachDocument');
    Route::post('/attach-documents/save/{id?}', [App\Http\Controllers\AttachDocumentController::class, 'store'])->name('postAttachDocument');
    // Route::delete('/confirm-responsibility/delete/{id}', [App\Http\Controllers\ConfirmResponsibilityController::class, 'delete'])->name('delete');


    // No Auth

    Route::get('/', [App\Http\Controllers\VerificarUserSefin::class, 'index'])->name('pesquisa')->withoutMiddleware('auth');
    Route::post('/sefin', [App\Http\Controllers\VerificarUserSefin::class, 'pesquisar'])->name('pesquisaCPF')->withoutMiddleware('auth');
    Route::get('/sefin', [App\Http\Controllers\VerificarUserSefin::class, 'pesquisar'])->name('pesquisaCPF')->withoutMiddleware('auth');


    //Fale conosco
    Route::get('/ouvidoria', [App\Http\Controllers\OuvidoriaController::class, 'index'])->name('ouvidoria.index');
    Route::post('/ouvidoria', [App\Http\Controllers\OuvidoriaController::class, 'store'])->name('ouvidoria.store')->withoutMiddleware('auth');
    Route::post('/ouvidoria/{id}/send-mensagem', [App\Http\Controllers\OuvidoriaController::class, 'sendMensagem'])->name('ouvidoria.send-mensagem');
    Route::get('/ouvidoria/{id}/edit', [App\Http\Controllers\OuvidoriaController::class, 'edit'])->name('ouvidoria.edit');
    
    //Assuntos
    Route::get('/assunto/{old?}', [App\Http\Controllers\AssuntoController::class, 'getAssuntos'])->name('assunto.get-assuntos')->withoutMiddleware('auth');



});



// Route::fallback(function(){
//     echo "A rota acessada não existe. <a href='/'>Clique aqui</a> para ir para página inicial";
// });