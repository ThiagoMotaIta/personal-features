<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Session;
use Helper;
use Illuminate\Queue\Middleware\RateLimited;
use App\Models\Password;
use Illuminate\Validation\Rule;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserController extends Controller
{
    // public function index()
    // {         
    //     $profile = DB::table('profile')
    //                  ->select('profile.name','profile.permission','profile.id')                                 
    //                  ->get();
    //     // dd($profile);
    //     return view('permission',["profileData" => $profile]);
    // }

    protected $user;

    function __construct(User $user)
    {
        // $this->middleware('auth');
        $this->user = $user;
    }


    public function getUser($id = null)
    {
        //Redireciona um novo usuário interno a atualizar a senha
        $default_password = substr(Auth::user()->cpf, 0, -6);

        $user = Auth::user();
        $users = (object) [
            "id"  => null,
            "name" => null,
            "email" => null,
            "cpf" => null,
            "profile_id" => null,
        ];
        $profile = null;
        $permissionUser = null;
        $editing = false;
        if (isset($_GET['editing'])) {
            $editing = true;
        }


        if ($id) {

            $users = DB::table('users')
                ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password')
                ->where('id', $id)
                ->first();





            // $profile->permission = json_decode($profile->permission);

            // if ($profile) {
            //     $permissionUser = $profile->permission;
            // }
            $editing = true;
        } else if (!$editing) {
            $users = DB::table('users')
                ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password')
                ->get();

            for ($i = 0; $i < count($users); $i++) {
                $profileUser = DB::table('profile')
                    ->select('name', 'id')
                    ->where('id', $users[$i]->profile_id)
                    ->first();

                $users[$i]->profile = $profileUser;
            }
        }

        $profile = DB::table('profile')
            ->select('profile.name', 'profile.id')
            ->get();

        // $permission = DB::table('permissions')
        //                 ->select('path','title')                          
        //                 ->get();


        // $permissionGeral = $permission;


        // for ($i=0; $i < count($permissionGeral); $i++) { 
        //     $aux[$i] = json_decode($permissionGeral[$i]->path);
        // }



        // if ($permissionUser) {
        //     $aux = array_filter($aux, function ($item) use ($permissionUser) {
        //         return !in_array($item->tag, array_column($permissionUser, 'tag'));
        //     });

        //     $permissionArray = array_merge($permissionUser,$aux);

        // }
        // else {
        //     $permissionArray = $aux;
        // }

        // dd($profile, $users);

        return view('user', ["user" => $user, "userData" => $users, "profiles" => $profile, "editing" => $editing]);
    }


    public function postUser(request $request, $id = null)
    {
        $request->all();
        $dados = $request->all();
        $editing = false;
        // $message = null;
        $profile = null;
        $mail = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $dados['email']);

        $users = DB::table('users')
            ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password');
        //    ->get()

        $rules = [
            'name' => ['required', 'min:5', 'max:60'],
            //'email' => ['required', $mail],
            'cpf' => ['required', 'cpf'],
            // 'cpf' => ['required', 'cpf', 'unique:users,cpf'],
            'profile_id' => ['required'],
        ];


        $cpf = Helper::apenasNumeros($dados['cpf']);
        $dados = array_replace($dados, ['cpf' => $cpf]);
        // dd($dados);


        if ($id) {
            Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
                $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);
                if ($value == 1) {
                    return true;
                } else {
                    return false;
                }
            });
            $rules += [
                'name' => ['required', 'min:5', 'max:60'],
                'email' => ['required', 'mail'],
                'cpf' => ['required', 'cpf'],
                // 'cpf' => ['required', 'cpf', 'unique:users,cpf'],
                'profile_id' => ['required'],
            ];

            $messages = [
                'required' => 'O campo precisa ser preenchido',
    
                'email.mail'=> 'Digite um e-mail válido',
                'name.min' => 'O campo nome precisa de no mínimo 5 caracteres',
                'name.max' => 'O campo nome suporta no máximo 60 caracteres',
                // 'email.max' => 'O campo nome suporta no máximo 80 caracteres',
                'cpf.cpf' => 'CPF Inválido. Por favor, preencha novamente.',

            ];

            Validator::make($dados, $rules, $messages)->validate();

            //dd($rules);

            DB::table("users")->where("users.id", $id)->update(['name' => $dados['name'], 'email' => $dados['email'], 'cpf' => Helper::apenasNumeros($dados['cpf']), 'profile_id' => $dados['profile_id']]);
            $users = DB::table('users')
                ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password')
                ->get();

            for ($i = 0; $i < count($users); $i++) {
                $profileUser = DB::table('profile')
                    ->select('name', 'id')
                    ->where('id', $users[$i]->profile_id)
                    ->first();

                $users[$i]->profile = $profileUser;
            }
        } else {


            Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
                $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);
                if ($value == 1) {
                    return true;
                } else {
                    return false;
                }
            });
            $rules = [
                'name' => ['required', 'min:5', 'max:60'],
                'email' => ['required', 'unique:users', 'mail'],
                'cpf' => ['required', 'cpf', 'unique:users'],
                // 'cpf' => ['required', 'cpf', 'unique:users,cpf'],
                'profile_id' => ['required'],
            ];

            $messages = [
                'required' => 'O campo precisa ser preenchido',
    
                'name.min' => 'O campo nome precisa de no mínimo 5 caracteres',
                'name.max' => 'O campo nome suporta no máximo 60 caracteres',
                'email.unique' => 'O campo de e-mail já está sendo utilizado',
                'email.mail' => 'Digite um e-mail válido',
                // 'email.max' => 'O campo nome suporta no máximo 80 caracteres',
                'cpf.unique' => 'O campo de CPF já está sendo utilizado',
                'cpf.cpf' => 'CPF Inválido. Por favor, preencha novamente.',

            ];

            Validator::make($dados, $rules, $messages)->validate();

            $usersEmail = $users->where('email', $dados['email'])->first();
            $usersCPF = $users->where('cpf', Helper::apenasNumeros($dados['cpf']))->first();

            $dados['password'] = substr(Helper::apenasNumeros($dados['cpf']), 0, -6);
            // dd($users, $dados);        
            if (!$usersEmail && !$usersCPF) {
                DB::table("users")->insert(['name' => $dados['name'], 'email' => $dados['email'], 'cpf' => Helper::apenasNumeros($dados['cpf']), 'profile_id' => $dados['profile_id'], "password" =>  Hash::make($dados['password']), "tipo" => "2", "permissoes" => "1"]);
                $editing = false;

                // inserindo a senha informada na tabela de senhas
                // inserindo cpf como um id para as senhas do usuário
                $chaveCpf = Helper::apenasNumeros($dados['cpf']);
                $hashPassword =  Hash::make($dados['password']);


                // inserindo a senha na tabela de senhas, usando o cpf como identificador
                Password::create(['cpf' => $chaveCpf, 'password' => $hashPassword]);


                $users = DB::table('users')
                    ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password')
                    ->get();

                for ($i = 0; $i < count($users); $i++) {
                    $profileUser = DB::table('profile')
                        ->select('name', 'id')
                        ->where('id', $users[$i]->profile_id)
                        ->first();

                    $users[$i]->profile = $profileUser;
                }

                // Session::flash('record_added', 'Dados atualizados!');
            }
            else {
                // $message = "Email e CPF já cadastrados";
                $editing = true;
                $users = (object) [
                    "id"  => null,
                    "name" => null,
                    "email" => null,
                    "cpf" => null,
                    "profile_id" => null,
                ];

                $profile = DB::table('profile')
                    ->select('profile.name', 'profile.id')
                    ->get();
            }
        }


        // dd(Validator::make($dados, $rules, $messages)->validate());

        // return $this->getUser($id);
        // return view('user',["userData" => $users, "editing" => $editing, "profiles" => $profile, "message" => $message]);




        if ($id) {
            return redirect()->route('getUser')->with('record_added', 'Usuário #' . $id . ' alterado!');
        } 
        else {
            return redirect()->route('getUser')->with('record_added', 'Usuário cadastrado!');
        }
    }

    public function deleteUser($id)
    {
        $editing = false;
        DB::table('users')->where('id', $id)->delete();

        $users = DB::table('users')
            ->select('id', 'name', 'cpf', 'email', 'profile_id', 'password')
            ->get();

        for ($i = 0; $i < count($users); $i++) {
            $profileUser = DB::table('profile')
                ->select('name', 'id')
                ->where('id', $users[$i]->profile_id)
                ->first();

            $users[$i]->profile = $profileUser;
        }
        
        return redirect()->route('getUser')->with('record_added', 'Usuário com id #' . $id . ' removido!');

        return redirect()->route('getUser')->with('record_added', 'Usuário com id #' . $id . ' removido com sucesso!');
    }


    public function editPassword($id)
    {
        $id = Hashids::decode($id);
        $user = $this->user->with('profile')->find($id[0]);

        return $user;
    }

    public function updatePassword(Request $request)
    {

        // recuperando o usuário em sessão
        $user = $this->user->find(Auth::id());

        // validator: 'checkHashedPass'
        // validação se a senha escrita é igual senha atual
        Validator::extend('checkHashedPass', function ($attribute, $value, $parameters) {
            
            if (!Hash::check($value, $parameters[0])) 
            {
                return false;
            }
            
            return true;
        }, 'Senha atual está incorreta');   
        
        
        // recuperando todas as senhas utilizadas anteriormente pelo usuário
        $allPasswords = Password::where('cpf', '=', $user->cpf)->get();
        

        // validator: checkPassUser
        // valida a senha do usuário, caso a nova senha não tenha sido utilizada anteriormente
        // retornar true ou false para caso de a senha já ter sido utilizada anteriormente

        Validator::extend('checkPassUse', function($attribute, $value, $parameters) use ($allPasswords)
        {
            foreach ($allPasswords as $password) 
            {
                if (Hash::check($value, $password->password)) 
                {
                    return false;
                    break;
                }
            }
            
            return true;

        }, 'A Senha já foi utilizada anteriormente');
       

        //regras: 
        // 'required': campo obrigatório
        // 'checkHashedPass:' checa a senha digitada é igual a senha atual 
        // 'checkPassUse:' nova senha não pode ter sido usada nenhuma vez anteriormente
        // 'min:8': 8 caracteres pelo menos
        // 'different': valor tem que ser diferente da variável indicada
        // 'same': valor tem que ser igual ao da variável indicada
        //  'regex:/[a-z]/': Pelo menos 1 letra minúscula
        //  'regex:/[A-Z]/': Pelo menos 1 letra maiúscula
        //  'regex:/[0-9]/': Pelo menos 1 número
        //  'regex:/[@$!%*#?&]/': Pelo menos 1 caractere especial

        $rules = [

            'old_password' => ['required', 'checkHashedPass:' . $user->password],
            
            'password' => [
                'required',
                'string', 
                'min:8', 
                'checkPassUse:' . $user->password, 
                'different:old_password',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            
            'password_confirmation' => [
                'required', 
                'string', 
                'min:8', 
                'checkPassUse:' . $user->password, 
                'same:password',
                'different:old_password',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
        
        ];

        $messages = [
            'required' => 'O campo precisar ser preenchido',
            'password.min' => 'O campo senha precisa de no mínimo 8 caracteres',
            'password_confirmation.min' => 'O campo senha precisa de no mínimo 8 caracteres',
            'password.different' => 'A nova senha deve ser diferente da senha atual',
            'password_confirmation.same' => 'O campo confirmar senha precisar combinar com o campo senha',
            'password_confirmation.different' => 'A nova senha deve ser diferente da senha atual',
            'password.regex' => ' O campo senha precisa ter letras minúsculas e maiúsculas, números e caracteres especiais',
            'password_confirmation.regex' => ' A nova senha precisa ter letras minúsculas e maiúsculas, números e caracteres especiais',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            return   back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorUpdateSenha', 'error');
        }

        // guardando nova senha também na tabela 'passwords'
        Password::create(['cpf' => $user->cpf, 'password' => Hash::make($request->password)]);
        //salvando nova senha do usuário
        $user->password = Hash::make($request->password);
        $user->save();

        // return redirect()->route('protocolo-virtual.index')->with("record_added", 'Senha atualizada!');

    }
}
