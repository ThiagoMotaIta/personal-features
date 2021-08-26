<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ProtocoloVirtual;
use App\Models\TipoLicenca;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailApplicantConfirmation;


class ConfirmResponsibilityController extends Controller
{
   
    public function show($id=null) {

        $user = Auth::user();
        // dd($user);

        $editing = false;
        if (isset($_GET['editing'])) {
            $editing = true;
        }



        $protocoloVirtuais = ProtocoloVirtual::where('status_confirmacao_id',0)->where('cpf',$user->cpf)->paginate(50);
        for ($i=0; $i < count($protocoloVirtuais) ; $i++) {
            $tipoLicenca = TipoLicenca::where('id',$protocoloVirtuais[$i]->tipo_licenca_id)->first();
            $userReque = User::where('id',$protocoloVirtuais[$i]->user_id)->first();
            // $tipoLicenca = DB::table('tipo_licencas')->where('id',$protocoloVirtuais[$i]->tipo_licenca_id)->first();

            $protocoloVirtuais[$i]->tipoLicenca = $tipoLicenca;
            $protocoloVirtuais[$i]->userRequerente = $userReque;
        }
        // dd($protocoloVirtuais);
        return view('confirm-responsibility',["protocoloVirtuais" => $protocoloVirtuais, "editing" => $editing]);
    }


    public function store(request $request,$id=null) {

        $user = Auth::user();
        $dados = $request->all();
        $message = null;


        unset($dados['_token']);
        unset($dados['markall']);

        $pegaId = [];
        $pegaResult = [];
        
        // if ($id == count($dados)) {
        foreach ($dados as $key => $value) {
        
            $pegaId = explode('-', $value);
            
            if ($pegaId[1] == 'true') {
                ProtocoloVirtual::where('id',$pegaId[0])->update(['status_confirmacao_id' => 1]);
                ProtocoloVirtual::where('id',$pegaId[0])->update(['status_protocolo_id' => 1]);
            }
            else {
                ProtocoloVirtual::where('id',$pegaId[0])->update(['status_confirmacao_id' => 2]);
                ProtocoloVirtual::where('id',$pegaId[0])->update(['status_protocolo_id' => 2]);
            }

            /* 
              Author: Rafael Morais
              Description: Enviar o email ao requerente do protocolo após o responsável autorizar ou não.
            */
            $ProtocoloVirtual = ProtocoloVirtual::find($pegaId[0]);
            Mail::to($ProtocoloVirtual->user->email)->send(new SendMailApplicantConfirmation($ProtocoloVirtual));

        }
      
        // }
        // else {
        //     $message = "Você não marcou todos os protocolos!";
        // }

        $protocoloVirtuais = ProtocoloVirtual::where('status_confirmacao_id',0)->where('cpf',$user->cpf)->paginate(50);


        for ($i=0; $i < count($protocoloVirtuais) ; $i++) {
            $tipoLicenca = TipoLicenca::where('id',$protocoloVirtuais[$i]->tipo_licenca_id)->first();
            $userReque = User::where('id',$protocoloVirtuais[$i]->user_id)->first();
            // $tipoLicenca = DB::table('tipo_licencas')->where('id',$protocoloVirtuais[$i]->tipo_licenca_id)->first();

            $protocoloVirtuais[$i]->tipoLicenca = $tipoLicenca;
            $protocoloVirtuais[$i]->userRequerente = $userReque;
        }
        
        return view('confirm-responsibility',["protocoloVirtuais" => $protocoloVirtuais, "message" => $message]);

    }


}
