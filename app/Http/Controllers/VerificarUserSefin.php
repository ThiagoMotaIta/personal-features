<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VerificarUserSefin extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {   
        // if (Auth::check()) {
        //     return redirect()->route('protocolo-virtual.index');
        // }
        return view('pesquisa-sefin');
    }

    public function pesquisar(Request $request)
    {

        if($request->cpf){
            $cpf = Helper::apenasNumeros($request->cpf);

            $rules = [
                'cpf' => ['required', 'cpf'],
            ];

            $messages = [
                'required' => 'O campo precisa ser preenchido',
                'cpf.cpf' => 'CPF Inválido. Por favor, preencha novamente.',
            ];

            //$validated = $request->validate($rules, $messages);
            //Validator::make($request->all(), $rules, $messages)->validateWithBag('login');
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return   back()->withErrors($validator, 'login')->withInput();
            }


            $user = User::where('cpf', '=', $cpf)->first();

            //Verificar se está na sefin
            if(true){
                if ($user === null) {
                    //return redirect()->route('register');
                    return view('auth.register', ['cpf' => $cpf]);
                }else{
                    return redirect()->route('login', ['cpf' => $user->cpf, 'email' => $user->email] );
                }
            }else{
                return redirect('https://www.sefin.fortaleza.ce.gov.br/');
            }
        }

        return view('auth.register');

    }

}
