<?php

namespace App\Http\Controllers;

use App\Models\AtendimentoVirtual;
use App\Models\StatusAtendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Carbon;
use App\Models\Horario;
use Vinkla\Hashids\Facades\Hashids;
use App\Mail\AtendimentoVirtualMail;
use Illuminate\Support\Facades\Mail;
use Helper;
use App\Models\Setor;

class AtendimentoVirtualController extends Controller
{

    protected $atendimentoVirtual;
    protected $statusAtendimento;

    function __construct(AtendimentoVirtual $atendimentoVirtual, StatusAtendimento $statusAtendimento)
    {
        $this->atendimentoVirtual = $atendimentoVirtual;
        $this->statusAtendimento = $statusAtendimento;
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

        $query = $this->atendimentoVirtual::query();

        if ($request->input('setor')) {
            $query->where('setor_id', $request->setor);
        }

        if ($request->input('data')) {
            $data = Helper::apenasNumeros($request->data);
            // dd(strlen($data));
            if(strlen($data) < 8 ){
                $request->data = null;
            }
            $data = Carbon::create($request->data)->format('Y-m-d');
            $query->where('data_atendimento', 'LIKE', '%' . $data . '%');

        }

        $atendimento_virtuais =  $query->orderBy('data_atendimento', 'desc')
        ->paginate(10);

        $setores = Setor::all()->sortBy('descricao');

        return view('atendimento-virtual.index', [
            'atendimento_virtuais' => $atendimento_virtuais,
            'setores' => $setores,
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
        return "Create Control";
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
        //dd(Carbon::parse($request->data_atendimento)->format('Y-m-d'));

        $request->merge(['cpf' => Helper::apenasNumeros($request->cpf)]);
        $request->merge(['telefone' => Helper::apenasNumeros($request->telefone)]);
        //$request->merge(['data_atendimento' => Carbon::parse($request->data_atendimento)->format('Y-m-d')]);

        //dd($request->all());
        Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
            $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);
            if ($value == 1) {
                return true;
            }
            else {
                return false;
            }
        });
        $rules = [
            'cpf_atend' => ['required', 'cpf'],
            'nome_atend' => ['required'],
            'telefone_atend' => ['required', 'min:10'],
            'email_atend' => ['required', 'mail'],
            'assunto' => ['required'],
            'setor_id' => ['required', 'exists:setores,id'],
            //'data_atendimento' => ['required', 'date_format:d-m-Y', 'exists:horarios,data'],
            'data_atendimento' => ['required', 'date_format:d-m-Y'],
            'hora_atendimento' => ['required'],
            'mensagem' => ['required'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
            'cpf_atend.cpf' => 'CPF Inválido. Por favor, preencha novamente.',
            'email_atend.mail' => 'Digite um e-mail válido',
            'setor_id.exists' => 'Setor não definido',
            'data_atendimento.date_format' => 'Data Inválida',
            // 'data_atendimento.exists' => 'Data não disponivél para agendamento',
        ];

        //validator::make($request->all(), $rules, $messages )->validate();
        //$validator = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return   back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('atend', 'error');
        }

        //dd($request->all());
        //$request->merge(['data_atendimento' => Carbon::parse($request->data_atendimento)->format('Y-m-d')]);

        $atend = AtendimentoVirtual::create([
            'cpf' => $request->cpf_atend,
            'nome'=> $request->nome_atend,
            'telefone' => Helper::telefone($request->telefone_atend),
            'email' => $request->email_atend,
            'numero_processo' => $request->numero_processo,
            'assunto' => $request->assunto,
            'setor_id' => $request->setor_id,
            'data_atendimento' => $request->data_atendimento . " " . $request->hora_atendimento,
            'mensagem' => $request->mensagem,
        ]);

        $horario = Horario::where('setor_id', $request->setor_id)
                            ->where('data', Carbon::parse($request->data_atendimento)->format('Y-m-d'))
                            ->where('horario', $request->hora_atendimento)
                            ->first();

        $horario->disponivel = 0;
        $horario->save();

        //Session::flash('message-atendimento', 'Atendimento Solitado!');

        return redirect()->back()->with('message-atendimento', 'Atendimento Solitado!')->with('atend-id', $atend->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtendimentoVirtual  $atendimentoVirtual
     * @return \Illuminate\Http\Response
     */
    public function show(AtendimentoVirtual $atendimentoVirtual)
    {
        return view('atendimento-virtual.show', [
            'atendimento_virtual' => $atendimentoVirtual,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AtendimentoVirtual  $atendimentoVirtual
     * @return \Illuminate\Http\Response
     */
    public function edit(AtendimentoVirtual $atendimentoVirtual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtendimentoVirtual  $atendimentoVirtual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtendimentoVirtual $atendimentoVirtual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtendimentoVirtual  $atendimentoVirtual
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtendimentoVirtual $atendimentoVirtual)
    {
        //
    }

    public function sendLink(Request $request, $id)
    {
        $rules = [
            'link' => ['required'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
        ];

        //validator::make($request->all(), $rules, $messages )->validate();
        //$validator = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return   back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('send-link', $request->id);
        }

        $id = Hashids::decode($id);
        $atendimento = $this->atendimentoVirtual->find($id[0]);

        Mail::to($atendimento->email)->send(new AtendimentoVirtualMail($atendimento, $request->link ));
        //return new \App\Mail\AtendimentoVirtualMail($atendimento, $request->link);

        $dataForm['status_atendimento_id'] = 2;
        $dataForm['link'] = $request->link;

        $atendimento->update($dataForm);

        return back()->with("record_added", 'Link enviado!');

    }


}
