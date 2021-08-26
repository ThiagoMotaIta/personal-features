<?php

namespace App\Http\Controllers;

use App\Mail\SendMailOuvidoria;
use App\Models\Ouvidoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;
use App\Helpers\Helper;
use App\Models\Assunto;
use Illuminate\Support\Facades\Session;

class OuvidoriaController extends Controller
{

    protected $ouvidoria;

    function __construct(Ouvidoria $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Redireciona um novo usuário interno a atualizar a senha

        $default_password = substr(Auth::user()->cpf ,0,-6);

        $query = $this->ouvidoria::query();

        if ($request->input('tipo_assunto')) {
            $query->where('assunto_id', $request->tipo_assunto);
        }

        if ($request->input('status')) {
            $query->where('status_id', $request->status);
        }

        $ouvidorias =  $query->orderBy('created_at', 'desc')->paginate(10);
        $tipo_assunto =  Assunto::all();

        return view('ouvidoria.index', [
            'ouvidorias' => $ouvidorias,
            'tipo_assunto' => $tipo_assunto,
            'request' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $request->merge(['cpf' => Helper::apenasNumeros($request->cpf)]);
        // $request->merge(['telefone' => Helper::apenasNumeros($request->telefone)]);

        if(!empty($request->anonymousFC)){
            $validator = Validator::make($request->all(),
                        $this->ouvidoria->rules(true),
                        $this->ouvidoria->messages());
            $request->nomeFC = "Usuário anônimo";
        }else{
            $validator = Validator::make($request->all(),
                        $this->ouvidoria->rules(),
                        $this->ouvidoria->messages());
        }

        if ($validator->fails()) {
            return   back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('ouvidoria', 'error');
        }

        if(filter_var($request->telefoneFC, FILTER_SANITIZE_NUMBER_INT) === ""){
            $request->telefoneFC = "Número não informado";
        }else{
            $request->telefoneFC = Helper::telefone($request->telefoneFC);
        }
        
        $ouvidoria = $this->ouvidoria::create([
            'nome'=> $request->nomeFC,
            'cpf' => Helper::apenasNumeros($request->cpfFC),
            'telefone' => $request->telefoneFC,
            'email' => $request->emailFC,
            'assunto_id' => $request->reclamacaoFC,
            'mensagem' => $request->mensagemFC,
        ]);
        
        $mensagem = "Em breve um especialista enviará um e-mail solucionando seu atendimento.";

        //Classe SendMailOuvidoria enviar e-mail de solicitação e de resposta ao usuário
        Mail::to($ouvidoria->email)->send(new SendMailOuvidoria($ouvidoria, $mensagem ));
        //Session::flash('message-atendimento', 'Atendimento Solitado!');
        return redirect()->back()->with('message-fale-conosco', 'Solicitação realizada!')->with('fale-id', $ouvidoria->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ouvidoria  $ouvidoria
     * @return \Illuminate\Http\Response
     */
    public function show(Ouvidoria $ouvidoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ouvidoria  $ouvidoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $id = Hashids::decode($id);
        $ouvidoria = $this->ouvidoria->with('assuntoTipo')->find($id[0]);
        return response()->json($ouvidoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ouvidoria  $ouvidoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ouvidoria $ouvidoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ouvidoria  $ouvidoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ouvidoria $ouvidoria)
    {
        //
    }

    public function sendMensagem(Request $request, $id)
    {
        //$id = Hashids::decode($id);

        $rules = [
            'resposta' => ['required'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        //Classe SendMailOuvidoria enviar e-mail de solicitação e de resposta ao usuário
        $ouvidoria = $this->ouvidoria->find($id[0]);
        Mail::to($ouvidoria->email)->send(new SendMailOuvidoria($ouvidoria, $request->resposta ));
        
        $ouvidoria->status_id = 2;
        $ouvidoria->resposta = $request->resposta;
        $ouvidoria->save();
        //return new \App\Mail\SendMailOuvidoria($ouvidoria, $request->mensagem);
        
        Session::flash('record_added', 'Resposta enviada!'); 
        return response()->json(['success' => 'Resposta enviada!']);

    }

}
