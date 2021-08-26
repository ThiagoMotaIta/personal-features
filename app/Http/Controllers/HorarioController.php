<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;
use App\Models\Setor;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use Helper;
class HorarioController extends Controller
{   
    protected $horario;

    function __construct(Horario $horario)
    {   
        $this->horario = $horario;
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

        $query = $this->horario::query();

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
            $query->where('data', $data);
        }

        $horarios = $query->orderBy('data', 'desc')->paginate(10);
        $setores = Setor::all()->sortBy('descricao');
        $request = $request->all();
        return view('horario.index', compact('horarios', 'setores', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $setores = Setor::all()->sortBy('descricao');
        $user_id = Auth::user()->id;
        return view('horario.create', compact('user_id', 'setores'));
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

        $rules = [
            'setor_id' => ['required', 'exists:setores,id'],
            'data' => ['required'],
            'horarios' => ['required'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
            'horarios.required' => 'Preencha pelo menos 1 horário',
            'data.date_format' => 'Data Inválida',
            'setor_id.exists' => 'Setor não definido',
        ];
       
        Validator::make($request->all(), $rules, $messages )->validate();

        $datas = explode(",", $request->data);
        foreach ($datas as $data) {
            foreach ($request->horarios as $horario) {
                $id =  Hashids::decode($request->user_id);
                $this->horario->create([
                    'user_id' => $id[0],
                    'setor_id' => $request->setor_id,
                    'data' => $data,
                    'horario' => $horario,
                ]);
            }
        }
        
        return redirect()->route('horario.index')->with("record_added", 'Data e Hora registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $id = Hashids::decode($id);
        $horario = $this->horario->find($id[0]);

        $setores = Setor::all()->sortBy('descricao');
        $user_id = Auth::user()->id;
        return view('horario.edit', compact('user_id', 'setores', 'horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'setor_id' => ['required', 'exists:setores,id'],
            'data' => ['required', 'date_format:d-m-Y'],
            'horarios' => ['required'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',
            'horarios.required' => 'Preencha pelo menos 1 horário',
            'data.date_format' => 'Data Inválida',
            'setor_id.exists' => 'Setor não definido',
        ];

        Validator::make($request->all(), $rules, $messages )->validate();

        // foreach ($request->horarios as $horario) {
        //     $id =  Hashids::decode($request->user_id);
        //     $this->horario->create([
        //         'user_id' => $id[0],
        //         'setor_id' => $request->setor_id,
        //         'data' => $request->data,
        //         'horario' => $horario,
        //     ]);
        // }
        
        $id_user = Hashids::decode($id);
        $horario = $this->horario->find($id_user[0]);

        $id =  Hashids::decode($request->user_id);
        
        $result = $horario->update([
                'user_id' => $id[0],
                'setor_id' => $request->setor_id,
                'data' => $request->data,
                'horario' => $request->horarios,
        ]);
        
        return redirect()->route('horario.index')->with("record_added", 'Dados atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::decode($id);
        $horario = $this->horario->find($id[0]);
        $horario->delete();

        return redirect()->route('horario.index')->with("record_added", 'Horarios deletado!');
    }

    public function getDatas($id, $old = '')
    {   
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $horarios = Horario::where('setor_id', $id)
                            ->where('disponivel', 1)
                            ->where('data','>=', $date)->get();

        return response()->json(['success' => true, 'html' => $horarios]);
        
        // $html = view('atendimento-virtual.partials.horarios')->with(compact('horarios', 'old'))->render();
        // return response()->json(['success' => true, 'html' => $horarios]);
    }

    public function getHorarios($setor_id, $data_atend, $old='')
    {   
        $data_atend = explode('-',$data_atend);
        $data = $data_atend[2] . '-' . $data_atend[1] . '-' . $data_atend[0];
        //dd($old);
        $hora = Carbon::now();
        $data_att = Carbon::now();
        $hora = $hora->format('H:i:s');
        $data_att = $data_att->format('Y-m-d');
        if($data_att == $data ){
            $horarios = Horario::where('setor_id', $setor_id)
            ->where('disponivel', 1)
            ->where('horario', '>=', $hora)
            ->where('data','=', $data)->orderBy('horario')->get();
     }
        else{
            $horarios = Horario::where('setor_id', $setor_id)
            ->where('disponivel', 1)
            ->where('data','=', $data)->orderBy('horario')->get();
        }

        

        //return response()->json(['success' => true, 'html' => $horarios]);
        //dd("dfdfgfd");

        $html = view('atendimento-virtual.partials.horarios')->with(compact('horarios', 'old'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
}
