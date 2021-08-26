<?php

namespace App\Http\Controllers;

use App\Events\CreatedProtocolo;
use App\Models\ProtocoloVirtual;
use App\Models\StatusProtocolo;
use App\Models\StatusConfirmacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\TipoLicenca;
use App\Models\AttachDocuments;
use App\Models\Documents;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;
use PDF;
use QrCode;
use View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Carbon;
use Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailProtocoloVirtual;

// use Codedge\Fpdf\Fpdf\Fpdf;
// use chillerlan\QRCode\{QRCode, QROptions};

class ProtocoloVirtualController extends Controller
{

    protected $protocoloVirtual;

    function __construct(ProtocoloVirtual $protocoloVirtual)
    {
        // $this->middleware('auth');
        $this->protocoloVirtual = $protocoloVirtual;
    }

    public function data()
    {
        $protocolos = ProtocoloVirtual::withTrashed()->get();

        foreach ($protocolos as $key => $protocolo) {
            $protocolo->deleted_at = null;
            $protocolo->status_protocolo_id = 1;
            $protocolo->save();
        }
        return "ok";

        $protocolos = ProtocoloVirtual::where('status_protocolo_id', 3)->get();

        foreach ($protocolos as $key => $protocolo) {
            $dt = Carbon::create($protocolo->updated_at->format('Y-m-d H:i:s'));
            $future = Carbon::now();
            $diff = $dt->diffInMinutes($future);
            //$diff = $dt->diffInDays($future);

            if ($diff >= 10) {
                $protocolo->status_protocolo_id = 5;
                $protocolo->delete();
            }
        }
        //return $diff;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // //Redireciona um novo usuário interno a atualizar a senha
        // $default_password = substr(Auth::user()->cpf ,0,-6);

        // if( Hash::check( $default_password, Auth::user()->password)) {
        //     return view('auth.passwords.welcome');
        // }

        if ($request->input('cpf')) {
            $request->merge([
                'cpf' => Helper::apenasNumeros($request->input('cpf')),
            ]);
        }

        if ($request->input('cpf_proprietario')) {
            $request->merge([
                'cpf_proprietario' => Helper::apenasNumeros($request->input('cpf_proprietario')),
            ]);
        }

        if ($request->input('cnpj')) {
            $request->merge([
                'cnpj' => Helper::apenasNumeros($request->input('cnpj')),
            ]);
        }

        $query = ProtocoloVirtual::query();

        if ($request->input('tipo_licenca')) {
            $query->where('tipo_licenca_id', '=', $request->tipo_licenca);
        }

        if ($request->input('cnpj')) {
            $query->where('cnpj', '=', $request->cnpj);
        }

        if ($request->input('cpf_proprietario')) {
            $query->where('cpf', '=', $request->cpf_proprietario);
        }

        if ($request->input('cpf')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('cpf', 'LIKE', '%' . $request->cpf . '%');
            });
        }

        $user_id = Auth::user()->id;
        $user_tipo = Auth::user()->tipo;
        $user_profile = Auth::user()->profile_id;
        $user_cpf = Auth::user()->cpf;

        // Tipos de Licencas
        $tiposLicencas = TipoLicenca::all()->sortBy('descricao');

        // $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id",$id)->first();


        if ($user_tipo == 1) {
            $protocolo_virtuais = $query->whereRaw("(user_id = $user_id OR (cpf = $user_cpf))")->orderBy('created_at', 'desc')->withTrashed()->paginate(10);
            // dd($protocolo_virtuais);

            for ($i = 0; $i < count($protocolo_virtuais); $i++) {
                $attachDocument = AttachDocuments::where('protocolo_id', $protocolo_virtuais[$i]->id)->get();
                $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id", $protocolo_virtuais[$i]->id)->first();
                $protocolo_virtuais[$i]->attachDocument = $attachDocument;
                if ($aprovacaoProtocolo) {
                    $protocolo_virtuais[$i]->aprovacaoProtocolo = $aprovacaoProtocolo->approved;
                } else {
                    $protocolo_virtuais[$i]->aprovacaoProtocolo = 0;
                }
            }
            return view('protocolo-virtual.index', [
                'protocolo_virtuais' => $protocolo_virtuais,
                'tiposLicencas' => $tiposLicencas,
                'request' => $request->all()
            ]);
        } else {
            $protocolo_virtuais = $query->orderBy('created_at', 'desc')->paginate(10);
            // dd($protocolo_virtuais['data']);
            for ($i = 0; $i < count($protocolo_virtuais); $i++) {
                $attachDocument = AttachDocuments::where('protocolo_id', $protocolo_virtuais[$i]->id)->get();
                $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id", $protocolo_virtuais[$i]->id)->first();
                $protocolo_virtuais[$i]->attachDocument = $attachDocument;
                if ($aprovacaoProtocolo) {
                    $protocolo_virtuais[$i]->aprovacaoProtocolo = $aprovacaoProtocolo->approved;
                } else {
                    $protocolo_virtuais[$i]->aprovacaoProtocolo = 0;
                }



                // if ($aprovacaoProtocolo) {
                //     $profile = DB::table('profile')->where('id',$user_profile)->first();
                //     // dd($aprovacaoProtocolo->approved);


                //     return view('protocolo-virtual.index', [
                //         'protocolo_virtuais' => $protocolo_virtuais,
                //         'tiposLicencas' => $tiposLicencas,
                //         'aprovacaoProtocolo' => $aprovacaoProtocolo->approved,
                //         'request' => $request->all()
                //     ]);

                // }
                // else {
                //     // $profile = DB::table('profile')->where('id',$user_profile)->first();
                //     // if ($profile->id == 1 || $profile->name == 'Presidente/Secretário') {
                //         return view('protocolo-virtual.index', [
                //             'protocolo_virtuais' => $protocolo_virtuais,
                //             'tiposLicencas' => $tiposLicencas,
                //             'aprovacaoProtocolo' => 0,
                //             'request' => $request->all()
                //         ]);

                //     // }
                // }


            }
            return view('protocolo-virtual.index', [
                'protocolo_virtuais' => $protocolo_virtuais,
                'tiposLicencas' => $tiposLicencas,
                // 'aprovacaoProtocolo' => $aprovacaoProtocolo->approved,
                'request' => $request->all()
            ]);
            // dd($protocolo_virtuais);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_licencas = TipoLicenca::all()->sortBy('descricao');
        $status_protocolos = StatusProtocolo::all()->sortBy('descricao');
        $status_confirmacoes = StatusConfirmacao::all()->sortBy('descricao');
        $user_id = Auth::user()->id;
        return view('protocolo-virtual.create', [
            'user_id' => $user_id,
            'tipo_licencas' => $tipo_licencas,
            'status_protocolos' => $status_protocolos,
            'status_confirmacoes' => $status_confirmacoes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user_tipo = Auth::user()->tipo;

        if ($user_tipo != 1) {
            $regras_status_protocolo_id = ['required'];
        } else {
            $regras_status_protocolo_id = [];
        }

        //dd($data);
        //Retira Mascara para Validação
        $telefone = Helper::apenasNumeros($data['telefone']);

        $data = array_replace($data, ['telefone' => $telefone]);

        //Regras PJ
        if ($request->input('licenca') == 'pj') {
            // $cpf = Helper::apenasNumeros($data['cpf']);
            $cnpj = Helper::apenasNumeros($data['cnpj']);

            // $data = array_replace($data, ['cpf' => $cpf]);
            $data = array_replace($data, ['cnpj' => $cnpj]);
            $data = array_replace($data, ['status_confirmacao_id' => '1']);

            $regras_pj = ['required', 'cnpj'];
            $regras_razao_social = ['required'];
            $regras_requerente = [];

            $regras_empreendimento = ['required'];
            $regras_cpf = [];
        } else {
            //Regras PF


            $regras_pj = [];
            $regras_razao_social = [];
            $regras_requerente = ['required'];

            if ($request->input('requerente') == '1') {
                $regras_cpf = [];
                $regras_empreendimento = [];
                $data = array_replace($data, ['status_confirmacao_id' => '1']);
            } else {
                $cpf = Helper::apenasNumeros($data['cpf']);
                $data = array_replace($data, ['cpf' => $cpf]);

                $regras_cpf = ['required', 'cpf', 'exists:users'];
                $regras_empreendimento = ['required'];
            }
        }

        Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
            $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);
            if ($value == 1) {
                return true;
            } else {
                return false;
            }
        });
        $rules = [
            'licenca' => ['required'],
            'tipo_licenca_id' => ['required'],
            'empreendimento' => $regras_empreendimento,
            'cnpj' => $regras_pj,
            'razao_social' => $regras_razao_social,
            'cpf' => $regras_cpf,
            'cep' => ['required', 'formato_cep'],
            'endereco' => ['required'],
            'numero' => ['required', 'max:5'],
            'bairro' => ['required'],
            'municipio' => ['required'],
            'uf' => ['required'],
            'telefone' => ['required', 'min:10'],
            'email' => ['required', 'mail'],
            'requerente' => $regras_requerente,
            'status_protocolo_id' => $regras_status_protocolo_id,
            'descricao' => ['required', 'min:10'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
            'email.mail' => 'Digite um e-mail válido',

            'telefone.min' => 'O campo telefone precisa de no mínimo 10 caracteres',
            'cep.formato_cep' => 'Digite um cep válido.',

            'cpf.exists' => 'Usuário não cadastrado',
            'cpf.cpf' => 'CPF Inválido.Por favor, preencha novamente.',
            'descricao.min' => 'O campo descrição precisa de no mínimo 10 caracteres',
            'numero.max' => 'O campo número suporta no máximo 5 caracteres',

        ];

        Validator::make($data, $rules, $messages)->validate();

        //Colocar mascara telefone para inserir no banco
        $data = array_replace($data, ['telefone' => Helper::telefone($data['telefone'])]);
        $user_id = Hashids::decode($data['user_id']);
        $data = array_replace($data, ['user_id' => $user_id[0]]);

        $protocoloVirtual = $this->protocoloVirtual->create($data);

        // Dispatching Event
        event(new CreatedProtocolo($protocoloVirtual));

        if ($protocoloVirtual->licenca == 'pf' && $protocoloVirtual->requerente == 0) {
            return redirect()->route('protocolo-virtual.index')->with("record_added", 'Protocolo registrado!');
        } else {
            return redirect()->route('getAttachDocument', $protocoloVirtual->id)->with("record_added", 'Protocolo registrado!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProtocoloVirtual  $protocoloVirtual
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(Helper::mask('12345678910111', '##.###.###/####-##'));
        $id = Hashids::decode($id);
        $protocolo_virtuais = $this->protocoloVirtual->withTrashed()->find($id[0]);
        return view('protocolo-virtual.show', ['protocolo_virtual' => $protocolo_virtuais]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProtocoloVirtual  $protocoloVirtual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $id = Hashids::decode($id);
        $protocoloVirtual = $this->protocoloVirtual->find($id[0]);
        //$protocoloVirtual = ProtocoloVirtual::find($protocoloVirtual);

        if ($protocoloVirtual === null) {
            return redirect()->route('protocolo-virtual.index');
        }

        $tipo_licencas = TipoLicenca::all()->sortBy('descricao');
        $status_protocolos = StatusProtocolo::all()->sortBy('descricao');
        $status_confirmacoes = StatusConfirmacao::all()->sortBy('descricao');
        $user_id = Auth::user()->id;

        return view('protocolo-virtual.edit', [
            'user_id' => $user_id,
            'tipo_licencas' => $tipo_licencas,
            'protocoloVirtual' => $protocoloVirtual,
            'status_protocolos' => $status_protocolos,
            'status_confirmacoes' => $status_confirmacoes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProtocoloVirtual  $protocoloVirtual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        //dd($data);
        $user_tipo = Auth::user()->tipo;

        if ($user_tipo != 1) {
            $regras_status_protocolo_id = ['required'];
        } else {
            $regras_status_protocolo_id = [];
        }

        //Retira Mascara para Validação
        $telefone = Helper::apenasNumeros($data['telefone']);

        $data = array_replace($data, ['telefone' => $telefone]);

        //Regras PJ
        if ($request->input('licenca') == 'pj') {
            $cpf = Helper::apenasNumeros($data['cpf']);
            $cnpj = Helper::apenasNumeros($data['cnpj']);

            $data = array_replace($data, ['cpf' => $cpf]);
            $data = array_replace($data, ['cnpj' => $cnpj]);
            $data = array_replace($data, ['status_confirmacao_id' => '1']);

            $regras_pj = ['required', 'cnpj'];
            $regras_razao_social = ['required'];
            $regras_requerente = [];

            $regras_empreendimento = ['required'];
            $regras_cpf = [];
        } else {
            //Regras PF
            $regras_pj = [];
            $regras_razao_social = [];
            $regras_requerente = ['required'];

            if ($request->input('requerente') == '1') {
                $regras_cpf = [];
                $regras_empreendimento = [];
                $data = array_replace($data, ['status_confirmacao_id' => '1']);
            } else {
                $cpf = Helper::apenasNumeros($data['cpf']);
                $data = array_replace($data, ['cpf' => $cpf]);

                $regras_cpf = ['required', 'cpf', 'exists:users'];
                $regras_empreendimento = ['required'];
            }
        }

        Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
            $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);
            if ($value == 1) {
                return true;
            } else {
                return false;
            }
        });
        $rules = [
            'licenca' => ['required'],
            'tipo_licenca_id' => ['required'],
            'empreendimento' => $regras_empreendimento,
            'cnpj' => $regras_pj,
            'razao_social' => $regras_razao_social,
            'cpf' => $regras_cpf,
            'cep' => ['required', 'formato_cep'],
            'endereco' => ['required'],
            'numero' => ['required', 'max:5'],
            'bairro' => ['required'],
            'municipio' => ['required'],
            'uf' => ['required'],
            'telefone' => ['required', 'min:10'],
            'email' => ['required', 'mail'],
            'requerente' => $regras_requerente,
            'status_protocolo_id' => $regras_status_protocolo_id,
            'descricao' => ['required', 'min:10'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
            'email.mail' => 'Digite um e-mail válido',

            'telefone.min' => 'O campo telefone precisa de no mínimo 10 caracteres',
            'cep.formato_cep' => 'Digite um cep válido.',

            'cpf.exists' => 'Usuário não cadastrado',
            'cpf.cpf' => 'CPF Inválido.Por favor, preencha novamente.',
            'descricao.min' => 'O campo descrição precisa de no mínimo 10 caracteres',
            'numero.max' => 'O campo número suporta no máximo 5 caracteres',

        ];

        Validator::make($data, $rules, $messages)->validate();

        //Colocar mascara telefone para inserir no banco
        $data = array_replace($data, ['telefone' => Helper::telefone($data['telefone'])]);
        $user_id = Hashids::decode($data['user_id']);
        $data = array_replace($data, ['user_id' => $user_id[0]]);

        $id_user = Hashids::decode($id);
        $protocoloVirtual = $this->protocoloVirtual->find($id_user[0]);
        $protocoloVirtual->update($data);

        // Session::flash('message', 'Dados atualizados!');

        return redirect()->route('protocolo-virtual.index', [
            'protocolo_virtual' => $id,
        ])->with("record_added", 'Protocolo alterado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProtocoloVirtual  $protocoloVirtual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::decode($id);
        $protocoloVirtual = $this->protocoloVirtual->find($id[0]);
        $protocoloVirtual->status_protocolo_id = 5;
        $protocoloVirtual->save();
        $protocoloVirtual->delete();

        return redirect()->route('protocolo-virtual.index');
    }

    public function listar(Request $request)
    {
        $user_id = Auth::user()->id;
        $protocolo_virtuais = ProtocoloVirtual::where('user_id', $user_id)->paginate(3);
        //dd($protocolo_virtuais);
        return view('protocolo-virtual.listar', ['protocolo_virtuais' => $protocolo_virtuais, 'request' => $request->all()]);
    }

    public function listarArquivados(Request $request)
    {

        $query = ProtocoloVirtual::query();

        if ($request->input('cpf')) {
            $request->merge([
                'cpf' => Helper::apenasNumeros($request->input('cpf')),
            ]);
        }

        $query = ProtocoloVirtual::query();

        if ($request->has('licenca')) {
            $query->where('licenca', 'LIKE', '%' . $request->licenca . '%');
        }

        if ($request->has('cpf')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('cpf', 'LIKE', '%' . $request->cpf . '%');
            });
        }


        $protocolo_virtuais = $query->onlyTrashed()->paginate(10);
        return view('protocolo-virtual.listar-arquivados', [
            'protocolo_virtuais' => $protocolo_virtuais,
            'request' => $request->all()
        ]);
    }

    public function restore($id)
    {
        $id = Hashids::decode($id);
        $protocoloVirtual = ProtocoloVirtual::withTrashed()->where('id', $id[0])->first();

        $protocoloVirtual->status_protocolo_id = 1;
        $protocoloVirtual->save();
        $protocoloVirtual->restore();

        return redirect()->route('protocolo-virtual.index')->with("record_added", 'Protocolo n° CXA000' . $id[0] . ' Desarquivado!');;
        //return redirect()->route('protocolo-virtual.arquivados')->with("record_added", 'Protocolo n° CXA000' . $id[0] .' arquivado!');;
    }


    public function getProtocolo($id)
    {
        $user = Auth::user();
        $protocolo_virtuais = ProtocoloVirtual::where('id', $id)->first();



        $attachDocuments = AttachDocuments::join('documents', 'attach_documents.documents_id', '=', 'documents.id')->where('attach_documents.protocolo_id', $id)->get()->toArray();
        $documents = Documents::where('licenca_id', $protocolo_virtuais->tipo_licenca_id)->get()->toArray();
        $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id", $id)->first();
        $documentsAvaliados = [];
        $documentosValidos = 0;
        $message = null;
        $tmpArray = [];
        $file = [];
        $tmpFile = [];
        // $file = Storage::allFiles("public/documentos");
        // $pathToFile = "documentos\public";
        // dd(response()->file("public/documentos/ajustes.pdf"));
        // dd($attachDocuments);
        // return response()->file($pathToFile);

        // return response()->file($pathToFile, $headers);
        // dd($attachDocuments);
        if ($protocolo_virtuais) {
            $documents = array_filter($documents, function ($item) {
                return $item['required'] == 1;
            });

            // dd($documents);
            // $protocolo_virtuais->attachDocument = array_merge($attachDocuments,$documents);
            $protocolo_virtuais->attachDocument = $attachDocuments;
            // dd($protocolo_virtuais);
        } else {
            $protocolo_virtuais->attachDocument = Documents::where('licenca_id', $protocolo_virtuais->tipo_licenca_id)->get();
        }

        // Se o cara não anexar o documento, ainda sim mostrar ?
        // dd($protocolo_virtuais);



        for ($i = 0; $i < count($protocolo_virtuais->attachDocument); $i++) {
            if ($protocolo_virtuais->attachDocument[$i]['required'] == 1 && @$protocolo_virtuais->attachDocument[$i]['file']) {
                $documentosValidos++;
            }



            if (@$protocolo_virtuais->attachDocument[$i]['documents_id']) {

                // $documentsAvaliados[$i] = DB::table('historico_protocolo')
                //                             ->select('historico_protocolo.approved_document','historico_protocolo.user_id','historico_protocolo.note_document')
                //                             ->join('users','users.id','=','historico_protocolo.user_id')
                //                             ->where('historico_protocolo.protocolo_id',$id)
                //                             // ->where('user_id',$user->id)
                //                             ->where('users.profile_id',$user->profile_id)
                //                             ->where('historico_protocolo.document_id',$protocolo_virtuais->attachDocument[$i]['documents_id'])
                //                             ->first();


                $documentsAvaliados[$i] = DB::table('relato_protocolo')
                    ->select('relato_protocolo.approved_document', 'relato_protocolo.profile_id', 'relato_protocolo.note_document')
                    ->join('profile', 'profile.id', '=', 'relato_protocolo.profile_id')
                    ->where('relato_protocolo.protocolo_id', $id)
                    // ->where('user_id',$user->id)
                    ->where('profile.id', $user->profile_id)
                    ->where('relato_protocolo.document_id', $protocolo_virtuais->attachDocument[$i]['documents_id'])
                    ->first();


                // dd($documentsAvaliados[$i]);
                if ((@$documentsAvaliados[$i]) && ($user->profile_id == 2) && (@$aprovacaoProtocolo->approved != 3)) {
                    $tmpArray[$i] = $protocolo_virtuais->attachDocument[$i];
                    $tmpArray[$i]['approved_document'] = $documentsAvaliados[$i]->approved_document;
                    $tmpArray[$i]['profile_id'] = $documentsAvaliados[$i]->profile_id;
                    $tmpArray[$i]['note_document'] = $documentsAvaliados[$i]->note_document;
                } else if ((@$documentsAvaliados[$i]) && ($user->profile_id == 1) && (@$aprovacaoProtocolo->approved != 6)) {
                    $tmpArray[$i] = $protocolo_virtuais->attachDocument[$i];
                    $tmpArray[$i]['approved_document'] = $documentsAvaliados[$i]->approved_document;
                    $tmpArray[$i]['profile_id'] = $documentsAvaliados[$i]->profile_id;
                    $tmpArray[$i]['note_document'] = $documentsAvaliados[$i]->note_document;
                } else if ((@$documentsAvaliados[$i]) && ($user->profile_id != 2) && ($user->profile_id != 1)) {
                    $tmpArray[$i] = $protocolo_virtuais->attachDocument[$i];
                    $tmpArray[$i]['approved_document'] = $documentsAvaliados[$i]->approved_document;
                    $tmpArray[$i]['profile_id'] = $documentsAvaliados[$i]->profile_id;
                    $tmpArray[$i]['note_document'] = $documentsAvaliados[$i]->note_document;
                }
            }
        }
        // dd($tmpArray);
        if (!empty($tmpArray)) {

            // $hasHistoryProtocol = DB::table('historico_protocolo')->where("protocolo_id",$id)->get()->toArray();

            if (count($attachDocuments)) {
                $attachDocuments = array_filter($attachDocuments, function ($item) use ($tmpArray) {
                    // dd($tmpArray);
                    return !in_array($item['documents_id'], array_column($tmpArray, 'documents_id'));
                });

                $protocolo_virtuais->attachDocument =  array_merge($tmpArray, $attachDocuments);
            }

            // $protocolo_virtuais->attachDocument = $tmpArray;


        }

        // if (!empty($tmpFile)) {
        //     $protocolo_virtuais->attachDocument = $tmpFile;

        // }

        // dd(count($documents), $documentosValidos);

        if (count($documents) > $documentosValidos) {
            $message = "O requerente ainda não preencheu todos os anexos obrigatórios";
        }

        // dd($protocolo_virtuais);
        $html = view('protocolo-virtual._components.detalhes')->with(compact('protocolo_virtuais', 'message'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function exportarPDF($id)
    {
        //$protocolo_virtuais = ProtocoloVirtual::find($id);
        $id = Hashids::decode($id);
        $protocolo_virtuais = $this->protocoloVirtual->find($id[0]);

        if (!empty($protocolo_virtuais)) {

            $protocolo_virtuais->licenca_gerada = 1;
            $protocolo_virtuais->save();

            $url = request()->url() . "?download";
            $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($url));

            //$protocolo_virtuais->tipo_licenca_id = 2;
            $view = 'protocolo-virtual.licenca-pdf.' . $protocolo_virtuais->tipo_licenca_id;

            if (View::exists($view)) {

                $pdf = PDF::loadView('protocolo-virtual.licenca-pdf.template-pdf', compact('protocolo_virtuais', 'qrcode'));

                if (isset($_GET['download'])) {
                    return $pdf->download($protocolo_virtuais->tipo_licenca_id . '.pdf');
                } else {
                    return $pdf->stream($protocolo_virtuais->tipo_licenca_id . '.pdf');
                }
            } else {
                $pdf = PDF::loadView('protocolo-virtual.licenca-pdf.licenca', compact('protocolo_virtuais', 'qrcode'));
                return $pdf->stream('licenca.pdf');
            }
        } else {
            return redirect()->route('protocolo-virtual.index');
        }
    }

    public function authorizeProtocol(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->all();
        $validado = true;

        unset($data['_token']);

        $pegaId = [];
        $pegaResult = [];
        // dd($data);
        // if ($id == count($dados)) {
        for ($i = 0; $i < count($data); $i++) {
            if (isset($data[$i])) {
                $pegaId[$i] = explode('-', $data[$i]);


                if ($pegaId[$i][1] == 'true') {
                    // $hasDocuments = DB::table('historico_protocolo')->where("protocolo_id",$id)->where('document_id',$pegaId[$i][0])->where('user_id',$user->id)->first();
                    $hasDocuments = DB::table('relato_protocolo')->where("protocolo_id", $id)->where('document_id', $pegaId[$i][0])->where('profile_id', $user->profile_id)->first();
                    if ($hasDocuments) {
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->where('document_id',$pegaId[$i][0])->update(['approved_document' => 1]);
                        DB::table('relato_protocolo')->where('protocolo_id', $id)->where('document_id', $pegaId[$i][0])->update(['approved_document' => 1]);
                    } else {
                        // DB::table('historico_protocolo')->insert(['approved_document' => 1, 'protocolo_id' => $id, 'document_id' => $pegaId[$i][0], 'user_id' => $user->id, 'approved_procotolo' => 0]);
                        DB::table('relato_protocolo')->insert(['approved_document' => 1, 'protocolo_id' => $id, 'document_id' => $pegaId[$i][0], 'profile_id' => $user->profile_id, 'approved_procotolo' => 0]);
                    }
                } else if ($pegaId[$i][1] == 'false') {
                    // $hasDocuments = DB::table('historico_protocolo')->where("protocolo_id",$id)->where('document_id',$pegaId[$i][0])->where('user_id',$user->id)->first();
                    $hasDocuments = DB::table('relato_protocolo')->where("protocolo_id", $id)->where('document_id', $pegaId[$i][0])->where('profile_id', $user->profile_id)->first();
                    if ($hasDocuments) {
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->where('document_id',$pegaId[$i][0])->update(['approved_document' => 2, 'note_document' => $data['note_document-'.$i]]);
                        DB::table('relato_protocolo')->where('protocolo_id', $id)->where('document_id', $pegaId[$i][0])->update(['approved_document' => 2, 'note_document' => $data['note_document-' . $i]]);
                    } else {
                        // dd($data["note_document-$i"], $data['note_document-'.$i]);
                        // DB::table('historico_protocolo')->insert(['approved_document' => 2, 'protocolo_id' => $id, 'document_id' => $pegaId[$i][0], 'user_id' => $user->id, 'approved_procotolo' => 0, 'note_document' => $data['note_document-'.$i]]);
                        DB::table('relato_protocolo')->insert(['approved_document' => 2, 'protocolo_id' => $id, 'document_id' => $pegaId[$i][0], 'profile_id' => $user->profile_id, 'approved_procotolo' => 0, 'note_document' => $data['note_document-' . $i]]);
                    }
                    // ProtocoloVirtual::where('id',$pegaId[$i][0])->update(['status_confirmacao_id' => 2]);
                }
            }
        }
        // }
        // else {
        //     $message = "Você não marcou todos os protocolos!";
        // }

        $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id", $id)->first();
        // $historyProtocol = DB::table('historico_protocolo')->where("protocolo_id",$id)->get();
        $historyProtocol = DB::table('relato_protocolo')->where("protocolo_id", $id)->get();

        // dd($aprovacaoProtocolo);
        if ($aprovacaoProtocolo) {
            if ($aprovacaoProtocolo->approved != 8) {
                if ((($aprovacaoProtocolo->approved == 0) || ($aprovacaoProtocolo->approved == 6) || ($aprovacaoProtocolo->approved == 7))) {
                    for ($i = 0; $i < count($historyProtocol); $i++) {
                        if ($historyProtocol[$i]->approved_document == 2) {
                            $validado = false;
                            DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                        }
                    }
                    if ($validado) {
                        if ($aprovacaoProtocolo->approved == 0) {
                            // DB::table('aprovacao_cargo')->insert(['cargo' => 'presidente/secretario', 'protocolo_id' => $id, 'approved' => 1]);
                            DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'presidente/secretario', 'protocolo_id' => $id, 'approved' => 1]);
                            // $aprovacaoProtocolo->approved = 1;
                        }
                        if ($aprovacaoProtocolo->approved == 6) {
                            DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'presidente/secretario', 'protocolo_id' => $id, 'approved' => 7]);
                            // $aprovacaoProtocolo->approved = 7;
                            ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 6]);
                        }

                        if ($aprovacaoProtocolo->approved == 7) {
                            DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'presidente/secretario', 'protocolo_id' => $id, 'approved' => 8]);

                            $protocoloVirtual = $this->protocoloVirtual->find($id);
                            $protocoloVirtual->update(['status_protocolo_id' => 6]);
                            //Dispara email caso seja liberada a licença
                            if (!empty($protocoloVirtual->cpf)) {
                                $user = User::where('cpf', $protocoloVirtual->cpf)->first();
                                Mail::to($user->email)->send(new SendMailProtocoloVirtual($protocoloVirtual, $user->name));
                                Mail::to($protocoloVirtual->user->email)->send(new SendMailProtocoloVirtual($protocoloVirtual));
                            } else {
                                Mail::to($protocoloVirtual->user->email)->send(new SendMailProtocoloVirtual($protocoloVirtual));
                            }
                        }
                    } else {
                        ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->delete();
                    }
                } else if ((($aprovacaoProtocolo->approved == 1) || ($aprovacaoProtocolo->approved == 3))) {

                    for ($i = 0; $i < count($historyProtocol); $i++) {
                        if ($historyProtocol[$i]->approved_document == 2) {
                            $validado = false;
                            DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                        }
                    }

                    if ($validado) {
                        if ($aprovacaoProtocolo->approved == 1) {
                            // DB::table('aprovacao_cargo')->insert(['cargo' => 'gerente', 'protocolo_id' => $id, 'approved' => 2]);
                            DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'gerente', 'protocolo_id' => $id, 'approved' => 2]);

                            // $aprovacaoProtocolo->approved = 2
                        }
                        if ($aprovacaoProtocolo->approved == 3) {
                            // DB::table('aprovacao_cargo')->insert(['cargo' => 'gerente', 'protocolo_id' => $id, 'approved' => 4]);
                            DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'gerente', 'protocolo_id' => $id, 'approved' => 4]);

                            // $aprovacaoProtocolo->approved = 4;
                        }
                    } else {
                        ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->delete();
                    }
                } else if (($aprovacaoProtocolo->approved == 2)) {

                    for ($i = 0; $i < count($historyProtocol); $i++) {
                        if ($historyProtocol[$i]->approved_document == 2) {
                            $validado = false;
                            DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                        }
                    }

                    if ($validado) {
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'analista', 'protocolo_id' => $id, 'approved' => 3]);

                        // $aprovacaoProtocolo->approved = 3;
                    } else {
                        ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->delete();
                    }
                } else if (($aprovacaoProtocolo->approved == 4)) {
                    for ($i = 0; $i < count($historyProtocol); $i++) {
                        if ($historyProtocol[$i]->approved_document == 2) {
                            $validado = false;
                            DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                        }
                    }

                    if ($validado) {
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'coordenador', 'protocolo_id' => $id, 'approved' => 5]);
                        // $aprovacaoProtocolo->approved = 5;
                    } else {
                        ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->delete();
                    }
                } else if (($aprovacaoProtocolo->approved == 5)) {

                    for ($i = 0; $i < count($historyProtocol); $i++) {
                        if ($historyProtocol[$i]->approved_document == 2) {
                            $validado = false;
                            DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                        }
                    }

                    if ($validado) {
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->update(['cargo' => 'diretor', 'protocolo_id' => $id, 'approved' => 6]);

                        // $aprovacaoProtocolo->approved = 6;
                    } else {
                        ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                        // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
                        DB::table('aprovacao_cargo')->where('id', $aprovacaoProtocolo->id)->delete();
                    }
                }
            }
        } else {

            for ($i = 0; $i < count($historyProtocol); $i++) {
                if ($historyProtocol[$i]->approved_document == 2 && $historyProtocol[$i]->protocolo_id == $id) {
                    $validado = false;
                    DB::table('attach_documents')->where('protocolo_id', $id)->where('documents_id', $historyProtocol[$i]->document_id)->delete();
                }
            }

            if ($validado) {
                DB::table('aprovacao_cargo')->insert(['cargo' => 'presidente/secretario', 'protocolo_id' => $id, 'approved' => 1]);
                ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 2]);
            } else {
                ProtocoloVirtual::where('id', $id)->update(['status_protocolo_id' => 3]);
                // DB::table('historico_protocolo')->where('protocolo_id',$id)->delete();
            }
        }

        // $tiposLicencas = TipoLicenca::all()->sortBy('descricao');
        // // $protocolo_virtuais = ProtocoloVirtual::paginate(10);
        // // for ($i=0; $i < count($protocolo_virtuais) ; $i++) {
        // //     $aprovacaoProtocolo = DB::table('aprovacao_cargo')->where("protocolo_id",$protocolo_virtuais[$i]->id)->first();

        // //     if ($aprovacaoProtocolo) {
        // //         $protocolo_virtuais[$i]->aprovacaoProtocolo = $aprovacaoProtocolo->approved;
        // //     }
        // //     else {
        // //         $protocolo_virtuais[$i]->aprovacaoProtocolo = 0;
        // //     }
        // // }

        // dd($aprovacaoProtocolo->approved);
        // return view('protocolo-virtual.index', [
        //     'protocolo_virtuais' => $protocolo_virtuais,
        //     'tiposLicencas' => $tiposLicencas,
        //     // 'aprovacaoProtocolo' => $aprovacaoProtocolo ? $aprovacaoProtocolo->approved : 0,
        //     'request' => $request->all()
        // ]);
        $statusProcoloVirtual = ProtocoloVirtual::where('status_protocolo_id', 3)->where('id', $id)->first();
        if ($statusProcoloVirtual) {
            return redirect()->route('protocolo-virtual.index')->with("record_added", 'Protocolo reprovado.');
        } else {
            return redirect()->route('protocolo-virtual.index')->with("record_added", 'Protocolo aprovado.');
        }
    }

    // public function createPDF(Request $request)
    // {

    //     $data = 'www.google.com';
    //     $protocolo_virtuais = $this->protocoloVirtual->find(18);

    //     $pdf = new FPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial','B',16);
    //     $pdf->Image('./img/geral/licenca.png',10,10,-350);
    //     $pdf->Ln(45);
    //     $pdf->Cell(80,10, utf8_decode($protocolo_virtuais->tipoLicenca->descricao),1,0,'L');
    //     $pdf->Cell(40,10, utf8_decode('Nº Da Licença'),1,0,'L');
    //     $pdf->Cell(35,10, utf8_decode('PROCESSO'),1,0,'L');
    //     $pdf->Cell(35,10, utf8_decode('VALIDADE'),1,0,'L');

    //     // QRcode::png("coded number here","test.png");

    //     // $pdf->Image((new QRCode)->render($data), 10, 10, 40, 40, "png");


    //     $pdf->Output();
    //     exit;
    // }

    public function buscaLicenca($id)
    {

        $id = substr($id, 3);
        $query = ProtocoloVirtual::query();
        $protocolo_virtuais = $query->where('licenca_gerada', 1)->find($id);

        if (!empty($protocolo_virtuais)) {
            $id = Hashids::encode($id);
            $html = view('protocolo-virtual.partials.qr_code_licenca')->with(compact('id'))->render();
            return response()->json(['licenca' => true, 'html' => $html]);
        } else {
            $html = "Protocolo Nao Encontrado";
            return response()->json(['licenca' => false, 'html' => $html]);
        }
    }
    /* 
        author: Rafael Morais
        Description: Amazenar licenca do protocolo em uma pasta local
    */
    public function attachLicense(Request $request)
    {

        $rules = [
            'license' => ['required', 'file', 'mimes:pdf'],
        ];

        $messages = [
            'license.required' => 'O campo precisa ser preenchido.',
            'license.file' => 'A licença precisa ser um arquivo.',
            'license.mimes' => 'A licença precisa está na extensão PDF.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $license = $request->file('license');
        $path = $license->store('license', 'public');

        $protocol = $this->protocoloVirtual->find($request->protocol_id);

        //Remove old file and insert a new one
        if($protocol->license){
            Storage::disk('public')->delete($protocol->license);
        }

        $protocol->license = $path;
        $protocol->save();

        Session::flash('record_added', 'Licença anexada com sucesso!!');
        return response()->json(['success' => 'License attached successfully']);

    }

}
