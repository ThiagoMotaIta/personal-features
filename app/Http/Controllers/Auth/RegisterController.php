<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Helper;
use App\Models\Password;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        //dd($data['telefone']);
        $cpf = Helper::apenasNumeros($data['cpf']);
        $telefone = Helper::apenasNumeros($data['telefone']);
        $mail = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $data['email']);

        //Retira a mascara para o validador unique funcionar
        $data = array_replace($data, ['cpf' => $cpf]);
        $data = array_replace($data, ['telefone' => $telefone]);
 //dd($data['telefone']);

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
            'name' => ['required', 'min:5', 'max:60'],
            'email' => ['required', 'max:80', 'unique:users', 'mail'],
            'cpf' => ['required', 'unique:users', 'cpf'],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],       
           // 'cep' => ['formato_cep'],
            'endereco' => ['required', 'min:4' ],
            'bairro' => ['required', 'min:4' ],
            'cidade' => ['required', 'min:4' ],
            'uf' => ['required'],
            'telefone' => ['required', 'min:10'],
            'numero' => ['required', 'max:5'],
        ];

        $messages = [
            'required' => 'O campo precisa ser preenchido',

            'name.min' => 'O campo nome precisa de no mínimo 5 caracteres',
            'name.max' => 'O campo nome suporta no máximo 60 caracteres',
            'email.mail' => 'Digite um e-mail válido',
            'email.max' => 'O campo nome suporta no máximo 80 caracteres',
            'email.unique' => 'Esse E-mail já está sendo utilizado',
            'cpf.unique' => 'O campo :attribute já está sendo utilizado',
            'cpf.cpf' => 'CPF Inválido. Por favor, preencha novamente.',
            
            'password.min' => 'O campo senha precisa de no mínimo 8 caracteres',
            'password.confirmed' => 'O campo confirmar senha precisar combinar com o campo senha',
            'password.regex' => ' O campo senha precisa ter letras minúsculas e maiúsculas, números e caracteres especiais',
           // 'cep.formato_cep' => 'Digite um cep válido.',
            'endereco.min' => 'O campo endereço precisa de no mínimo 4 caracteres',
            'bairro.min' => 'O campo bairro precisa de no mínimo 4 caracteres',
            'cidade.min' => 'O campo cidade precisa de no mínimo 4 caracteres',
            'telefone.min' => 'O campo telefone precisa de no mínimo 10 caracteres',
            'numero.numeric' => 'Apenas números',
            'numero.max' => 'O campo número suporta no máximo 5 caracteres',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        //Colocar mascara no telefone
        $telefone = Helper::apenasNumeros($data['telefone']);
        $telefone = Helper::telefone($telefone);

       

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => Helper::apenasNumeros($data['cpf']),
            'tipo' => 1,
            'password' => Hash::make($data['password']),
            'permissoes' => '1',
            'profile_id' => '6',
            'telefone' => $telefone,
            'cep' => $data['cep'],
            'endereco' => $data['endereco'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
        ]);


        // inserindo a senha informada na tabela de senhas
        // inserindo cpf como um id para as senhas do usuário
        $chaveCpf = Helper::apenasNumeros($data['cpf']);
        $hashPassword =  Hash::make($data['password']);            
        Password::create(['cpf' => $chaveCpf, 'password' => $hashPassword]);

        return $user;
        

    }

    protected function apenasNumeros($var)
    {
        return preg_replace('/[^0-9]/', '', $var);
    }

    protected function telefone($number){
        $number="(".substr($number,0,2).") ".substr($number,2,-4)."-".substr($number,-4);
        // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
        return $number;
    }

    
}
